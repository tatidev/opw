<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Search extends MY_Controller
	{
		
		/*
		
		Script for updating the url_title
		
		private function my_url_title($str, $delimiter='-') {
		  $clean = trim(strtolower($str));
		  $clean = str_replace(' / ', '-', $clean); // Replace the colors separator from DB
		  $clean = str_replace(' ', '-', $clean); // Replaces all spaces with hyphens.
		  return preg_replace('/[^A-Za-z0-9\-]/', '', $clean); // Removes special chars.
		}
		
		public function clean_urls(){
		  $items = $this->model->get_items();
		  foreach($items as $i){
			$i['url_title'] = $this->my_url_title( $i['name'] ). '/' . $this->my_url_title($i['color']);
			echo "<pre>"; print_r($i); echo "</pre>";
			$this->model->update_item($i['id'], $i['url_title']);
		  }
		}
		
		*/
		
		
		public function __construct()
		{
			// Set initial variables
			parent::__construct();
			$this->load->model('search_model', 'model');
			$this->data['SpecBaseUrl'] = $this->model->SpecBaseUrl;
		}
		
		function index()
		{
			$txtsearch = $this->input->post('txtsearch');
			if (strlen($txtsearch) != 0) {
				$this->search_log($txtsearch);
				$this->general_search($txtsearch); // method
			} else {
				$this->data['txtsearch'] = '';
				$this->data['totalFound'] = 0;
			}
			$this->menu_view('search_result', $this->data);
		}
		
		
		/*
		  Method
		  General Search w/ entered parameter
		  $txtsearch is the input to search
		*/
		function general_search($txtsearch = '')
		{
			$counter = 0;
			// $aux['purpose'] is defined in helpers/utility_helper.php
			$this->data['products_container_style'] = " padding-top:0px; ";
			$this->data['placeholder_url'] = placeholder_image();
			$this->data['txtsearch'] = '';
			
			$txtsearch = trim($txtsearch);
			
			$txt_array = explode(" ", $txtsearch);
            $keywords_arr = [];
			$fabrics_arr = array();
			$digitals_arr = array();
			$digital_grounds_arr = array();
			$fabric_colors_arr = array();
			$digital_colors_arr = array();
			
			foreach ($txt_array as $txt) {
				$txt = trim($txt);
				
				if (strlen($txt) > 0) {
                    // Keywords search
                    $aux = $this->model->search_keywords($txt);
                    $counter += count($aux);
                    $keywords_arr = array_unique(array_merge($keywords_arr, $aux), SORT_REGULAR);

					// Fabrics
					$aux = $this->model->search_fabric_by_name($txt);
					//$pkl_fabrics = [];
					//$visible_items_count = 0;
					// foreach($aux as $auxfab){
					// 	$visible_items_count = $this->model->get_prod_items_count_by_web_visibility($auxfab['id'], 'R');
					// 	$auxfab['count_of_visible_items'] = $visible_items_count['visible_items'];
					// }
					// Add $auxfab to $pkl_fabrics
					//$pkl_fabrics[] = $auxfab;

					//$aux['count_of_visible_items'] = $this->model->get_prod_items_count_by_web_visibility($aux['id'], 'R');
					$counter += count($aux);
					$fabrics_arr = array_unique(array_merge($fabrics_arr, $aux), SORT_REGULAR);
					// $fabrics_arr = array_unique(array_merge($fabrics_arr, $pkl_fabrics), SORT_REGULAR);

					  //echo "<pre>AUX - FAB ARR ". __LINE__."<br />"; 
					  //print_r($fabrics_arr); 
					  //echo "</pre>";
					

					// Digital Styles
					$aux = $this->model->search_digital_by_name($txt);
					$counter += count($aux);
					// echo "<pre>DIGITAL STYLES ARR(". $counter  .") ". __LINE__."<br />"; 
					// print_r($aux); 
					// echo "</pre>";
					$digitals_arr = array_unique(array_merge($digitals_arr, $aux), SORT_REGULAR);


					
					// Digital Grounds
					$aux = $this->model->search_digital_gr_by_name($txt);
					$counter += count($aux);
					$digital_grounds_arr = array_unique(array_merge($digital_grounds_arr, $aux), SORT_REGULAR);
					
					// Items/Colors
					$aux = $this->model->search_item_by_code_or_color($txt);
                    //         echo "<pre>"; echo $this->db->last_query(); exit;
					$counter += count($aux);
					// Proces image for each item
					foreach ($aux as $key => $value) {
						// echo "<pre>TEST AUX for". __LINE__."<br />"; 
						// print_r($aux[$key]); 
						// echo "</pre>";
						// Process Big image
						if (!is_null($aux[$key]['pic_big_url']) && !empty($aux[$key]['pic_big_url'])) {
							// Keep as it is
						} else if (!is_null($aux[$key]['pic_big']) && $aux[$key]['pic_big'] !== 'N') {
							$aux[$key]['pic_big_url'] = image_src_path('fabrics_items', 'big') . $aux[$key]['id'] . '.jpg';
						} else {
							$aux[$key]['pic_big_url'] = placeholder_image('thumb');
						}
						// Process HD image
						if (!is_null($aux[$key]['pic_hd_url'])) {
							// Keep as it is
						} else if (!is_null($aux[$key]['pic_hd']) && $aux[$key]['pic_hd'] !== 'N') {
							$aux[$key]['pic_hd_url'] = image_src_path('fabrics_items', 'hd') . $aux[$key]['id'] . '.jpg';
						} else {
							$aux[$key]['pic_hd_url'] = '';
						}
					}
					$fabric_colors_arr = array_unique(array_merge($fabric_colors_arr, $aux), SORT_REGULAR);
					
					// Digital items/colors
					$aux = $this->model->search_digital_item_by_code_or_color($txt);
					$counter += count($aux);
					// Proces image for each item
					foreach ($aux as $key => $value) {
						// Process Big image
						if (!is_null($aux[$key]['pic_big_url']) && !empty($aux[$key]['pic_big_url'])) {
							// Keep as it is
						} else if (!is_null($aux[$key]['pic_big']) && $aux[$key]['pic_big'] !== 'N') {
							$aux[$key]['pic_big_url'] = image_src_path('digital_styles_items', 'big') . $aux[$key]['id'] . '.jpg';
						} else {
							$aux[$key]['pic_big_url'] = placeholder_image('thumb');
						}
						// Process HD image
						if (!is_null($aux[$key]['pic_hd_url'])) {
							// Keep as it is
						} else if (!is_null($aux[$key]['pic_hd']) && $aux[$key]['pic_hd'] !== 'N') {
							$aux[$key]['pic_hd_url'] = image_src_path('digital_styles_items', 'hd') . $aux[$key]['id'] . '.jpg';
						} else {
							$aux[$key]['pic_hd_url'] = '';
						}
					}
					$digital_colors_arr = array_unique(array_merge($digital_colors_arr, $aux), SORT_REGULAR);
					
					$this->data['txtsearch'] .= $txt . ' ';
				}
			}
            $keywords_arr['title'] = 'Keywords';
            $keywords_arr['purpose'] = 'keywords';
            array_push($this->data['keywords_arr'], $keywords_arr);

			foreach( $fabrics_arr as $key => $fabric ){
					$fab_items_data = $this->get_items_by_regular_product_id($fabric['id']) ;
					$is_web_visible = $this->checkRegularProductWebVisibility($fab_items_data);
					// PKL Get visible items count
					$visible_items_count = $this->model->get_prod_items_count_by_web_visibility($fabric['id'], 'R');
					$fabrics_arr[$key]['count_of_visible_items'] = $visible_items_count['visible_items'];
					if($is_web_visible === "NOT WEB VISIBLE"){
						$fabrics_arr[$key]['prod_status_website_visibility'] = false;
						unset($fabrics_arr[$key]);
					}
			}
			
			if( count($fabrics_arr) < 1 ){
				$fabrics_arr = [];
				$counter = ($counter > 0)? $counter -1 : 0;
			}
			if( count($fabrics_arr) > 0 ){
			   $fabrics_arr['title'] = 'Fabrics';
			   $fabrics_arr['purpose'] = 'fabrics';
			}

			array_push($this->data['styles_arr'], $fabrics_arr);

			$digitals_arr['title'] = 'Digital Patterns';
			$digitals_arr['purpose'] = 'digital_styles';
			array_push($this->data['styles_arr'], $digitals_arr);
			
			$this->data['digitalGroundModalNeeded'] = (count($digital_grounds_arr) > 0 ? true : false);
			$digital_grounds_arr['title'] = 'Digital Grounds';
			$digital_grounds_arr['purpose'] = 'digital_grounds';
			array_push($this->data['styles_arr'], $digital_grounds_arr);
			
			$fabric_colors_arr['title'] = 'Colors';
			$fabric_colors_arr['purpose'] = 'fabrics_items';
			array_push($this->data['colors_arr'], $fabric_colors_arr);
			array_push($this->data['styles_arr'], $fabric_colors_arr);
			
			$digital_colors_arr['title'] = 'Digital Colors';
			$digital_colors_arr['purpose'] = 'digital_styles_items';
			array_push($this->data['colors_arr'], $digital_colors_arr);
			
			$this->data['totalFound'] = $counter;
			$this->data['txtsearch'] = trim($this->data['txtsearch']);
		}
		
		
		/*
		  Ajax CALL
		  Search per user inputs
		*/
		function get_filtered_search()
		{
			$level = $this->input->post('level');
			$specials = $this->input->post('specials');
			$category = $this->input->post('category');
			$collectionIds = $this->input->post('collectionIds');
			$weaveIds = $this->input->post('weaveIds');
			$auxAbrasions = $this->input->post('abrasionIds');
			$firecodeIds = $this->input->post('firecodeIds');
			$contentIds = $this->input->post('contentIds');
			$pattern2Ids = $this->input->post('pattern2Ids');
			$colorwaysIds = $this->input->post('colorwaysIds');
			$stockIds = $this->input->post('stockIds');
			// Format the given Abrasion Values
			$abrasionIds = $auxAbrasions;
			//$abrasionIds = $this->decode_abrasion($auxAbrasions);
			$ret = $this->filtered_search($level, $specials, $category, $collectionIds, $weaveIds, $abrasionIds, $firecodeIds, $contentIds, $pattern2Ids, $colorwaysIds, $stockIds);
	
			// Remove items with no yards available
			foreach ($ret as $key => $itemArr) {
				if(isset($itemArr['yardsAvailable']) && $itemArr['yardsAvailable'] < 1 ){
					unset($ret[$key]);
				}
			}
			$ret = array_values($ret);
			echo json_encode($ret);
		}
		
		
		

      /**
       * Get item details by product ID.
       *
       * @param int $product_id The ID of the product.
       * @return array Result set of item details with total web visibility.
       */
      public function get_items_by_regular_product_id($product_id) {
          // Start building the query
          $this->db->select('i.status_id, i.code, ps.name AS p_status, ps.web_vis AS web_visability, SUM(ps.web_vis) AS total_web_visability');
          $this->db->from('T_ITEM i');
          $this->db->join('P_PRODUCT_STATUS ps', 'i.status_id = ps.id', 'inner');
          $this->db->join('T_ITEM_COLOR ic', 'ic.item_id = i.id', 'inner');
          $this->db->join('P_COLOR c', 'ic.color_id = c.id', 'inner');
          $this->db->where('i.product_id', $product_id);
          $this->db->where('i.product_type', 'R');
          $this->db->group_by('i.status_id, i.code, ps.name, ps.web_vis');
          // Execute the query
          $query = $this->db->get();
          // Fetch the result and return
          return $query->result();
      }

      /**
       * Get specific properties from an array of objects.
	   * 
	   *  This function is used to get the web_visability properties
	   *  from the array of objects.
       *
       * @param array $array_in
       * @return array $result set of the specific properties.
       */
	  public function array_column_compat($array_in, $column_name) {
		$result = [];
        foreach ($array_in as $element) {
			if (is_object($element)) {
				if (property_exists($element, $column_name)) {
					$result[] = $element->$column_name;
				} 
			} 			
		}
		return $result;
	  }
      /**
	   * Check if any of the regular product is web visible.
	   * 
	   * If ALL items are not web visible, then the product is not web visible.
	   * If ANY item is web visible, then the product is web visible.
	   * 
	   */
	  public function checkRegularProductWebVisibility($prod_array) {
		$web_visabilities = $this->array_column_compat($prod_array, 'web_visability');
		// Check if any of the values are 1
		if (in_array( 1, $web_visabilities )) {
			return "IS WEB VISIBLE"; // Return TRUE if any value is 1
		} else {
			return "NOT WEB VISIBLE"; // Return FALSE if all values are 0
		}
	  }// end function 



	} // end class
?>