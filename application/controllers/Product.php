<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Product extends MY_Controller
	{
		
		public function __construct()
		{
			// Set initial variables
			parent::__construct();
			$this->load->model('product_model', 'model');
			$this->data['SpecBaseUrl'] = $this->model->SpecBaseUrl;
		}
		
		function index($z = '')
		{
			$id = $this->input->post('member_id');
			$category = $this->input->post('category');
			$category = ($category == 'sc_grounds' ? 'fabrics' : $category);
			$valid = true;
			
			// Only if it's a URI call
			if (null == $id) {
				/*
				  Call by URI
				  Start processing
				*/
				$uri = explode('/', uri_string());
				if ($uri[1] == 'digital') {
					$category = 'digital_styles';
					$str = $uri[2];
				} else {
					$category = 'fabrics';
					$str = $uri[1];
				}
				$id = $this->model->search_for_id($str, $category);
				
				/*
				  End URI processing
				*/
			}
			/*
			var_dump($str);
			var_dump($category);
			var_dump($id);
			exit;
			*/
			if (null !== $id) {

				$this->prepareData($id, $category);
				
				//PKL Do not show product page if no items are web visible
				//echo "<pre> Product::index(".$category.")  ";
				//print_r($this->data);
				//echo "</pre>";

				if( $category !== 'digital_styles' && empty($this->data['web_visible_items']) ){
                    $this->show_404();
				}
				
				//echo "<pre> Product::index: category ";
				//print_r($category);
				////print_r($cat);
				//echo "</pre>";

				// + Get Colorstory for the Items so we can filter in the front end
				$this->data['url_title'] = (isset($str) ? $str : '');
				$this->menu_view('product_view_original', $this->data);
				
			} else {
				// Items not found!
				// Show screen for item not found
				//
				$this->show_404();
			}
			/*
			  Index End
			*/
		}
		
		
		/**************
		 *
		 * Methods
		 **************/
		
		
		function specsheet($uriname)
		{
			if (isset($_POST['member_id'])) {
				$id = $this->input->post('member_id');
			} else {
				// Evaluate $uriname
				if (is_int($uriname)) { // If it's an integer already
					$id = $uriname;
				} else {
					// If it's a string
					$id = $this->model->search_for_id($uriname, 'fabrics');
				}
			}
			
			if ($this->model->is_valid_product_id($id)) { // Checks if the product is not ARCHIVED or hidden
				$this->data['specType'] = 'fabrics';
				$this->prepareData($id, 'fabrics');
				
				// Get rid of data that is shared with other views and not needed on the spec sheet
				$only_items = $this->data['colors_arr'][0];
				unset($only_items['purpose']);
				unset($only_items['title']);
				$this->data['colors_arr'] = $only_items;
			}
			
			$this->load->view('spec_sheet_print', $this->data);
		}
		
		function item_specsheet($uriname, $uricolor)
		{
			if (isset($_POST['member_id'])) {
				// If the ID comes through the form post
				$item_id = $this->input->post('member_id');
			} else {
				$item_id = $this->model->search_url_item($uriname . '/' . $uricolor);
			}
			//echo $item_id;exit;
			if ($this->model->is_valid_item_id($item_id)) { // Checks if the items is not hidden or discontinued
				
				$this->data['specType'] = 'items';
				$item_data = $this->model->get_item_data($item_id);
				$item_data['type'] = 'fabrics_items';
				if (!is_null($item_data['pic_big_url'])) {
					// URL is there. Nothing to do.
				} else if (!is_null($item_data['pic_big']) && $item_data['pic_big'] !== 'N') {
					$item_data['pic_big_url'] = image_src_path('fabrics_items', 'big') . $item_id . '.jpg';
				} else {
					$item_data['pic_big_url'] = placeholder_image('thumb');
				}
				$this->data['item_data'] = $item_data;
				
				$this->prepareData($item_data['product_id'], 'fabrics'); // Get the related data to this specific product
				
				// Get rid of data that is shared with other views and not needed on the spec sheet
				$only_items = $this->data['colors_arr'][0];
				unset($only_items['purpose']);
				unset($only_items['title']);
				$this->data['colors_arr'] = $only_items;
				
				// Delete the item with ID $item_id from the $this->data['colors_arr']
				for ($i = 0; $i < count($this->data['colors_arr']); $i++) {
					if ($this->data['colors_arr'][$i]['id'] == $item_id) {
						unset($this->data['colors_arr'][$i]);
						break;
					}
				}
			} else {
				return;
			}

			// echo "<pre> Product::item_specsheet(".$item_id.")  ";
			// print_r($this->data);
			// echo "</pre>";

			$this->load->view('spec_sheet_print', $this->data);
		}
		
		function prepareData($id, $cat)
		{
			$this->data['id'] = $id;
			$this->data['purpose'] = $cat;
			$this->data['category'] = $cat;
			$this->data['cant_items'] = $this->model->get_cant_items($id, $cat);
			
			$aux = $this->model->get_items_assoc($id, $cat);

            //echo "<pre> get_items_assoc($id, $cat) ".__FILE__ ;
			//print_r($aux);
			//echo "</pre>";

			$this->data['closeout_items'] = $this->model->get_closeout_items($id);
			// Proces image for each item
			foreach ($aux as $key => $value) {
				// Process Big image
				if (!is_null($aux[$key]['pic_big_url']) && !empty($aux[$key]['pic_big_url'])) {
					// Keep as it is
				} else if (!is_null($aux[$key]['pic_big']) && $aux[$key]['pic_big'] !== 'N') {
					$aux[$key]['pic_big_url'] = image_src_path($cat . '_items', 'big') . $aux[$key]['id'] . '.jpg';
				} else {
					$aux[$key]['pic_big_url'] = placeholder_image('thumb');
				}
				// Process HD image
				if (!is_null($aux[$key]['pic_hd_url'])) {
					// Keep as it is
				} else if (!is_null($aux[$key]['pic_hd']) && $aux[$key]['pic_hd'] !== 'N') {
					$aux[$key]['pic_hd_url'] = image_src_path($cat . '_items', 'hd') . $aux[$key]['id'] . '.jpg';
				} else {
					$aux[$key]['pic_hd_url'] = '';
				}
			}

            sort_by_key($aux, "color", true);
			$aux['title'] = '';
			$aux['purpose'] = $cat . '_items';
			array_push($this->data['colors_arr'], $aux);
			$spec = $this->model->get_pattern_spec($id, $cat);
			$this->data['aux'] = $spec;
			$this->data['spec_data'] = $spec;
			
			
			$this->data['spec'] = array();
			//var_dump($id);exit;
			switch ($cat) {
				case 'fabrics':
					
					if ($this->is_valid_spec_str($spec['NAME'])) {
						$this->data['product_name'] = $spec['NAME'];
					}
					
					// Weight/Use
					$aux = $this->model->get_fabric_use($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							array_push($a, $b['DESCR']);
						}
						$aux = array('text' => 'Use', 'data' => $a);
						array_push($this->data['spec'], $aux);
					}
					
					// Weave
					$aux = $this->model->get_fabric_weave($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							array_push($a, $b['DESCR']);
						}
						$aux = array('text' => 'Weave', 'data' => $a);
						array_push($this->data['spec'], $aux);
					}
					
					if ($this->is_valid_spec_str($spec['WIDTH'])) {
						$aux = array('text' => 'Width', 'data' => array($spec['WIDTH'] . ' "'));
						array_push($this->data['spec'], $aux);
					}
					
					if ($this->is_valid_spec_str($spec['WEIGHT_N'])) {
						$aux = array('text' => 'Weight', 'data' => array($spec['WEIGHT']));
						array_push($this->data['spec'], $aux);
					}
					
					if ($this->is_valid_spec_str($spec['V_REPEAT'])) {
						$aux = array('text' => 'Vertical Repeat', 'data' => array($spec['V_REPEAT'] . ' "'));
						array_push($this->data['spec'], $aux);
					}
					
					if ($this->is_valid_spec_str($spec['H_REPEAT'])) {
						$aux = array('text' => 'Horizontal Repeat', 'data' => array($spec['H_REPEAT'] . ' "'));
						array_push($this->data['spec'], $aux);
					}
					
					// Front Content
					$aux = $this->model->get_fabric_content($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							array_push($a, $b['DESCR']);
						}
						$aux = array('text' => 'Face Content', 'data' => str_replace('.00', '', $a));
						array_push($this->data['spec'], $aux);
					}
					
					// Back Content
					$aux = $this->model->get_fabric_back_content($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							array_push($a, $b['DESCR']);
						}
						$aux = array('text' => 'Back Content', 'data' => str_replace('.00', '', $a));
						array_push($this->data['spec'], $aux);
					}
					
					// Abrasion
					$aux = $this->model->get_fabric_abrasion($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							$parts = explode(' ', $b['DESCR']);
							$rubs = array_shift($parts);
							array_push($a, number_format($rubs, 0) . ' ' . implode(' ', $parts));
						}
						$aux = array('text' => 'Abrasion', 'data' => $a);
						array_push($this->data['spec'], $aux);
					}
					
					// Firecodes
					$aux = $this->model->get_fabric_firecodes($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							array_push($a, $b['DESCR']);
						}
						$aux = array('text' => 'Fire Rating', 'data' => $a);
						array_push($this->data['spec'], $aux);
					}
					
					// Finish
					$aux = $this->model->get_fabric_finish($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							array_push($a, $b['DESCR']);
						}
						$aux = array('text' => 'Finish', 'data' => $a);
						array_push($this->data['spec'], $aux);
					}
					
					// Cleaning
					$aux = $this->model->get_fabric_cleaning($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							array_push($a, $b['DESCR']);
						}
						$aux = array('text' => 'Cleaning', 'data' => $a);
						array_push($this->data['spec'], $aux);
					}
					
