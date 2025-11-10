<?php

// Products constants
	define('product', 'Pr');
	define('item', 'It');

	define('Regular', 'R');
	define('Digital', 'D');
	define('ScreenPrint', 'SP');

	class MY_Controller extends CI_Controller
	{
		// Common properties
		protected $data;

		function __construct()
		{
			parent::__construct();
			$this->access_log();
			//
			// Variables for the filtered search

			$this->data['special_selected'] = ''; // This code is a string
			$this->data['category_selected'] = 0;
			$this->data['collection_selected'] = 0;
			$this->data['weave_selected'] = 0;
			$this->data['abrasions_selected'] = 0;
            $this->data['abrasions_selected'] = 0;
            $this->data['firecode_selected'] = 0;
			$this->data['content_selected'] = 0;
			$this->data['pattern2_selected'] = 0;
			$this->data['colorway_selected'] = 0;


			$this->data['navigation'] = array();

			// For the Search view
            $this->data['keywords_arr'] = [];
			$this->data['styles_arr'] = array();
			$this->data['colors_arr'] = array();
			$this->data['digitalGroundModalNeeded'] = false;
			/*
			  Javascript/CSS (external) Libraries For All Pages
			*/

			// Head
			$this->data['library_head'] = array();
			$this->add_external_library('head', '', "<link rel='icon' type='image/ico' href='" . asset_url() . "favicon.ico'>");
//			$this->add_external_library('head', 'css', 'https://fonts.googleapis.com/css?family=Karla:wght@200');

            $this->add_external_library('head', '', '<link rel="preconnect" href="https://fonts.googleapis.com">');
            $this->add_external_library('head', '', '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>');
            $this->add_external_library('head', 'css', 'https://fonts.googleapis.com/css2?family=Karla:wght@200&display=swap');
			$this->add_external_library('head', 'css', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400&display=swap');

			$this->add_external_library('head', 'css', asset_url() . 'icons/font-awesome-4.7.0/css/font-awesome.min.css');
			$this->add_external_library('head', 'css', asset_url() . 'others/bootstrap/css/bootstrap.min.css');

			$this->add_external_library('head', 'css', asset_url() . 'css/style.css?v=' . rand());
			$this->add_external_library('head', 'css', asset_url() . 'css/anim.css'); // Loading spinner

			$this->add_external_library('head', 'js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');

			$this->add_external_library('head', 'js', asset_url() . 'js/jquery.unveil.js'); // Lazy Image Loading
			$this->add_external_library('head', '', "<link rel='stylesheet' type='text/css' media='screen and (max-device-width: 1200px)' href='" . asset_url() . "css/mobile.css?q=" . rand() . "' />");

			$this->add_external_library('head', 'js', asset_url() . 'others/tipped/tipped.js');
			$this->add_external_library('head', 'css', asset_url() . 'others/tipped/tipped.css');

			// Desktop Menu
			$this->add_external_library('head', 'js', asset_url() . 'others/smartmenus-1.0.1/jquery.smartmenus.js');
			$this->add_external_library('head', 'css', asset_url() . 'others/smartmenus-1.0.1/css/sm-core-css.css');
			$this->add_external_library('head', 'css', asset_url() . 'css/menu.css?q=' . rand());
			// Mobile Menu
			$this->add_external_library('head', 'js', asset_url() . 'others/mobile-menu/js/modernizr.custom.js');
			$this->add_external_library('head', 'js', asset_url() . 'others/mobile-menu/js/jquery.dlmenu.js');
			$this->add_external_library('head', 'css', asset_url() . 'others/mobile-menu/css/component.css');

			// Foot
			$this->data['library_foot'] = array();
			$this->add_external_library('foot', 'js', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
			$this->add_external_library('foot', 'js', asset_url() . 'others/bootstrap/js/bootstrap.min.js');
			$this->add_external_library('foot', 'js', asset_url() . 'js/common.js?q=' . rand()); // Some custom JS

			// Testing
			$this->add_external_library('head', 'js', asset_url() . 'others/migrate-3.0/migrate.js');
			$this->add_external_library('head', '', '<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>');
			$this->data['isHomePage'] = false;
		}

		function load_bootstrap4()
		{
			$this->add_external_library('head', '', '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">');
			$this->add_external_library('head', '', '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>');
			$this->add_external_library('head', '', '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>');
		}

		/*
		  <<<<<<<<<<<<<<<< Common Methods >>>>>>>>>>>>>>>>>>
		*/

		/*
			Custom function to integrate the header, menu and footer
		*/

		function menu_view($template_name, $vars = array(), $return = FALSE)
		{
			$this->load->model('menu_model');
            $this->set_latest_documents();
			$this->data['menu'] = $this->menu_model->generate($this->data["documents"]);
			$this->data['txtsearch'] = (isset($vars['txtsearch']) ? $vars['txtsearch'] : '');

			if (isset($vars['mode']) && $vars['mode'] === 'pre_searched' && isset($vars['items'])) {
				//echo "<pre>CONDITION MET LINE: " . __LINE__ . " - FILE: " . __FILE__;
				$this->data['search_values'] = $vars['items'];
			}


			// Common settings for the product_list
			if ($template_name === 'product_list'
                // or (!is_array($template_name) and strpos($template_name, "product_list") >= 0)
                or (is_array($template_name) and in_array('closeout_product_list', $template_name))
                or (is_array($template_name) and in_array('product_list', $template_name))
                or (is_array($template_name) and in_array('product_list_digital_ground', $template_name))
				or (is_array($template_name) and in_array('product_list_slayman', $template_name))
            ) {
				$this->product_list_commons();
			}

			if ($return) {
				$content = $this->load->view('header', $this->data, $return);
				$content .= $this->load->view('nav_view', $this->data, $return);
                if(is_array($template_name)){
                    foreach($template_name as $tmp){
                        $content .= $this->load->view($tmp, $this->data, $return);
                    }
                }
                else{
                    $content .= $this->load->view($template_name, $this->data, $return);
                }
//				$content .= $this->load->view($template_name, $this->data, $return);
				$content .= $this->load->view('footer', $this->data, $return);
				return $content;
			} else {
				$this->load->view('header', $this->data);
				$this->load->view('nav_view', $this->data);
				$this->load->view('collection_line_banner', $this->data);
                if(is_array($template_name)){
                    foreach($template_name as $tmp){
                        $this->load->view($tmp, $this->data);
                    }
                }
                else{
                    $this->load->view($template_name, $this->data);
                }
//				$this->load->view($template_name, $this->data);
				$this->load->view('footer', $this->data);
			}
		}


		function product_list_commons()
		{
			$this->set_filter_combos();
			/*
			$specials = array($this->data['specials_selected']);
			$category = array($this->data['category_selected']);
			$collectionIds = array($this->data['collection_selected']);
			$weaveIds = array($this->data['weave_selected']);
			$abrasionIds = array();
			$firecodeIds = array();
			$contentIds = array($this->data['content_selected']);
			$pattern2Ids = array($this->data['pattern2_selected']);
			$this->data['initialData'] = $this->filtered_search($specials, $category, $collectionIds, $weaveIds, $abrasionIds, $firecodeIds, $contentIds, $pattern2Ids );
			$this->data['initialData'] = json_encode($this->data['initialData']);
			*/
			$this->include_dropdown_dependencies();
			$this->add_external_library('foot', 'js', asset_url() . 'js/jquery.filters.js?q=' . rand());
		}

		function include_dropdown_dependencies()
		{
			$this->add_external_library('foot', 'js', asset_url() . 'others/bootstrap/js/bootstrap-multiselect.js');
			$this->add_external_library('foot', 'css', asset_url() . 'others/bootstrap/css/bootstrap-multiselect.css');

		}

		/*
		  Search for view/product_list
		*/
		function filtered_search($level, $specials, $category, $collectionIds, $weaveIds, $abrasionIds, $firecodeIds, $contentIds, $pattern2Ids, $colorwaysIds, $stockIds)
		{
//			var_dump($stockIds);
			$result = $this->model->filtered_search($level, $specials, $category, $collectionIds, $weaveIds, $abrasionIds, $firecodeIds, $contentIds, $pattern2Ids, $colorwaysIds, $stockIds);
//    var_dump($result);

			if ($level == item || $category == "digital_grounds") {
//            if ($level == item) {
				return $result; #$this->_process_filter_search_items($result, $category);
			}
            else if ($level == product) {
                return $this->_process_filter_search_products($result, $category);
            }
		}

		private function _process_filter_search_products($result, $category)
		{
			$ret = array();
			$aux = array();
			$s3imageUriPrefix = 'https://opuzen-site-assets.s3.us-west-1.amazonaws.com/images/thumbs/';
			                    
			foreach ($result as $r) {
				$aux['id'] = $r['id'];
				$thumnailUri = $s3imageUriPrefix . 'thumb-'.$r['id'] . '.jpg';
				$aux['thumb_src'] = FALSE;
				// if($this->checkImageExists($thumnailUri)){
				// 	$aux['thumb_src'] = $thumnailUri;
				// }
                $aux['is_new'] = (key_exists('is_new', $r) && $r['is_new'] == '1') ? asset_url() . "/images/new_sticker.png" : null;
				$aux['name'] = $r['name'];
				
				if (intval($r['cant_items']) > 0) {
					$aux['cant_items'] = $r['cant_items'] . ' color' . ($r['cant_items'] > 1 ? 's' : '');
				} else {
					$aux['cant_items'] = '';
				}

                if ($aux['thumb_src']){
					$url = $aux['thumb_src'];
				} else if (!is_null($r['pic_big_url'])) {
					$url = $r['pic_big_url'];
				} else if (!is_null($r['pic_big']) && !in_array($r['pic_big'], array('P', 'N'))) {
					$url = image_src_path($category) . $r['id'] . '.jpg';
				} else {
					$url = placeholder_image();
				}

				//$url = ( $r['pic_big'] == 'P' ? placeholder_image() : image_src_path($category).$r['id'].'.jpg' );

				$img = img('', false,
					array(
						'src' => $url,
						'data-id' => $r['id'],
						'data-name' => $r['url_title'],
						'data-category' => $category,
						'class' => 'img-fluid image-preview mx-auto',
						'style' => 'background-color: grey; width: 230px; height: 107px;',
						'data-src' => $url
					)
				);
				switch ($category) {
					case 'fabrics':
						$href = site_url('product/' . $r['url_title']);
						break;
					case 'digital_styles':
						$href = site_url('product/digital/' . $r['url_title']);
						break;
					default:
						$href = '#';
						break;
				}
				// The #anchor_elem is for the hash location in the url
				// The id is the url_title but prevent certain id's like ['logo', 'home', 'about', 'contact']
				$imgSpanId = in_array($r['url_title'], ['logo', 'home', 'about', 'contact']) ? 'anchor_elem' : $r['url_title'];
				$aux['img'] = "<span class='anchor_elem' id='" . $imgSpanId . "' ></span>
			<a href='" . $href . "'>
			" . $img . "
			</a>";
				array_push($ret, $aux);
			}
			//echo "<pre> LINE: " . __LINE__ . " - FILE: " . __FILE__ ; 
			//print_r($ret); 
			//echo "</pre>";
			$this->data['filtered_search_products'] = $ret;
			return $ret;
		}

		private function _process_filter_search_items($result, $category)
		{
			$ret = array();
			$aux = array();
			foreach ($result as $r) {
				# Process
			}
			return $ret;
		}

		/*
			Sets the information for the filter combos in the view/product_list
		*/
		function set_filter_combos()
		{
			$this->data['allSpecials'] = array(
				['id' => $this->model->web_list_id['closeout'], 'name' => 'Closeout'],
				array('id' => $this->model->web_list_id['new_arrivals'], 'name' => 'New Arrivals'),
				array('id' => $this->model->web_list_id['30_under'], 'name' => '$30 & Under')
			);
			$this->data['allCollections'] = ($this->data['purpose'] == 'digital_grounds' ? $this->model->get_all_digital_ground_collections() : $this->model->get_all_collections());
			$this->data['allWeaves'] = $this->model->get_all_weaves();
			$this->data['allFirecodes'] = $this->model->get_all_firecodes();
			$this->data['allWebContents'] = $this->model->get_all_web_contents();
			$this->data['allPatterns2'] = ($this->data['purpose'] == 'fabrics' ? $this->model->get_all_pattern2() : $this->model->get_all_pattern2_digital());
			$this->data['allColorways'] = $this->model->get_all_colorways();
			$this->data['allAbrasions'] = $this->model->get_abrasion_options();
			$this->data['allStocks'] = $this->model->get_stock_options();

			$isCloseout = strpos($this->uri->uri_string, 'closeout') !== false;
			// Default View
			$this->data['visibleDropdown'] = array(
				'fl-specials' => 'hide',
				'fl-category' => 'hide',
				'fl-col' => '',
				'fl-wea' => 'hide',
				'fl-abr' => '',
				'fl-sto' => $isCloseout ? '' : 'hide',
				'fl-fir' => '',
				'fl-con' => '',
				'fl-pat' => '',
				'fl-colorways' => ''
			);
//        $this->data['flexClass'] = ' justify-content-between ';
			$this->data['filterColClass'] = ' mt-3 mr-3 ';

			switch ($this->data['purpose']) {
				case 'digital_styles':
					$this->data['visibleDropdown']['fl-specials'] = 'hide';
					$this->data['visibleDropdown']['fl-col'] = 'hide';
					$this->data['visibleDropdown']['fl-wea'] = 'hide';
					$this->data['visibleDropdown']['fl-abr'] = 'hide';
					$this->data['visibleDropdown']['fl-fir'] = 'hide';
					$this->data['visibleDropdown']['fl-con'] = 'hide';
					//$this->data['visibleDropdown']['fl-pat'] = 'hide';
					$this->data['visibleDropdown']['fl-colorways'] = 'hide';

					$this->data['flexClass'] = '';
					$this->data['filterColClass'] .= ' mr-5 ';
					break;

				case 'sc_grounds':
					$this->data['visibleDropdown']['fl-specials'] = 'hide';
					$this->data['visibleDropdown']['fl-col'] = 'hide';
					$this->data['visibleDropdown']['fl-wea'] = 'hide';
					$this->data['visibleDropdown']['fl-abr'] = 'hide';
					$this->data['visibleDropdown']['fl-fir'] = 'hide';
					$this->data['visibleDropdown']['fl-con'] = 'hide';
					$this->data['visibleDropdown']['fl-pat'] = 'hide';
					$this->data['visibleDropdown']['fl-colorways'] = 'hide';

					$this->data['flexClass'] = '';
					break;

				case 'digital_grounds':
					$this->data['visibleDropdown']['fl-specials'] = 'hide';
					//$this->data['visibleDropdown']['fl-col'] = 'hide';
					$this->data['visibleDropdown']['fl-wea'] = 'hide';
					$this->data['visibleDropdown']['fl-abr'] = 'hide';
					$this->data['visibleDropdown']['fl-fir'] = 'hide';
					$this->data['visibleDropdown']['fl-con'] = 'hide';
					$this->data['visibleDropdown']['fl-pat'] = 'hide';
					$this->data['visibleDropdown']['fl-colorways'] = 'hide';

					$this->data['flexClass'] = '';
					break;

				case 'fabrics':
				default:
					// Default. Set as initial values.
					break;
			}

		}

		function add_navigation_crumb($text)
		{
			array_push($this->data['navigation'], $text);
		}

		function add_external_library($where, $type, $url)
		{
			array_push($this->data['library_' . $where], array('type' => $type, 'url' => $url));
		}


		/*
		  For data validation before sending it to the view
		*/

		function is_valid_spec_arr($data, $field = 'DESCR')
		{
			$ret = true;
			if (count($data) > 0) {
				foreach ($data as $d) {
					if ($d[$field] === 'N/A' || $d[$field] == '0' || $d[$field] == '0.00' || $d[$field] == 'Not Officially Tested') {
						$ret = false; // Found one not permitted for the front end
					}
				}
			} else {
				// No elements in array
				$ret = false;
			}
			return $ret;
		}

		function is_valid_spec_str($data)
		{
			if (strlen($data) > 0 && $data !== '0' && $data !== '0.00' && $data !== 'N/A') {
				return true;
			} else {
				return false;
			}
		}

		function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
		{
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
			$purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
			$support = array("country", "countrycode", "state", "region", "city", "location", "address");
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
								"city" => @$ipdat->geoplugin_city,
								"state" => @$ipdat->geoplugin_regionName,
								"country" => @$ipdat->geoplugin_countryName,
								"country_code" => @$ipdat->geoplugin_countryCode,
								"continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
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

		function access_log()
		{

			$this->load->model('logs_model');

			$ip = $this->input->ip_address();
			$arr = $this->ip_info($ip, "location");

			if ($this->uri->uri_string() !== '' && !in_array('search', $this->uri->segment_array()) && !in_array('get_ground_info', $this->uri->segment_array()) && !in_array('get_print', $this->uri->segment_array()) && !in_array('get_print_detail', $this->uri->segment_array())) {

				if (in_array('product', $this->uri->segment_array())) {
					// A Product page was viewed
					$seg_array = $this->uri->segment_array();
					$product = $seg_array[$this->uri->total_segments()];
					if (in_array('digital', $this->uri->segment_array())) {
						// A Digital Product
						$category = 'digital';
					} else {
						// A Fabric Product
						$category = 'fabric';
					}
					$this->logs_model->add_product_page_log($category, $product);

				} else {
					// Regular URIs
					$country = '';
                    $state   = '';
                    $city    = '';
					if (isset($arr) && is_array($arr) ) {
						$country = (isset($arr['country']))? $arr['country'] : '';
						$state   = (isset($arr['state']))? $arr['state'] : '';
						$city    = (isset($arr['city']))? $arr['city'] : '';
					}
					$this->logs_model->add_access_log($ip, $this->uri->uri_string(), $country, $state, $city, $this->ip_info($ip, "address"), $this->input->user_agent());
				}
			}
		}

		function add_product_log($category, $product)
		{
			$this->load->model('logs_model');
			$this->logs_model->add_product_page_log($category, $product);
		}

		function search_log($txt)
		{
			$this->load->model('logs_model');
			$this->logs_model->add_search_log($txt);
		}

		function show_404()
		{
			$this->load->model('logs_model');

			$ip = $this->input->ip_address();
			$arr = $this->ip_info($ip, "location");
			$this->logs_model->add_log_404($ip, 'frontend_new', $arr['country'], $arr['state'], $arr['city'], $this->ip_info($ip, "address"), '', $this->input->user_agent(), $this->uri->uri_string());

			show_404();
		}

        function set_latest_documents(){
            if(!property_exists($this, "data")) $this->data = [];
            if(isset($this->data["documents"])) return;
            if(!property_exists($this, 'menu_model')) $this->load->model('menu_model');
            $docs = $this->menu_model->get_latest_documents();
            $this->data["documents"] = [];
            foreach($docs as $doc){
                $this->data["documents"][$doc["g"]] = $doc["url_dir"];
            }
        }

		// Only checks if the image is available
		// Does not download the image

		function checkImageExists($url) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_NOBODY, true); // Only headers
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // No direct output
			curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout
			curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			if ($httpCode == 200) {
				return true;
			}
			return FALSE;
		}
        


	}

?>