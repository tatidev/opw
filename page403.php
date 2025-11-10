<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body style="margin: 0; font-family: 'Karla', sans-serif; font-size: 12px; min-height: 100%; background-color: #000;">
	<div style="width: 980px; margin-left: auto; margin-right: auto; background-color: #FFF; ">
		<div style="border-bottom: solid 1px #bfac02; width: 980px; position: fixed;z-index: 990;">
			<div style="background-color: #000; min-height: 80px; width: 100%; position: relative;">
				<a href='https://www.opuzen.com'>
					<img src="https://www.opuzen.com/assets/images/opuzen_logo.jpg" style="margin: 14px 0 0 20px; cursor: pointer;" >
				</a>
			</div>
		</div>
		<div style="padding-top: 111px;">
			<div style="clear: both; width: 100%; background-color: white;">
				<div style="    width: 100%; overflow: hidden; margin-bottom: 6px;">
					<div style="margin-top: 18%; margin-bottom: 7%;">
						<div style=" min-height: 250px; font-weight: normal; line-height: 18px; color: #000; text-align: justify; text-justify: inter-word; letter-spacing: 1px;">

								<div style="text-align: center; font-size: 25px; margin-top: -30px;">403. Access Forbidden.</div>
								<div style="text-align: center; width: 60%; margin-top: 30px; margin-right: auto; margin-left: auto;">You don't have permission to access this page.</div>

						</div>
					</div>
				</div>
			</div>
			<div style="clear: both; width: 100%; background-color: #bfac02; color: #fff; text-align: center; font-size: 9px; padding: 5px 0;">&copy; <? echo date('Y'); ?> OPUZEN ALL RIGHTS RESERVED.</div>
		</div>
	</div>	
</body>
</html>

<?php

/**
 * IP AND DATABASE QUERYS CONTROL
 * 
 */

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
		$app = 'frontend';


    // FILTER THE OFFICE 
    if($_SERVER['REMOTE_ADDR'] !== '64.183.81.218'){
        
    	$con=mysqli_connect('external-db.s199249.gridserver.com','db199249_webRo','1#iJY]1ej}o', 'db199249_log');
        
        $q = "select count(1)+1 cant from TLOG_IP_404 where ip = '".$_SERVER['REMOTE_ADDR']."' and date > date_sub(now(), interval 1 minute) and application = '".$app."'";
        $row = mysqli_fetch_assoc(mysqli_query($con, $q));
        $cant = $row['cant'];
    
        $status = '';
        if(intval($cant) > 5)
            $status = 'BLOCKED';
        
        $arr = ip_info($_SERVER['REMOTE_ADDR'], "Location");
        
        mysqli_query($con,"INSERT INTO TLOG_IP_404 (ip, application, error_code, country, state, city, address, status, browser, url_original) VALUES ('".$_SERVER['REMOTE_ADDR']."','".$app."', 403,'".$arr["country"]."', '".$arr["state"]."', '".$arr["city"]."', '".ip_info($_SERVER['REMOTE_ADDR'], "address")."', '".$status."', '".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['REQUEST_URI']."')");
    
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
					//echo "saved";
				}
        
        mysqli_close($con);
    		
			/*
        $body = '<br> This is the detail of the last attemp:<br><br>
                <u>Application</u>:&nbsp;'.$app.'<br>
                <u>Country</u>:&nbsp;'.$arr["country"].'<br>
                <u>State</u>:&nbsp;'.$arr["state"].'<br>
                <u>City</u>:&nbsp;'.$arr["city"].'<br>
                <u>Address</u>:&nbsp;'.ip_info($_SERVER['REMOTE_ADDR'], "address").'<br>
                <u>Browser</u>:&nbsp;'.$_SERVER['HTTP_USER_AGENT'].'<br>
                <u>Url</u>:&nbsp;'.$_SERVER['REQUEST_URI'].'<br>';
                
        if($status == 'BLOCKED'){
        	$destinatario = "lunavictor@gmail.com,EDonovan@opuzen.com,laura@argon-media.com";
    		$asunto = "Application ".$app.": Probable hacker attack pages 404";
    		$cuerpo = "<strong>detected ".$cant." attemp(s) in the last minute from ip ".$_SERVER['REMOTE_ADDR']."</strong><br>".$body;
            $headers  = "MIME-Version: 1.0\r\n";
    		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    		$headers .= "From: Opuzen.com <info@opuzen.com>\r\n";
    		
    		//mail($destinatario,$asunto,$cuerpo,$headers);
        }
			
				*/
    
		}

?>