//					// Cleaning Instructions
//					$data = $this->model->get_fabric_cleaning_instructions($id);
//					if ($this->is_valid_spec_arr($data, 'name')) {
//						$a = [];
//						foreach ($data as $d) {
//							$_row = anchor($this->model->opms_site . $d['url_dir'], $d['name'], ['target' => '_blank']);
//							array_push($a, $_row);
//						}
//						$row_data = ['text' => 'Care Instructions', 'data' => $a];
//						array_push($this->data['spec'], $row_data);
//					}
					
					// Origin
					if ($this->is_valid_spec_str($spec['ORIGIN'])) {
						$aux = array('text' => 'Origin', 'data' => array($spec['ORIGIN']));
						array_push($this->data['spec'], $aux);
					}
					
					// Is outdoor or not
					if ($this->is_valid_spec_str($spec['IS_OUTDOOR'])) {
						$aux = array('text' => 'Outdoor', 'data' => array($spec['IS_OUTDOOR']));
						array_push($this->data['spec'], $aux);
					}

                    if (array_key_exists('lightfastness', $spec) && $this->is_valid_spec_str($spec['lightfastness'])) {
                        $aux = array('text' => 'Lightfastness', 'data' => array($spec['lightfastness']));
                        array_push($this->data['spec'], $aux);
                    }

                    $this->data['CareInstrUrl'] = '';
					$data = $this->model->get_fabric_cleaning_instructions($id);
					if($this->is_valid_spec_arr($data, 'name')){
						$this->data['CareInstrUrl'] = $this->model->opms_site . $data[0]['url_dir'];
					}
					
					$this->data['WarrantyUrl'] = '';
					$data = $this->model->get_fabric_warranty($id);
					if($this->is_valid_spec_arr($data, 'name')){
						$this->data['WarrantyUrl'] = $this->model->opms_site . $data[0]['url_dir'];
					}
					
					// Spec Sheet button
					//$this->data['SpecUrl'] = $this->model->opms_site . 'reps/product/specsheet/R/' . $spec['url_title'];
					$this->data['SpecUrl'] = $this->model->opms_site . 'reps/product/specsheet/R/' . $spec['id'];
