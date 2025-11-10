<?php
	
	class MY_Model extends CI_Model
	{
        public $_STATUS = [
            'TBD' => 1,
            'NOTRUN' => 2,
            'DISCO' => 3,
            'RUN' => 4,
            'LEFTOVER' => 5,
            'FISHING' => 6,
            'FABRICSEEN' => 15,
            'MSO' => 18,
            'LIMITED_QUANTITY' => 20
        ];
		
		function __construct()
		{
			parent::__construct();
			$this->define_dtables();
			
//			$this->product_status_to_dont_print = array(2, 3, 19);
            $this->product_status_to_dont_print = [
                $this->_STATUS['NOTRUN'],
                $this->_STATUS['DISCO'],
//                $this->_STATUS['MSO'],
//                $this->_STATUS['LIMITED_QUANTITY']
            ];
			$this->firecodes_to_dont_show = array(11, 38, 39, 40, 41);
			
			$this->web_list_id = array(
				'digital_grounds' => 1,
				'screen_print_grounds' => 2,
				'new_arrivals' => 234,
				'30_under' => 3,
				'closeout' => 1041,
			);
		}
		
		private function define_dtables()
		{
			/*
				Main app database - used in ion_auth_model to bring the showroom
				Can be fixed using a VIEW
			*/
			$this->db_thismaster = $this->db->database;
			
			// Media Temple DV Server
			if (ENVIRONMENT === 'prod') {
				$this->opms_site = "https://app.opuzen.com/pms/";
				//$this->opms_site = "https://opms.opuzen.com/";
				$this->db_roadkit = "opuzen_prod_roadkit_init";
				$this->db_showcase = "opuzen_prod_showcase";
				$this->db_sales = "opuzen_prod_sales";
				$this->db_users = "opuzen_prod_users";
				$this->db_log = "opuzen_log";
			} elseif (ENVIRONMENT === 'dev') {
				$this->opms_site = "https://opms-dev.opuzen.com/";
				$this->db_roadkit = "opuzen_dev_roadkit_init";
				$this->db_showcase = "opuzen_dev_showcase";
				$this->db_sales = "opuzen_dev_sales";
				$this->db_users = "opuzen_dev_users";
				$this->db_log = "opuzen_dev_log";
			} elseif (ENVIRONMENT === 'qa') {
				$this->opms_site = "https://opms-qa.opuzen.com/";
				$this->db_roadkit  = "opuzen_qa_roadkit_init";
				$this->db_showcase = "opuzen_qa_showcase";
				$this->db_sales    = "opuzen_qa_sales";
				$this->db_users    = "opuzen_qa_users";
				$this->db_log      = "opuzen_qa_log";
			}else{
				$this->site_urls   = ['website' => "https://localhost:8443/"];
				$this->db_roadkit  = "opuzen_loc_roadkit_int";
				$this->db_showcase = "opuzen_loc_showcase";
				$this->db_sales    = "opuzen_loc_sales";
				$this->db_users    = "opuzen_loc_users";
				$this->db_log      = "opuzen_loc_log";
			}
			
			$this->SpecBaseUrl = $this->opms_site . 'reps/product/specsheet/R/';
			
			$this->t_product = "T_PRODUCT";
			$this->t_product_files = "T_PRODUCT_FILES";
			$this->t_product_abrasion = "T_PRODUCT_ABRASION";
			$this->t_product_abrasion_files = "T_PRODUCT_ABRASION_FILES";
			$this->t_product_cleaning = "T_PRODUCT_CLEANING";
			$this->t_product_cleaning_specials = "T_PRODUCT_CLEANING_SPECIAL";
			$this->t_product_cleaning_instructions = "T_PRODUCT_CLEANING_INSTRUCTIONS";
			$this->t_product_content_back = "T_PRODUCT_CONTENT_BACK";
			$this->t_product_content_front = "T_PRODUCT_CONTENT_FRONT";
			$this->t_product_finish = "T_PRODUCT_FINISH";
			$this->t_product_finish_specials = "T_PRODUCT_FINISH_SPECIAL";
			$this->t_product_firecode = "T_PRODUCT_FIRECODE";
			$this->t_product_firecode_files = "T_PRODUCT_FIRECODE_FILES";
			$this->t_product_messages = "T_PRODUCT_MESSAGES";
			$this->t_product_origin = "T_PRODUCT_ORIGIN";
			$this->t_product_price = "T_PRODUCT_PRICE";
			$this->t_product_cost = "T_PRODUCT_PRICE_COST";
			$this->t_product_shelf = "T_PRODUCT_SHELF";
			$this->t_product_use = "T_PRODUCT_USE";
			$this->t_product_various = "T_PRODUCT_VARIOUS";
			$this->t_product_vendor = "T_PRODUCT_VENDOR";
			$this->t_product_weave = "T_PRODUCT_WEAVE";
			$this->t_product_warranty = "T_PRODUCT_WARRANTY";
			$this->t_product_stock = $this->db_sales . ".op_products_stock";
			
			$this->t_item = "T_ITEM";
			$this->t_item_color = "T_ITEM_COLOR";
			$this->t_item_messages = "T_ITEM_MESSAGES";
			$this->v_item = "V_ITEM";
			
			$this->product_digital = "T_PRODUCT_X_DIGITAL";
			$this->product_screenprint = "T_PRODUCT_X_SCREENPRINT";
			
			$this->t_digital_style = "U_DIGITAL_STYLE";
			$this->t_screenprint_style = "U_SCREENPRINT_STYLE";
			
			$this->t_showcase_product = "SHOWCASE_PRODUCT";
			$this->t_showcase_product_collection = "SHOWCASE_PRODUCT_COLLECTION";
			$this->t_showcase_product_contents_web = "SHOWCASE_PRODUCT_CONTENTS_WEB";
			$this->t_showcase_product_patterns = "SHOWCASE_PRODUCT_PATTERNS";
			$this->t_showcase_item = "SHOWCASE_ITEM";
			$this->t_showcase_item_coord_color = "SHOWCASE_ITEM_COORD_COLOR";
			$this->t_showcase_style = "SHOWCASE_DIGITAL_STYLE";
			$this->t_showcase_style_items = "SHOWCASE_DIGITAL_STYLE_ITEMS";
			$this->t_showcase_style_items_color = "SHOWCASE_DIGITAL_STYLE_ITEMS_COLOR";
			$this->t_showcase_style_items_coord_color = "SHOWCASE_DIGITAL_STYLE_ITEMS_COORD_COLOR";
			$this->t_showcase_styles_patterns = "SHOWCASE_DIGITAL_STYLE_PATTERNS";
			$this->t_showcase_screenprint = "SHOWCASE_SCREENPRINT_STYLE";
			$this->t_showcase_contents_web = "SHOWCASE_P_CONTENTS_WEB";
			$this->t_showcase_coord_colors = "SHOWCASE_P_COORD_COLORS";
			$this->t_showcase_patterns = "SHOWCASE_P_PATTERNS";
			$this->t_showcase_collection = "SHOWCASE_P_COLLECTION";
			$this->t_showcase_press = "SHOWCASE_PRESS";
			
			$this->p_abrasion_limit = "P_ABRASION_LIMIT";
			$this->p_abrasion_test = "P_ABRASION_TEST";
			$this->p_cleaning = "P_CLEANING";
			$this->p_cleaning_instructions = "P_CLEANING_INSTRUCTIONS";
			$this->p_color = "P_COLOR";
			$this->p_content = "P_CONTENT";
			$this->p_finish = "P_FINISH";
			$this->p_firecode = "P_FIRECODE_TEST";
			$this->p_origin = "P_ORIGIN";
			$this->p_product_status = "P_PRODUCT_STATUS";
			$this->p_stock_status = "P_STOCK_STATUS";
			$this->p_shelf = "P_SHELF";
			$this->p_use = "P_USE";
			$this->p_weave = "P_WEAVE";
			$this->p_category_lists = "P_CATEGORY_LISTS";
			$this->p_category_files = "P_CATEGORY_FILES";
			$this->p_price_type = "P_PRICE_TYPE";
			$this->p_weight_unit = "P_WEIGHT_UNIT";
			$this->p_warranty = "P_WARRANTY";
			
			$this->p_contact = "Z_CONTACT";
			
			$this->p_vendor = "Z_VENDOR";
			$this->p_vendor_files = "Z_VENDOR_FILES";
			$this->p_vendor_contact = "Z_VENDOR_CONTACT";
			
			$this->p_showroom = "Z_SHOWROOM";
			$this->p_showroom_files = "Z_SHOWROOM_FILES";
			$this->p_showroom_contact = "Z_SHOWROOM_CONTACT";
			
			$this->p_list = "Q_LIST";
			$this->p_list_items = "Q_LIST_ITEMS";
			//$this->p_list_products = "Q_LIST_PRODUCTS";
			$this->p_list_showrooms = "Q_LIST_SHOWROOMS";
			$this->p_list_category = "Q_LIST_CATEGORY";
			
			$this->th_product = "S_HISTORY_PRODUCT";
			$this->th_product_digital = "S_HISTORY_PRODUCT_X_DIGITAL";
			$this->th_product_screenprint = "S_HISTORY_PRODUCT_X_SCREENPRINT";
			$this->th_product_price = "S_HISTORY_PRODUCT_PRICE";
			$this->th_product_cost = "S_HISTORY_PRODUCT_PRICE_COST";
			$this->th_product_content_back = "S_HISTORY_PRODUCT_CONTENT_BACK";
			$this->th_product_content_front = "S_HISTORY_PRODUCT_CONTENT_FRONT";
			$this->th_product_various = "S_HISTORY_PRODUCT_VARIOUS";
			$this->th_product_vendor = "S_HISTORY_PRODUCT_VENDOR";
			$this->th_product_weave = "S_HISTORY_PRODUCT_WEAVE";
			$this->th_item = "S_HISTORY_ITEM";
			$this->th_item_color = "S_HISTORY_ITEM_COLOR";
		}
		
		// Filtered search
		function filtered_search($level, $specials = array(), $category = 'fabrics', $collectionsId = array(), $weavesId = array(), $abrasionsId = array(), $firecodesId = array(), $contentsId = array(), $pattern2Id = array(), $colorwaysIds = array(), $stockIds = [])
		{
			
			if ($level == product) {
				if ($category == 'fabrics') {
					$this->query_fabrics($specials, $collectionsId, $weavesId, $abrasionsId, $firecodesId, $contentsId, $pattern2Id, $colorwaysIds);
				} else if ($category == 'digital_styles') {
					$this->query_digital_styles($pattern2Id, $colorwaysIds);
				} else if ($category == 'sc_grounds') {
					$this->query_sc_grounds($collectionsId);
				} else if ($category == 'digital_grounds') {
					$this->query_digital_grounds($collectionsId);
				}
			} else if ($level == item) {
				if ($category == 'fabrics') {
					$this->query_fabrics_items($specials, $collectionsId, $weavesId, $abrasionsId, $firecodesId, $contentsId, $pattern2Id, $colorwaysIds, $stockIds);
				}
			}
//			var_dump($this->db->get_compiled_select()); exit;
            // =================================================
            //echo '<pre>PKL LINE: ' . __LINE__ . ' - ' . __FILE__ . ' - ' . __METHOD__ . 
			//     ' - ' . $this->db->get_compiled_select() . '</pre>';
			// =================================================
			return $this->db->get()->result_array();
		}
		
		/*
		
		  Query for Fabrics
		
		*/
		
		function query_fabrics($specials = array(), $collectionsId = array(), $weavesId = array(), $abrasionsId = array(), $firecodesId = array(), $contentsId = array(), $pattern2Id = array(), $colorwaysIds = array())
		{
			$new_arrivals_list_id = $this->web_list_id['new_arrivals'];
			$this->db
				->select("
					A.id as id, 
					A.name as name, 
					(   SELECT COUNT(III.id) FROM $this->t_item III JOIN $this->t_showcase_item ISI ON III.id = ISI.item_id
					    WHERE III.product_id = A.id AND III.product_type = 'R' AND III.archived = 'N' AND ISI.visible = 'Y'
					    ) as cant_items,
					COUNT(B.id) as cant_items_in_list,
					SP.url_title as url_title, 
					SP.pic_big as pic_big,
					SP.pic_big_url as pic_big_url
				")
                ->select("CASE WHEN NEWS.id IS NULL THEN 0 ELSE 1 END as is_new", false)
				->from("$this->t_product A")
				->join("$this->t_showcase_product SP", "A.id = SP.product_id")
				->join("$this->t_item B", "A.id = B.product_id")
				->join("$this->t_showcase_item SI", "B.id = SI.item_id")
                ->join("(SELECT DISTINCT Item.product_id as id
                    FROM Q_LIST_ITEMS ListItems
                    JOIN $this->t_item Item ON ListItems.item_id = Item.id
                    WHERE ListItems.list_id = $new_arrivals_list_id) NEWS", "A.id = NEWS.id", "left outer")
				->group_by('A.id')
				->order_by('A.name');
			
			$this->where_is_visible("SP");
			$this->where_is_visible("SI");
			$this->where_is_not_discontinued('B');
			$this->where_is_not_archived("A");
			$this->where_is_not_archived("B");
			
			if (!empty($collectionsId)) {
				$this->db
					->join("$this->t_showcase_product_collection C", 'A.id = C.product_id')
					->where_in('C.collection_id', $collectionsId);
			}
			if (!empty($weavesId)) {
				$this->db
					->join("$this->t_product_weave W", 'A.id = W.product_id')
					->where_in('W.weave_id', $weavesId);
			}
			if (!empty($abrasionsId)) {
				$abrasion_options = $this->get_abrasion_options();
				$abrasion_options_ids = array_column($abrasion_options, 'id');
				$this->db->join("$this->t_product_abrasion D", 'A.id = D.product_id');
				$tbl_field_alias = 'D.n_rubs';
				$this->db->group_start();
				foreach ($abrasionsId as $_aid) {
					$key = array_search($_aid, $abrasion_options_ids);
					$kdata = $abrasion_options[$key];
					$this->db->or_group_start();
					foreach($kdata['where'] as $w){
						$condition = $w[0];
						$value = $w[1];
						$this->db->where($tbl_field_alias .' '. $condition, $value);
					}
					$this->db->group_end();
				}
				$this->db->group_end();
			}
			if (!empty($firecodesId)) {
				$this->db
					->join("$this->t_product_firecode F", 'A.id = F.product_id')
					->where_in('F.firecode_test_id', $firecodesId);
			}
			if (!empty($contentsId)) {
				$this->db
					->join("$this->t_showcase_product_contents_web G", 'A.id = G.product_id')
					->where_in('G.content_web_id', $contentsId);
			}
			if (!empty($pattern2Id)) {
				$this->db
					->join("$this->t_showcase_product_patterns H", 'A.id = H.product_id')
					->where_in('H.pattern_id', $pattern2Id);
			}
			if (!empty($specials)) {
				$this->db
					->join("$this->p_list_items LI", "B.id = LI.item_id", 'left outer')
					->where_in("LI.list_id", $specials)
					->where("LI.active", "1");
				/*
		  if( in_array('new_arrivals', $specials) ){
			$this->db->join('T_PATTERN_NEW I', 'A.C_PATTERN_ID = I.C_PATTERN_ID');
		  }
		  if( in_array('30_under', $specials) ){
			$this->db->join('T_PATTERN_30UNDER J', 'A.C_PATTERN_ID = J.C_PATTERN_ID');
		  }
				*/
			}
			if (!empty($colorwaysIds)) {
				$this->db
					->join("$this->t_showcase_item_coord_color K", 'B.id = K.item_id')
					->where_in('K.coord_color_id', $colorwaysIds);
			}
			
		}
		
		function query_fabrics_items($specials = array(), $collectionsId = array(), $weavesId = array(), $abrasionsId = array(), $firecodesId = array(), $contentsId = array(), $pattern2Id = array(), $colorwaysIds = array(), $stockIds = array())
		{
//			var_dump($stockIds);
			$this->db
				->select("
					I.item_id as id,
					I.product_id as product_id,
					I.product_name,
					COALESCE(I.code, '') as code, I.color,
					SI.visible as is_visible,
					SI.url_title as url_title,
					SI.pic_big,
					SI.pic_big_url,
					SI.pic_hd,
					SI.pic_hd_url,
					Stock.yardsAvailable
				")
				->from("$this->v_item I")
				->join("$this->t_showcase_product SP", "I.product_id = SP.product_id", 'left outer')
				->join("$this->t_showcase_item SI", "I.item_id = SI.item_id", 'left outer')
				->join("V_ITEM_STOCK Stock", "I.item_id = Stock.item_id", "left outer")
				->where("SI.visible", 'Y')
				->where("SP.visible", 'Y')
				->group_by('I.item_id')
				->order_by('I.product_name, I.color');

            $this->showAll = false;
			$this->db->where("I.archived", 'N');
			$this->db->where("I.archived_product", 'N');
			
			if (!empty($collectionsId)) {
				$this->db
					->join("$this->t_showcase_product_collection C", 'I.product_id = C.product_id')
					->where_in('C.collection_id', $collectionsId);
			}
			if (!empty($weavesId)) {
				$this->db
					->join("$this->t_product_weave W", 'I.product_id = W.product_id')
					->where_in('W.weave_id', $weavesId);
			}
			if (!empty($abrasionsId)) {
				$abrasion_options = $this->get_abrasion_options();
				$abrasion_options_ids = array_column($abrasion_options, 'id');
				$this->db->join("$this->t_product_abrasion D", 'I.product_id = D.product_id');
				$tbl_field_alias = 'D.n_rubs';
				$this->db->group_start();
				foreach ($abrasionsId as $_aid) {
					$key = array_search($_aid, $abrasion_options_ids);
					$kdata = $abrasion_options[$key];
					$this->db->or_group_start();
					foreach($kdata['where'] as $w){
						$condition = $w[0];
						$value = $w[1];
						$this->db->where($tbl_field_alias .' '. $condition, $value);
					}
					$this->db->group_end();
				}
				$this->db->group_end();
			}
			if (!empty($firecodesId)) {
				$this->db
					->join("$this->t_product_firecode F", 'I.product_id = F.product_id')
					->where_in('F.firecode_test_id', $firecodesId);
			}
			if (!empty($contentsId)) {
				$this->db
					->join("$this->t_showcase_product_contents_web G", 'I.product_id = G.product_id')
					->where_in('G.content_web_id', $contentsId);
			}
			if (!empty($pattern2Id)) {
				$this->db
					->join("$this->t_showcase_product_patterns H", 'I.product_id = H.product_id')
					->where_in('H.pattern_id', $pattern2Id);
			}
			if (!empty($specials)) {
                if(in_array($this->web_list_id["closeout"], $specials) ){
                    $this->showAll = true;
                }
				$this->db
					->join("$this->p_list_items LI", "I.item_id = LI.item_id", 'left outer')
					->where_in("LI.list_id", $specials)
					->where("LI.active", "1");
			}
			if (!empty($stockIds)) {
				$stock_options = $this->get_stock_options();
				$stock_options_ids = array_column($stock_options, 'id');
				$tbl_field_alias = "Stock.yardsAvailable";
				$this->db->group_start();
				foreach($stockIds as $_sid){
					$key = array_search($_sid, $stock_options_ids);
					$kdata = $stock_options[$key];
					$this->db->or_group_start();
					foreach($kdata['where'] as $w){
						$condition = $w[0];
						$value = $w[1];
						$this->db->where($tbl_field_alias .' '. $condition, $value);
					}
					$this->db->group_end();
				}
				$this->db->group_end();
			}
			if (!empty($colorwaysIds)) {
				$this->db
					->join("$this->t_showcase_item_coord_color K", 'I.item_id = K.item_id')
					->where_in('K.coord_color_id', $colorwaysIds);
			}

//            var_dump($this->showAll);
            if(!$this->showAll){
//                var_dump("here");
                # Show only items that have visibility flags
                $this->where_is_not_discontinued('I');
                $this->db->where("Stock.yardsAvailable >=", 1);
                $this->where_is_visible("SP");
                $this->where_is_visible("SI");
            }
//            var_dump($this->db->get_compiled_select());
//            exit();
		}
		
		/*
		
		  Query for Digital Styles
		
		*/
		
		function query_digital_styles($pattern2Id = array(), $colorwaysIds = array())
		{
			
			$this->db
				->select('
				A.id as id, 
				A.name as name, 
				COUNT(B.id) as cant_items, 
				SS.url_title as url_title, 
				SS.pic_big as pic_big,
				SS.pic_big_url as pic_big_url
			')
				->from("$this->t_digital_style A")
				->join("$this->t_showcase_style SS", "A.id = SS.style_id")
				->join("$this->t_showcase_style_items B", "A.id = B.style_id")
				->group_by('A.id')
				->order_by('A.name');;
			
			$this->where_is_visible("SS");
			$this->where_is_visible("B");
			$this->where_is_not_archived("A");
			
			if (!empty($pattern2Id)) {
				$this->db
					->join("$this->t_showcase_styles_patterns SSP", "A.id = SSP.style_id")
					->where_in('SSP.pattern_id', $pattern2Id);
			}
			if (!empty($colorwaysIds)) {
				$this->db
					->join("$this->t_showcase_style_items_coord_color K", 'K.item_id = B.id')
					->where_in('K.coord_color_id', $colorwaysIds);
			}
		}
		
		/*
		
		  Query for Screen Print Grounds
		
		*/
		
		function query_sc_grounds($collectionsId = array())
		{
			
			$this->query_in_list($this->web_list_id['screen_print_grounds'], $collectionsId);
			$this->db
				->select("
				A.id as id, 
				A.name as name, 
				0 as cant_items,
				SP.url_title as url_title, 
				SP.pic_big as pic_big,
				SP.pic_big_url as pic_big_url,
				")
				->join("$this->t_showcase_product SP", "A.id = SP.product_id")
				->group_by("A.id");
		}
		
		/*
		
		  Query for Digital Grounds
		
		*/
		
		function query_digital_grounds($collectionsId = array(), $search = null)
		{
			$this->query_in_list($this->web_list_id['digital_grounds'], $collectionsId);
			$this->db
				->select("
				C.id as id, 
				CONCAT( COALESCE(A.dig_product_name, A.name), ' / ', GROUP_CONCAT( DISTINCT PCC.name ORDER BY CC.n_order SEPARATOR ' / ' ) ) as name, 
				0 as cant_items,
				SI.url_title as url_title, 
				SI.pic_big as pic_big,
				SI.pic_big_url as pic_big_url,
				SI.pic_hd as pic_hd,
				SI.pic_hd_url as pic_hd_url
				")
				->group_by("C.id");
			
			if (!is_null($search)) {
				$this->db->like("A.name", $search);
			}
		}
		
		function query_in_list($list_id, $collectionsId = array())
		{
			$this->db
				->from("$this->p_list_items LI")
				->join("$this->t_item C", "LI.item_id = C.id")
				->join("$this->t_item_color CC", "C.id = CC.item_id")
				->join("$this->p_color PCC", "CC.color_id = PCC.id")
				->join("$this->t_showcase_item SI", "LI.item_id = SI.item_id")
				->join("$this->t_product A", "C.product_id = A.id")
				->where_in("LI.list_id", $list_id)
				->where("LI.active", "1")
				->order_by('A.name');
			$this->where_is_not_archived("A");
			$this->where_is_not_archived("C");
			$this->where_is_visible('SI');
			
			if (!empty($collectionsId)) {
				$this->db
					->join("$this->t_showcase_product_collection PC", "PC.product_id = A.id")
					->where_in("PC.collection_id", $collectionsId);
			}
			//var_dump($this->db->get_compiled_select()); exit;
		}
		
		protected function _select_colors($id)
		{
			$this->db
				->select("
					I.product_id as pattern_id,
					I.id AS id,
                    I.product_name AS name,
                    I.color AS color,
                    I.code AS code,
					SI.url_title as url_title,
					SI.pic_big,
					SI.pic_big_url,
					SI.pic_hd,
					SI.pic_hd_url")
				->from("$this->v_item I")
				->join("$this->t_showcase_item SI", "I.id = SI.item_id");
			$this->where_is_visible('SI');
			$this->db->where("I.archived", 'N');
			$this->db->where("I.archived_product", 'N');
		}
		
		// Function add common clause to filter items that should not be shown or are archived
		function where_product_is_visible_and_not_archived($table, $param = 'Y')
		{
			$this->where_is_visible($table);
			$this->where_is_not_archived($table);
		}
		
		/*
	  function where_product_is_visible($table, $param='Y'){
			$this->db->where($table.'.visible', $param);
		}
		*/
		
		function where_is_not_archived($table)
		{
			$this->db->where("$table.archived", 'N');
		}
		
		function where_is_visible($table)
		{
			$this->db->where("$table.visible", 'Y');
		}

		// pkl 2024-07-16
		function where_product_status_allows_visiblity()
		{
			$table = $this->p_product_status;
			$this->db->where("$table.web_vis", 1);
		}
        
		// pkl 2024-07-16
        function where_stock_status_allows_visiblity()
        {
            $table = $this->p_stock_status;
            $this->db->where("$table.web_vis", 1);
        }		

		function where_is_not_discontinued($table)
		{
			$this->db->where_not_in("$table.status_id", $this->product_status_to_dont_print);
		}
        
		function get_all_digital_ground_collections()
		{
			$this->db
				->select('SC.id as id, SC.name as name')
				->from("$this->t_showcase_collection SC")
				->where_in("SC.id", array(21, 23, 25))
                ->where("active", "Y")
				->order_by('SC.name');
			$q = $this->db->get();
			return $q->result_array();
		}
		
		function get_all_collections()
		{
			$this->db->select('id, name')
				->from("$this->t_showcase_collection")
                ->where("active", "Y")
				->order_by('name');
			$q = $this->db->get();
			return $q->result_array();
		}
		
		function get_all_weaves()
		{
			return $this->db
				->select("id, name, '' as category, 'weave' as contr")
				->from("$this->p_weave A", false)
				->where(" EXISTS (SELECT 1 FROM $this->t_product_weave B JOIN $this->t_showcase_product SP ON B.product_id = SP.product_id WHERE SP.visible = 'Y' AND B.weave_id = A.id) ")
                ->where("active", "Y")
                ->order_by('name')
				->get()->result_array();
			/*
			$weavesArr = array();
			foreach($q->result() as $weave){
				$aux = array('name'=>$weave->name, 'id'=>$weave->id, 'category'=>'', 'contr'=>'weave');
				array_push($weavesArr, $aux);
			}
			return $weavesArr;
			*/
		}
		
		function get_all_firecodes()
		{
			return $this->db
				->distinct()
				->select('F.id, F.name')
				->from("$this->p_firecode F")
				->join("$this->t_product_firecode PF", " F.id = PF.firecode_test_id AND PF.visible = 'Y' ")
				->join("$this->t_showcase_product SP", " PF.product_id = SP.product_id AND SP.visible = 'Y' ")
				->where_not_in('F.id', $this->firecodes_to_dont_show)
				->where("F.active", 'Y')
				//->where(" EXISTS (SELECT 1 FROM $this->t_product_firecode PF JOIN $this->t_showcase_product SP ON PF.product_id = SP.product_id WHERE SP.visible = 'Y' AND PF.visible = 'Y' AND F.id = PF.firecode_test_id ) ")
				->order_by('F.name')
				->get()->result_array();
		}
		
		function get_all_web_contents()
		{
			return $this->db
				->select("id, id_web, name, '' as category, 'content' as contr")
				->from("$this->t_showcase_contents_web SCW")
				->where(" EXISTS (SELECT 1 FROM $this->t_showcase_product_contents_web SPCW JOIN $this->t_showcase_product SP ON SPCW.product_id = SP.product_id WHERE SP.visible = 'Y' AND SCW.id = SPCW.content_web_id ) ")
                ->where("active", "Y")
                ->order_by("name")
				->get()->result_array();
			/*
			$contentsArr = array();
			foreach($q->result() as $row){
				$aux = array('name'=>$row->name, 'id'=>$row->id, 'category'=>'', 'contr'=>'content');
				array_push($contentsArr, $aux);
			}
			return $contentsArr;
			*/
		}
		
		function get_all_pattern2()
		{
			return $this->db
				->select("id, name, 'fabrics' as category, 'pattern' as contr")
				->from("$this->t_showcase_patterns A", false)
				->where(" EXISTS (SELECT 1 FROM $this->t_showcase_product_patterns B JOIN $this->t_showcase_product SP ON B.product_id = SP.product_id WHERE SP.visible = 'Y' AND B.pattern_id = A.id) ")
                ->where("active", "Y")
                ->order_by('name')
				->get()->result_array();
			/*
			$patternsArr = array();
			foreach($q->result() as $pattern){
				$aux = array('name'=>$pattern->name, 'id'=>$pattern->id, 'category'=>'fabrics', 'contr'=>'pattern');
				array_push($patternsArr, $aux);
			}
			return $patternsArr;
			*/
		}
		
		function get_all_pattern2_digital()
		{
			return $this->db
				->select("id, name, 'digital_styles' as category, 'digital' as contr")
				->from("$this->t_showcase_patterns A", false)
				->where(" EXISTS (SELECT 1 FROM $this->t_showcase_styles_patterns B JOIN $this->t_showcase_style SS ON B.style_id = SS.style_id WHERE SS.visible = 'Y' AND B.pattern_id = A.id) ")
                ->where("active", "Y")
                ->order_by('name')
				->get()->result_array();
			//array_unshift( $q, array( 'text'=>'VIEW ALL', 'id'=>0, 'category'=>'digital_style', 'contr'=>'digital' ) );
			//return $q;
			/*
			$digitalPatternsArr = array();
			array_push($digitalPatternsArr, array('text'=>'VIEW ALL', 'id'=>0, 'category'=>'digital_styles', 'contr'=>'digital') );
			foreach($q->result() as $pattern){
				$aux = array('name'=>$pattern->name, 'id'=>$pattern->id, 'category'=>'digital_styles', 'contr'=>'digital');
				array_push($digitalPatternsArr, $aux);
			
			return $digitalPatternsArr;
			*/
		}
		
		function get_all_colorways()
		{
			return $this->db
				->select("id, name, '' as category, 'colorway' as contr")
				->from("$this->t_showcase_coord_colors A", false)
				->where(" EXISTS (SELECT 1 FROM $this->t_showcase_item_coord_color B JOIN $this->t_showcase_item SI ON B.item_id = SI.item_id WHERE SI.visible = 'Y' AND B.coord_color_id = A.id) ")
                ->where("active", "Y")
                ->order_by("name")
				->get()->result_array();
			/*
			$colorsArr = array();
			foreach($q->result() as $color){
				$aux = array('name'=>$color->name, 'id'=>$color->id, 'category'=>'', 'contr'=>'colorway');
				array_push($colorsArr, $aux);
			}
			return $colorsArr;
			*/
		}
		
		function get_abrasion_options()
		{
			return [
				[
					'id' => 0,
					'name' => 'Abrasion: 0-20000',
					'label' => '0 - 20000',
					'where' => [['<=', 20000]]
				],
				[
					'id' => 1,
					'name' => 'Abrasion: 20000-40000',
					'label' => '20000 - 40000',
					'where' => [['>', 20000], ['<=', 40000]]
				],
				[
					'id' => 2,
					'name' => 'Abrasion: 40000-60000',
					'label' => '40000 - 60000',
					'where' => [['>', 40000], ['<=', 60000]]
				],
				[
					'id' => 3,
					'name' => 'Abrasion: 60000-80000',
					'label' => '60000 - 80000',
					'where' => [['>', 60000], ['<=', 80000]]
				],
				[
					'id' => 4,
					'name' => 'Abrasion: 80000+',
					'label' => '+80000',
					'where' => [['>', 80000]]
				]
			];
		}
		
		function get_stock_options()
		{
			return [
				[
					'id' => 0,
					'name' => 'Stock: 0-10',
					'label' => '0 - 10 yds',
					'where' => [['<=', 10]]
				],
				[
					'id' => 1,
					'name' => 'Stock: 10-50',
					'label' => '10 - 50 yds',
					'where' => [['>', 10], ['<=', 50]]
				],
				[
					'id' => 2,
					'name' => 'Stock: 50-150',
					'label' => '50 - 150 yds',
					'where' => [['>', 50], ['<=', 150]]
				],
				[
					'id' => 3,
					'name' => 'Stock: >150',
					'label' => '+ 150 yds',
					'where' => [['>', 150]]
				]
			];
		}

        function get_latest_documents(){
            $queryString = "
            (
                    SELECT 'warranty' as g, CONCAT('https://app.opuzen.com/pms/', url_dir) as url_dir 
                    FROM `P_GENERAL_WARRANTY_FILES` L
                    LEFT JOIN `P_GENERAL_WARRANTY` R ON L.related_id = R.id
                    WHERE R.active = 'Y'
                    ORDER BY L.id DESC LIMIT 1;
                )
                UNION ALL
                (
                    SELECT 'cleaning' as g, CONCAT('https://app.opuzen.com/pms/', url_dir) as url_dir 
                    FROM `P_GENERAL_CLEANING_INSTRUCTIONS_FILES` L
                    LEFT JOIN `P_GENERAL_CLEANING_INSTRUCTIONS` R ON L.related_id = R.id
                    WHERE R.active = 'Y'
                    ORDER BY L.id DESC LIMIT 1
                )
                UNION ALL
                (
                    SELECT 'faq' as g, CONCAT('https://app.opuzen.com/pms/', url_dir) as url_dir 
                    FROM `P_FQS_FILES` L
                    LEFT JOIN `P_FQS` R ON L.related_id = R.id
                    WHERE R.active = 'Y'
                    ORDER BY L.id DESC LIMIT 1
                )
                UNION ALL
                (
                    SELECT 'terms' as g, CONCAT('https://app.opuzen.com/pms/', url_dir) as url_dir 
                    FROM `P_TERMS_FILES` L
                    LEFT JOIN `P_TERMS` R ON L.related_id = R.id
                    WHERE R.active = 'Y'
                    ORDER BY L.id DESC LIMIT 1
                )
            ";
            $queryString = "
                (SELECT 'warranty' as g, CONCAT('https://app.opuzen.com/pms/', url_dir) as url_dir FROM `P_GENERAL_WARRANTY_FILES` ORDER BY id DESC LIMIT 1)
                UNION ALL
                (SELECT 'cleaning' as g, CONCAT('https://app.opuzen.com/pms/', url_dir) as url_dir FROM `P_GENERAL_CLEANING_INSTRUCTIONS_FILES` ORDER BY id DESC LIMIT 1)
                UNION ALL
                (SELECT 'faq' as g, CONCAT('https://app.opuzen.com/pms/', url_dir) as url_dir FROM `P_FQS_FILES` ORDER BY id DESC LIMIT 1)
                UNION ALL
                (SELECT 'terms' as g, CONCAT('https://app.opuzen.com/pms/', url_dir) as url_dir FROM `P_TERMS_FILES` ORDER BY id DESC LIMIT 1)
            ";
            return $this->db->query($queryString)->result_array();
        }
	
	}

?>