<?

class Product_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function search_for_id($str, $category)
	{
		switch ($category) {
			case 'fabrics':
			case constant('Regular'):
				$m = $this->t_product;
				$t_table = "$this->t_showcase_product";
				$c_id = "product_id";
				break;
			case 'digital_styles':
			case constant('Digital'):
				$m = $this->t_digital_style;
				$t_table = "$this->t_showcase_style";
				$c_id = "style_id";
				break;
		}

		$this->db
		  ->select("A.$c_id as id")
		  ->from("$t_table A")
		  ->join($m, "A.$c_id = $m.id")
		  ->where('A.url_title', $str);
		$this->where_is_visible('A');
		$this->where_is_not_archived($m);
		//return $this->db->get_compiled_select();

		$q = $this->db->get();

		if ($q->num_rows() > 0) {
			$row = $q->row();
			return $row->id;
		} else {
			return null;
		}
	}

	function search_url_item($url)
	{
		$this->db->select('item_id')
		  ->from($this->t_showcase_item)
		  ->where('url_title', $url);
		$q = $this->db->get();
		return $q->row()->item_id;
	}

	function get_item_data($item_id)
	{
		$this->db
		  ->select("
			A.id as id, 
			A.product_id as product_id, 
			A.code as code, 
			GROUP_CONCAT(DISTINCT D.name ORDER BY C.n_order SEPARATOR ' / ') AS color,
			SI.url_title as url_title,
			SI.pic_big as pic_big,
			SI.pic_big_url as pic_big_url
			")
		  ->from("$this->t_item A")
		  ->join("$this->t_showcase_item SI", "A.id = SI.item_id")
		  ->join("$this->t_item_color C", 'A.id = C.item_id')
		  ->join("$this->p_color D", 'C.color_id = D.id')
		  ->where('A.id', $item_id);
		$q = $this->db->get();
		return $q->row_array();
	}

	function get_cant_items($id, $category)
	{
		switch ($category) {
			case 'fabrics':
			case constant('Regular'):
				$t_table = $this->t_showcase_item;
				$c_id = 'item_id';
				break;
			case 'digital_styles':
			case constant('Digital'):
				$t_table = $this->t_showcase_style;
				$c_id = 'style_id';
				break;
			default:
				$t_table = '';
				$c_id = '';
				break;
		}
		$this->db->select("COUNT(A.$c_id) as total")
		  ->from($t_table . ' A')
		  ->where('A.' . $c_id, $id);
		$this->where_is_visible('A');
		$q = $this->db->get();
		$aux = $q->row();
		return $aux->total;
	}

	function get_pattern_spec($id = '', $cat)
	{
		switch ($cat) {
			case 'fabrics':
			case constant('Regular'):
				return $this->get_fabric_info($id);
			case 'digital_styles':
			case constant('Digital'):
				return $this->get_digital_style_info($id);
		}
	}

	// Called by get_pattern_spec('fabrics')
	function get_fabric_info($id = '')
	{
		$this->db->select(" A.id AS id, A.name AS NAME,
												SP.url_title AS url_title,
                        SP.descr AS DESCRIPTION,
                        A.width AS WIDTH,
                        PV.weight_n as WEIGHT_N,
                        GROUP_CONCAT(PV.weight_n, ' ', Wunit.name) as WEIGHT,
                        A.vrepeat AS V_REPEAT,
                        A.hrepeat AS H_REPEAT,
                        P.name AS ORIGIN,
												SP.pic_big AS pic_big,
												SP.pic_big_url AS pic_big_url,
                        CASE WHEN A.outdoor = 'N' THEN 'No' ELSE 'Yes' END AS IS_OUTDOOR,
                        A.lightfastness")
		  ->from("$this->t_product A")
		  ->join("$this->t_showcase_product SP", "A.id = SP.product_id", 'left outer')
		  ->join("$this->t_product_origin PO", "A.id = PO.product_id", 'left outer')
		  ->join("$this->p_origin P", 'PO.origin_id = P.id', 'left outer')
		  ->join("$this->t_product_various PV", "A.id = PV.product_id", 'left outer')
		  ->join("$this->p_weight_unit Wunit", "PV.weight_unit_id = Wunit.id", 'left outer')
		  ->where('A.id', $id)
		  ->group_by('A.name');
		//$this->where_is_visible('SP');
		$this->where_is_not_archived('A');

		return $this->db->get()->row_array();
	}

	// Called by get_pattern_spec('digital_style')

	function get_digital_style_info($id = '')
	{
		$this->db
		  ->select("
				A.id AS id, A.name as NAME, 
				SS.url_title, 
				A.vrepeat as V_REPEAT, 
				A.hrepeat as H_REPEAT,
				'' as DESCRIPTION, 
				SS.pic_big AS pic_big,
				SS.pic_big_url AS pic_big_url,
				")
		  ->from("$this->t_digital_style A")
		  ->join("$this->t_showcase_style SS", "A.id = SS.style_id")
		  ->where("A.id", $id)
		  ->group_by("A.name");
		$this->where_is_visible('SS');
		$this->where_is_not_archived('A');
		return $this->db->get()->row_array();
	}

	function get_items_assoc($id, $cat)
	{
		switch ($cat) {
			case 'fabrics':
			case constant('Regular'):
				return $this->get_colors($id);
			case 'digital_styles':
			case constant('Digital'):
				return $this->get_colors_digital($id);
			default:
				return array();
		}
	}

	function get_colors($id)
	{
		$this->db
		  ->select("		A.id AS id,
							SI.url_title as url_title,
							SI.visible AS is_visible,
                    B.name AS name,
                    GROUP_CONCAT(DISTINCT D.name ORDER BY C.n_order SEPARATOR ' / ') AS color,
                    A.code AS code,
                    GROUP_CONCAT(DISTINCT F.name SEPARATOR ' / ') AS colorstory,
										SI.pic_big,
										SI.pic_big_url,
										SI.pic_hd,
										SI.pic_hd_url, 
										B.id as pattern_id")
		  ->from("$this->t_item A")
		  ->join("$this->t_showcase_item SI", "A.id = SI.item_id")
		  ->join("$this->t_product B", "A.product_id = B.id")
		  ->join("$this->t_item_color C", "A.id = C.item_id")
		  ->join("$this->p_color D", "C.color_id = D.id")
		  ->join("$this->t_showcase_item_coord_color E", "A.id = E.item_id", 'left outer')
		  ->join("$this->t_showcase_coord_colors F", "E.coord_color_id = F.id", 'left outer')
		  ->join("$this->t_product_stock S", "A.id = S.master_item_id", 'left outer')
		  //->where("A.product_type", constant('Regular') )
		  ->where("A.product_id", $id)
		  ->group_start()
		  ->where_not_in("A.status_id", $this->product_status_to_dont_print)
		  ->or_where("S.yardsAvailable >=", 10)
		  ->group_end()
		  ->group_by("A.id")
		  ->order_by("SI.n_order, B.name, A.code");
		$this->where_is_visible('SI');
		$this->where_is_not_archived('A');
		$this->where_is_not_archived('B');
		return $this->db->get()->result_array();
	}
	
	function get_colors_digital($id)
	{
		$this->db
		  ->select("		
				SI.id AS id,
				SI.url_title,
				B.name AS name,
				GROUP_CONCAT(DISTINCT D.name ORDER BY C.n_order SEPARATOR ' / ') as color,
				'' AS code,
				
				SI.pic_big,
				SI.pic_big_url,
				'N' as pic_hd,
				NULL as pic_hd_url,
				B.id as pattern_id", FALSE)
		  ->from("$this->t_showcase_style_items SI")
		  ->join("$this->t_digital_style B", "SI.style_id = B.id")
		  ->join("$this->t_showcase_style_items_color C", "SI.id = C.item_id")
		  ->join("$this->p_color D", "C.color_id = D.id")
		  //->join("$this->t_showcase_style_items_coord_color E", "SI.id = E.item_id")
		  //->join("$this->t_showcase_coord_colors F", "E.coord_color_id = F.id")
		  //->where("A.product_type", constant('Digital') )
		  ->where("SI.style_id", $id)
		  ->group_by("SI.id")
		  ->order_by("SI.n_order");
		$this->where_is_visible('SI');
		$this->where_is_not_archived('SI');
		$this->where_is_not_archived('B');
		return $this->db->get()->result_array();
	}

	function get_fabric_content($id = '')
	{
		$this->db
		  ->select("CONCAT( PC.perc, '% ', C.name ) as DESCR")
		  ->from("$this->t_product_content_front PC")
		  ->join("$this->p_content C", "PC.content_id = C.id")
		  ->where("PC.product_id", $id)
		  ->order_by("PC.perc DESC, C.name");
		return $this->db->get()->result_array();
	}

	function get_fabric_back_content($id)
	{
		$this->db
		  ->select("CONCAT( PC.perc, '% ', C.name ) as DESCR")
		  ->from("$this->t_product_content_back PC")
		  ->join("$this->p_content C", "PC.content_id = C.id")
		  ->where("PC.product_id", $id)
		  ->order_by("PC.perc, C.name");
		return $this->db->get()->result_array();
	}

	function get_fabric_abrasion($id)
	{
		$this->db
		  ->select("GROUP_CONCAT(PA.n_rubs, ' ', PT.name) as DESCR")
		  ->from("$this->t_product_abrasion PA")
		  ->join("$this->p_abrasion_test PT", "PA.abrasion_test_id = PT.id")
		  ->where("PA.visible", 'Y')
		  ->where("PA.product_id", $id)
		  ->group_by("PA.id");
		return $this->db->get()->result_array();
	}

	function get_fabric_firecodes($id)
	{
		$this->db
		  ->select("F.name as DESCR")
		  ->from("$this->t_product_firecode PF")
		  ->join("$this->p_firecode F", "PF.firecode_test_id = F.id")
          ->where("PF.visible", "Y")
          ->where("F.active", "Y")
		  ->where("PF.product_id", $id);
		return $this->db->get()->result_array();
	}

	function get_fabric_finish($id)
	{
		$this->db
		  ->select("CONCAT(F.name) AS DESCR")
		  ->from("$this->t_product_finish PF")
		  ->join("$this->p_finish F", "PF.finish_id = F.id")
          ->where("F.active", "Y")
		  ->where("PF.product_id", $id);
		return $this->db->get()->result_array();
	}

	function get_fabric_cleaning($id)
	{
		$this->db
		  ->select("CONCAT(F.name) AS DESCR")
		  ->from("$this->t_product_cleaning PF")
		  ->join("$this->p_cleaning F", "PF.cleaning_id = F.id")
          ->where("F.active", "Y")
		  ->where("PF.product_id", $id);
		return $this->db->get()->result_array();
	}

	function get_fabric_cleaning_instructions($id)
	{
		$table_files = $this->p_cleaning_instructions . '_FILES';
		$this->db
		  ->select("F.name, $table_files.url_dir")
		  ->from("$this->t_product_cleaning_instructions PF")
		  ->join("$this->p_cleaning_instructions F", "PF.cleaning_instructions_id = F.id")
		  ->join("$table_files", "F.id = $table_files.related_id", 'left outer')
		  ->where("PF.product_id", $id);
		return $this->db->get()->result_array();
	}

	function get_fabric_warranty($id){
		$attr_name = "warranty";
		$const_table = $this->p_warranty;
		$const_files_table = $const_table . "_FILES";
		$relate_table = $this->t_product_warranty;
		
		$this->db
			->select("$const_table.name, $const_files_table.url_dir")
			->from("$relate_table")
			->join("$const_table", "$relate_table.".$attr_name."_id = $const_table.id")
			->join("$const_files_table", "$const_table.id = $const_files_table.related_id", 'left outer')
			->where("$relate_table.product_id", $id);
		return $this->db->get()->result_array();
	}
	
	function get_fabric_use($id)
	{
		$this->db
		  ->select("CONCAT(F.name) AS DESCR")
		  ->from("$this->t_product_use PF")
		  ->join("$this->p_use F", "PF.use_id = F.id")
          ->where("F.active", "Y")
		  ->where("PF.product_id", $id);
		return $this->db->get()->result_array();
	}

	function get_fabric_weave($id)
	{
		$this->db
		  ->select("CONCAT(F.name) AS DESCR")
		  ->from("$this->t_product_weave PF")
		  ->join("$this->p_weave F", "PF.weave_id = F.id")
          ->where("F.active", "Y")
		  ->where("PF.product_id", $id);
		return $this->db->get()->result_array();
	}

	function get_digital_style_pattern($style_id)
	{
		$this->db
          ->select("F.id")
		  ->select("CONCAT(F.name) AS DESCR")
		  ->from("$this->t_showcase_styles_patterns PF")
		  ->join("$this->t_showcase_patterns F", "PF.pattern_id = F.id")
		  ->where("PF.style_id", $style_id);
		return $this->db->get()->result_array();
	}

	function is_valid_product_id($id)
	{
		$this->db
		  ->select("*")
		  ->from("$this->t_product A")
		  ->join("$this->t_showcase_product SP", "A.id = SP.product_id")
		  ->where("A.id", $id);
		$this->where_is_visible("SP");
		$this->where_is_not_archived("A");
		$q = $this->db->get();
		return ($q->num_rows() > 0);
	}

	function is_valid_item_id($id)
	{
		$this->db
		  ->select('*')
		  ->from("$this->t_item A")
		  ->join("$this->t_showcase_item SI", "A.id = SI.item_id")
		  ->where('A.id', $id);
		$this->where_is_not_archived("A");
		$this->where_is_visible('SI');
		$q = $this->db->get();
		return ($q->num_rows() > 0);
	}

	function get_closeout_items($product_id=null, $includeImages=false){
		$list_items = $this->p_list_items;
		$item_stock = "V_ITEM_STOCK";
		$t_product = $this->t_product;
		
		$this->db
			->select("ListItem.item_id as id, FLOOR(Stock.yardsAvailable) as yardsAvailable")
			->from("$list_items ListItem")
			->join("$item_stock Stock", "ListItem.item_id = Stock.item_id", 'left outer')
			->where("ListItem.list_id", $this->web_list_id['closeout'])
			->where("ListItem.active", '1')
			->group_start()
				->where("Stock.YardsAvailable >=", "1.00")
				->or_where("Stock.YardsAvailable", null)
			->group_end()
		;
		
		if($includeImages){
			$this->db
				->select("
					I.product_id as pattern_id,
                    I.product_name AS name,
                    I.color AS color,
                    I.code AS code,
					SI.url_title as url_title,
					SI.pic_big,
					SI.pic_big_url,
					SI.pic_hd,
					SI.pic_hd_url")
				->join("$this->v_item I", "ListItem.item_id = I.item_id")
				->join("$this->t_showcase_item SI", "ListItem.item_id = SI.item_id")
			;
			$this->where_is_visible('SI');
			$this->db->where("I.archived", 'N');
			$this->db->where("I.archived_product", 'N');
			$this->db->order_by("I.product_name, I.color");
		}
		
		if(!is_null($product_id)){
			$this->db->where("Stock.product_id", $product_id);
		}
		
		;
		return $this->db->get()->result_array();
	}

    function exists_in_list($id, $list_id){
        $this->db
            ->select("ListItem.*")
            ->from("$this->p_list_items ListItem")
            ->join("$this->t_item Item", "ListItem.item_id = Item.id")
            ->where("Item.product_id", $id)
            ->where("ListItem.list_id", $list_id)
        ;
        $q = $this->db->get();
        return ($q->num_rows() > 0);
    }

	
       // Returns the web visibility of an item based on the status
        // Returns a boolean value
        // eg.  $is_web_visible = get_item_web_visiblity($item_id = 4653);
        // eg.  $is_web_visible = get_item_web_visiblity($item_code = '4400-1235');
        //
		function get_item_web_visiblity($item_id = false, $item_code = false) {
			if ($item_id === false) {
				return null; 
			}
			if (strtolower($item_code) == 'd' || strtolower($item_code) == 'dgital') {
				return "is_digital";
			}

            $this->db
		      ->select("status.web_vis as prod_status_website_visibility")
              ->from("$this->p_product_status status")
              ->join("$this->t_item item", "status.id = item.status_id")
              ->where('item.id', $item_id);

            $q = $this->db->get();
 
            // Check for SQL errors
            if ($q === false) {
                // Log the error or display it
                $error = $this->db->error(); // Get the error message
                log_message('error', 'Database error: ' . $error['message']); // Adjust to your logging method
				//$qrystr =  $this->db->get_compiled_select();
				//echo "<pre>get_item_web_visiblity(id)  ";
		        //print_r( $error['message']);
				//print_r( $error);
		        //echo "</pre>";
				exit;
                return null;
            }

            if ($q->num_rows() > 0) {
                $row = $q->row();
                if(isset($row->prod_status_website_visibility)){
                    return $row->prod_status_website_visibility;
                }
                return null;
            } else {
                return null;
            }
        }



}




?>