// 		$this->data['btnSpecUrl'] = anchor($this->data['SpecUrl', 'DOWNLOAD SPEC SHEET', array('class'=>'btnSpec mt-4 p-2', 'target'=>'_blank') );
//         $this->data['btnSpecUrl'] = anchor('product/specsheet/'.$spec['url_title'], 'DOWNLOAD SPEC SHEET', array('class'=>'btnSpec mt-4 p-2', 'target'=>'_blank') );
					
					//$this->data['btnShareUrl'] = anchor("?subject=I'd%20like%20to%20share%20an%20Opuzen%20fabric%20with%20you&amp;body=Hi%2C%0A%0AI%20thought%20you%20might%20be%20interested%20in%20this%20item%20from%20Opuzen%3A%0A%0A".htmlentities( site_url('product/'.$spec['url_title']) )."%0A%0A%0ABest%2C'>Share</a>", 'SHARE', array('class'=>'btnSpec pull-right mt-4 p-2') );
					/*$hidden = array('member_id' => $id);
					$this->data['btnSpecUrl'] = form_open('product/specsheet/' . url_title(strtolower($spec['NAME'])), " id='specForm' target='_blank' ", $hidden)
												. " <span href='#' class='btnSpec pull-left mt-4 p-2' style='cursor:pointer;' onclick='document.forms.specForm.submit()'>DOWNLOAD SPEC SHEET</span> "
											   . form_close();
											   */
					
					//echo "<pre>"; var_dump($this->data['spec']); exit;
					
					break;
				
				case 'digital_styles':
					
					if ($this->is_valid_spec_str($spec['NAME'])) {
						$this->data['product_name'] = $spec['NAME'];
					}
					
					// Digital Pattern
					$aux = $this->model->get_digital_style_pattern($id);
					if ($this->is_valid_spec_arr($aux)) {
						$a = array();
						foreach ($aux as $b) {
							array_push($a, $b['DESCR']);
						}
						$aux = array('text' => 'Pattern', 'data' => $a);
						array_push($this->data['spec'], $aux);
					}
					
					if ($this->is_valid_spec_str($spec['V_REPEAT'])) {
						$aux = array('text' => 'Vertical Repeat', 'data' => array($spec['V_REPEAT'] . ' "'));
						array_push($this->data['spec'], $aux);
					}
					
					if ($this->is_valid_spec_str($spec['H_REPEAT'])) {
						$aux = array('text' => 'Horizontal Repeat', 'data' => array($spec['H_REPEAT'] . ' "'));
						array_push($this->data['spec'], $aux);
					}
					
					//$this->data['SpecUrl'] = $this->model->opms_site . 'reps/product/specsheet/D/' . $spec['url_title'];
					$this->data['SpecUrl'] = $this->model->opms_site . 'reps/product/specsheet/D/' . $spec['id'];
					break;
			}
			
			/*
		  Beauty Shot Image
		*/
			
			$img_attrs = array(
				'class' => 'img-fluid fixwidth bkgr-white'
			);
			
