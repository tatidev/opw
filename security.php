<?php
$opuzen_office = '64.183.81.218';
$koroseal = '98.103.33.66';

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

//$ip = '200.1.116.50'; //$_SERVER['REMOTE_ADDR'];
$app = 'Frontend';

 
//$htaccess = '.htaccess';
$htaccess = '/nfs/c11/h06/mnt/199249/domains/opuzen.com/html/.htaccess-06-25-18';
$contents = file_get_contents($htaccess, TRUE);

$mysqli = new mysqli('external-db.s199249.gridserver.com','db199249_webRo','1#iJY]1ej}o', 'db199249_log');
if (mysqli_connect_errno()) exit();

$consulta = "SELECT DISTINCT IP
			FROM TLOG_IP_404
			WHERE (
			upper(url_original) LIKE  '%PHPINFO%'
			OR upper(url_original) LIKE  '%CGI-BIN%'
			OR upper(url_original) LIKE  '%WP-LOGIN%'
			OR upper(url_original) LIKE  '%BLOG/%'
			OR upper(url_original) LIKE  '%UNION%'
			) AND application = 'frontend' AND ip != '".$opuzen_office."' AND ip != '".$koroseal."';";

if ($resultado = $mysqli->query($consulta)) {
    $new_blocks = array();
		
		if($resultado->num_rows > 0) {
			$text_to_add = '';
			
			$title = "\n # New IPs " . date('m/d/Y') . " at " . date("h:i:sa") . "\n\n";
			$text_to_add .= $title;
			//echo $title."<br>";
			//file_put_contents($htaccess, $separator, FILE_APPEND);

			while ($fila = $resultado->fetch_row()) {
				$ip_i = $fila[0];
				if( !stripos($ip_i, ':') ) {
					$ip_i = trim(str_replace(',', ' ', $ip_i ));
					//$ip_i = trim(str_replace(':', '', $ip_i));
					
					
					$exists = stripos($contents, 'deny from ' . $ip_i); //$exists = stripos($contents, "\n" . 'deny from ' . $ip_i);

					if(!$exists){
						array_push($new_blocks, $ip_i);
						$ban = "Deny from {$ip_i}\n";
						$text_to_add .= $ban;
						//echo $ban."<br>";
						//file_put_contents($htaccess, $ban, FILE_APPEND);
					}
				}
			}
			
			if(count($new_blocks) > 0){
				file_put_contents($htaccess, $text_to_add, FILE_APPEND);
			}
		}
    $resultado->close();
}
$mysqli->close();


if(count($new_blocks) > 0){
    $arr = ip_info($_SERVER['REMOTE_ADDR'], "Location");
  
    $body = '<br><b>Security has been executed</b><br><br>
            <u><b>Application:</b></u>&nbsp;'.$app.'<br>
            <u><b>New IPs blocked:</b></u><br>';
    foreach($new_blocks as $ip){
        $body .= $ip.'<br>';
      
    }
    $body .= '<br><br>Executed by '.$_SERVER['REMOTE_ADDR'].' in '.$arr['city'].' / '.$arr['state'].' / '.$arr['country'];
    $destinatario = "edonovan@opuzen.com";
    $asunto = $app." Security / New IPs have been blocked";
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: Opuzen.com <info@opuzen.com>\r\n";
    		
	mail($destinatario,$asunto,$body,$headers);
}


?>