//			$a_attrs = array(
////       'class' => 'img-fluid fixwidth bkgr-white',
//				'href' => "https://www.pinterest.com/pin/create/button/?url=" . site_url() . uri_string() . "&media=&description=" . $this->data['product_name'],
//				'data-pin-do' => "buttonPin",
////       'data-pin-custom' => "true",
//				'data-pin-hover' => 'true',
//				'data-pin-log' => "button_pinit",
////       'data-pin-count' => "above",
////       'data-pin-hover' => 'true',
////       'target' => "_blank"
//			);
			
			if (!is_null($spec['pic_big_url'])) {
				$url = $spec['pic_big_url'];
// 			$img = img($url, false, $img_attrs );
			} else if (!is_null($spec['pic_big']) && !in_array($spec['pic_big'], array('N', 'P'))) {
				$url = image_src_path($cat) . $id . '.jpg';
// 			$img = img($url, false, $img_attrs );
			} else {
// 			$url = placeholder_image();
				$url = '';
// 			$img = img($url, false, $img_attrs );
			}
			
			$img = img($url, false, $img_attrs);

			$this->data['img'] = $img;
			$this->data['imgUrl'] = $url;
            $this->data['is_new'] = $this->model->exists_in_list($id, $this->model->web_list_id['new_arrivals']);


			//echo "<pre>get_item_web_visiblity(id)  ";
			//print_r($this->data['colors_arr'][0]);
			//echo "</pre>";

			// PKL
			//  get_item_web_visiblity($item_id);
			$this->data['web_visible_items'] = [];
			foreach($this->data['colors_arr'][0] as $key => $value){
				$item_item_code = (isset($value['item_code'])? $value['item_code'] : 0);
				if (isset($value['id'])) {
					$this->data['colors_arr'][0][$key]['prod_status_website_visibility'] 
					  = $this->model->get_item_web_visiblity($value['id'], $item_item_code);
				} 
				//$this->data['colors_arr'][0][$key]['prod_status_website_visibility'] = $this->model->get_item_web_visiblity($value['id'], $valid['item_code']);
				if($cat !== 'digital_styles'){
				  if(isset($this->data['colors_arr'][0][$key]['prod_status_website_visibility'])){
					if( $this->data['colors_arr'][0][$key]['prod_status_website_visibility'] == 1 ) {
						array_push($this->data['web_visible_items'], $value);
					}
				  }
				}else{
					array_push($this->data['web_visible_items'], $value);
				}
			}
			// echo "<pre>get_item_web_visiblity(id)  ";
			// print_r($this->data['colors_arr'][0]);
			// echo "</pre>";


			
		}
		
		function closeout(){
			$this->load->model('search_model', 'search');
			$this->data['activeMenu'] = 'CLOSEOUT';
			
			$this->data['purpose'] = 'fabrics';
			$this->data['level'] = item;
//<<<<<<< HEAD
			array_push($this->data['navigation'], 'Closeout');
			$this->data['category_selected'] = $this->data['purpose'];
			$this->data['special_selected'] = $this->model->web_list_id['closeout'];
			$this->data['terms'] = $this->load->view("closeout_terms", '', TRUE);
			$this->menu_view(['filters_fab', 'closeout_product_list']);
//=======
////			array_push($this->data['navigation'], 'Closeout');
//			$this->data['category_selected'] = $this->data['purpose'];
//			$this->data['special_selected'] = $this->model->web_list_id['closeout'];
//			$this->data['terms'] = $this->load->view("closeout_terms", '', TRUE);
//			$this->menu_view('product_list');
//>>>>>>> new_website
		}
		
	}

?>