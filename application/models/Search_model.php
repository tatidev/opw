<?

class Search_model extends MY_Model
{

    /*

    Script for updating the url_title

    function get_items(){
      $this->db->select("A.C_ITEM_ID as id,
                         A.url_title as url_title,
                         B.X_NAME as name,
                         GROUP_CONCAT(DISTINCT D.X_DESC SEPARATOR ' / ') as color")
               ->from('DP_TITEMS A')
               ->join('DP_TSTYLES B', 'A.C_STYLE_ID = B.C_STYLE_ID')
               ->join('DP_TITEMS_COLOR C', 'A.C_ITEM_ID = C.C_ITEM_ID')
               ->join('P_COLOR D', 'C.C_COLOR_ID = D.C_COLOR_ID')
               ->group_by('A.C_ITEM_ID')
               ->order_by('B.X_NAME, A.N_CODE');
      $q = $this->db->get();
      return $q->result_array();
    }

    function update_item($id, $url){
      $this->db->set( array('url_title'=>$url) )
               ->where('C_ITEM_ID', $id)
               ->update('DP_TITEMS');
    }

    */

    function __construct()
    {
        parent::__construct();
    }

    function search_keywords($str)
    {
        $queryString = "
            SELECT Z.*
            FROM (
                (SELECT 'Collection' as g, A.id, A.name
                FROM SHOWCASE_P_COLLECTION AS A
                WHERE A.active = 'Y'
                )
                UNION ALL
                (SELECT 'Colorway' as g, B.id, B.name
                FROM SHOWCASE_P_COORD_COLORS AS B
                WHERE B.active = 'Y'
                )
                UNION ALL
                (SELECT 'Pattern' as g, C.id, C.name
                FROM SHOWCASE_P_PATTERNS AS C
                WHERE C.active = 'Y'
                )
                UNION ALL
                (SELECT 'Content' as g, D.id, D.name
                FROM SHOWCASE_P_CONTENTS_WEB AS D
                WHERE D.active = 'Y'
                )
                UNION ALL
                (SELECT 'Firecode' as g, E.id, E.name
                FROM P_FIRECODE_TEST E
                WHERE E.active = 'Y'
                AND E.name NOT IN ('Not Officially Tested')
                )
                UNION ALL
                (SELECT 'Weave' as g, F.id, F.name
                FROM P_WEAVE AS F
                WHERE F.active = 'Y'
                )
            ) AS Z
        ";

        if (strlen($str) === 0) {
            $params = [];
        } else {
            $params = ["%" . $str . "%"];
            $queryString = $queryString . " WHERE Z.name LIKE ? ";
        }
        $queryString = $queryString . " ORDER BY Z.g;";

        return $this->db->query($queryString, $params)->result_array();
    }

    function search_fabric_by_name($str)
    {
        $this->db->select("
				A.id as id, 
				A.name as name, 
				COUNT(B.id) as cant_items, 
				SP.pic_big as pic_big, 
				SP.pic_big_url as pic_big_url, 
				SP.url_title as url_title")
            ->from("$this->t_product A")
            ->join("$this->t_showcase_product SP", "A.id = SP.product_id")
            ->join("$this->t_item B", "A.id = B.product_id")
            ->join("$this->t_showcase_item SI", "B.id = SI.item_id")
            ->join("$this->t_product_stock S", "B.id = S.master_item_id", 'left outer')
            ->like("A.name", $str)
            ->group_start()
            ->where_not_in("B.status_id", $this->product_status_to_dont_print)
            ->or_where("S.yardsAvailable >=", 10)
            ->group_end()
            ->group_by("A.id")
            ->order_by("A.name");

        $this->where_is_visible("SP");
        $this->where_is_visible("SI");
// 		$this->where_is_not_discontinued('B');
        $this->where_is_not_archived("A");
        $this->where_is_not_archived("B");
        return $this->db->get()->result_array();
    }

    function search_digital_by_name($str)
    {
        $this->db->select("
				A.id as id, 
				A.name as name, 
				COUNT(B.id) as cant_items,
				SS.pic_big as pic_big,
				SS.pic_big_url as pic_big_url,
				SS.url_title")
            ->from("$this->t_digital_style A")
            ->join("$this->t_showcase_style SS", "A.id = SS.style_id")
            ->join("$this->t_showcase_style_items B", " A.id = B.style_id ")
            ->like('A.name', $str)
            ->group_by('A.id')
            ->order_by('A.name');
        $this->where_is_not_archived('A');
        $this->where_is_not_archived('B'); 
        $this->where_is_visible("SS");
        $this->where_is_visible("B");
        return $this->db->get()->result_array();
    }

    function search_digital_gr_by_name($str)
    {
        $this->query_digital_grounds(array(), $str);
        //$this->db->like("A.name", $str);
        return $this->db->get()->result_array();
    }

    function search_item_by_code_or_color($str)
    {
        $this->db->select("
				A.item_id as id, 
				SI.url_title as url_title, 
				A.code as code, 
				A.product_name as name, 
        A.color as color, 
				A.product_id as pattern_id, 
				SI.pic_big as pic_big,
				SI.pic_big_url as pic_big_url,
				SI.pic_hd as pic_hd,
				SI.pic_hd_url as pic_hd_url
				")
//       ->from("$this->t_item A")
            ->from("$this->v_item A")
            ->join("$this->t_showcase_item SI", "A.item_id = SI.item_id")
            ->join("$this->t_showcase_product SP", "A.product_id = SP.product_id")
            ->join("$this->t_product B", 'A.product_id = B.id')
//       ->join("$this->t_item_color C", 'A.id = C.item_id')
//       ->join("$this->p_color D", 'C.color_id = D.id')
            ->join("$this->t_product_stock S", "A.item_id = S.master_item_id", 'left outer')
            ->group_start()
            ->or_like('A.code', $str)
            //       ->or_having('name LIKE', $str)
            ->or_like('A.color', $str)
            ->group_end()
            ->group_start()
            ->where_not_in("A.status_id", $this->product_status_to_dont_print)
            ->or_where("S.yardsAvailable >=", 10)
            ->group_end()
            ->where("A.product_type", Regular)
            ->group_by('A.item_id')
            ->order_by('A.product_name, A.color, A.code');
        $this->where_is_not_archived("A");
        $this->where_is_not_archived("B");
        $this->where_is_visible('SP');
        $this->where_is_visible('SI');
// 		$this->where_is_not_discontinued('A');
        $q = $this->db->get();
        return $q->result_array();
    }

    function search_digital_item_by_code_or_color($str)
    {

        $this->db->select("
				A.id as id, '' as code, 
				B.name as name, 
				GROUP_CONCAT(DISTINCT D.name ORDER BY C.n_order SEPARATOR ' / ') as color, 
				B.id as pattern_id,
				A.pic_big as pic_big,
				A.pic_big_url as pic_big_url,
				'N' as pic_hd,
				'' as pic_hd_url
				")
            ->from("$this->t_showcase_style_items A")
            ->join("$this->t_digital_style B", 'A.style_id = B.id')
            ->join("$this->t_showcase_style SS", "A.style_id = SS.style_id")
            ->join("$this->t_showcase_style_items_color C", 'A.id = C.item_id')
            ->join("$this->p_color D", 'C.color_id = D.id')
            ->group_by('A.id')
            ->having('color LIKE', $str)
            ->order_by('B.name');
        $this->where_is_not_archived("B");
        $this->where_is_visible('A');
        $this->where_is_visible('SS');
        $q = $this->db->get();
        return $q->result_array();
    }
//<<<<<<< HEAD

    function search_collection_by_name($str)
    {
        $this->db
            ->select('U.id, U.name')
            ->from("$this->p_use U")
            ->where(" EXISTS( SELECT 1 FROM $this->t_product_use PU WHERE U.id = PU.use_id ) ")
            ->like('U.name', $str)
            ->order_by('U.name');
        $q = $this->db->get();
        return $q->result_array();
    }

    function search_weaves_by_name($str)
    {
        $this->db->select('W.id as id, W.name as name')
            ->from("$this->p_weave W")
            ->where(" EXISTS( SELECT 1 FROM $this->t_product_weave PW WHERE W.id = PW.weave_id ) ")
            ->like('W.name', $str)
            ->order_by('W.name');
        return $this->db->get()->result_array();
    }

    function search_web_contents_by_name($str)
    {
        $this->db
            ->select('CW.id, CW.name')
            ->from("$this->t_showcase_contents_web CW")
            ->where(" EXISTS( SELECT 1 FROM $this->t_showcase_product_contents_web PCW WHERE CW.id = PCW.content_web_id ) ")
            ->like('CW.name', $str)
            ->order_by('CW.name');
        return $this->db->get()->result_array();
    }

    function search_colorways_by_name($str)
    {
        $this->db
            ->select('CC.id, CC.name')
            ->from("$this->t_showcase_coord_colors CC")
            ->or_where(" EXISTS( SELECT 1 FROM $this->t_showcase_item_coord_color ICC WHERE CC.id = ICC.coord_color_id ) ")
            ->or_where(" EXISTS( SELECT 1 FROM $this->t_showcase_style_items_coord_color SCC WHERE CC.id = SCC.coord_color_id ) ")
            ->like('CC.name', $str)
            ->order_by('CC.name');
        return $this->db->get()->result_array();
    }

    function search_patterns_by_name($str)
    {
        $this->db
            ->select('SP.id, SP.name')
            ->from("$this->t_showcase_patterns SP")
            ->or_where(" EXISTS( SELECT 1 FROM $this->t_showcase_product_patterns SPP WHERE SP.id = SPP.pattern_id ) ")
            ->or_where(" EXISTS( SELECT 1 FROM $this->t_showcase_styles_patterns SSP WHERE SP.id = SSP.pattern_id ) ")
            ->like('SP.name', $str)
            ->order_by('SP.name');
        return $this->db->get()->result_array();
    }

    function search_firecodes_by_name($str, $existProduct=true)
    {
        $this->db
            ->select('SP.id, SP.name')
            ->from("$this->p_firecode SP")
            ->where('LOWER(SP.name)', strtolower($str))
            ->order_by('SP.name');
        if($existProduct){
            $this->db
                ->group_start()
                    ->or_where(" EXISTS( SELECT 1 FROM $this->t_product_firecode SPP WHERE SP.id = SPP.firecode_test_id ) ")
                ->group_end();
        }
        return $this->db->get()->result_array();
    }

    function search_fabric_by_collection($collection_id, $isSPrintGround = false)
    {
        $this->db
            ->select('B.id as id, B.name as name, COUNT(C.id) as cant_items')
            ->from("$this->t_product_weave A")
            ->join("$this->t_product B", 'A.product_id = B.id')
            ->join("$this->t_item C", 'B.id = C.product_id')
            ->join("$this->t_showcase_item SI", "C.id = SI.item_id")
            ->where_in('A.weave_id', $collection_id)
            ->group_by('B.id')
            ->order_by('B.name');
        if ($isSPrintGround) {
            $this->db->where('M_GROUND', 'Y');
        }
        $this->where_is_not_archived("B");
        $this->where_is_not_archived("C");
        $this->where_is_visible("SI");
        return $this->db->get()->result_array();
    }

    function get_under30()
    {
        $this->query_in_list($this->web_list_id['30_under']);
        return $this->db->get()->result_array();
    }

    function get_new_arrivals()
    {
        $list_id = $this->web_list_id['new_arrivals'];
//=======
//		$this->where_is_not_archived("B");
//		$this->where_is_not_archived("C");
//    $this->where_is_visible("SI");
//    return $this->db->get()->result_array();
//  }
//
//  function get_under30(){
//		$this->query_in_list( $this->web_list_id['30_under'] );
//		return $this->db->get()->result_array();
//  }
//
//  function get_new_arrivals(){
//		$list_id = $this->web_list_id['new_arrivals'];
//>>>>>>> new_website
// 		$this->query_in_list( $this->web_list_id['new_arrivals'] );
        $this->db
            ->from("$this->p_list_items LI")
            ->join("$this->t_item C", "LI.item_id = C.id")
            ->join("$this->t_item_color CC", "C.id = CC.item_id")
            ->join("$this->p_color PCC", "CC.color_id = PCC.id")
            ->join("$this->t_showcase_item SI", "LI.item_id = SI.item_id")
            ->join("$this->t_product A", "C.product_id = A.id")
            ->where_in("LI.list_id", $list_id)
            ->where("LI.active", "1")
            ->order_by('A.name')
            ->group_by('A.id');

        $this->where_is_not_archived("A");
        $this->where_is_not_archived("C");
        $this->where_is_visible('SI');

        if (!empty($collectionsId)) {
            $this->db
                ->join("$this->t_showcase_product_collection PC", "PC.product_id = A.id")
                ->where_in("PC.collection_id", $collectionsId);
        }

        return $this->db->get()->result_array();
    }


    /* GET THE COUNT ONLY
       based various visibility conditions
       Status, showcase, Not archived  */
    function get_prod_items_count_by_web_visibility($prod_id = false, $prod_type = 'Regular'){
        if(!$prod_id) return false;
        $this->db->select('COUNT(*) AS visible_items');
        $this->db->from('T_ITEM AS i');
        $this->db->join('T_PRODUCT AS p', 'p.id = i.product_id');
        $this->db->join('SHOWCASE_ITEM AS si', 'si.item_id = i.id');
        $this->db->join('T_ITEM_COLOR AS ic', 'ic.item_id = i.id');
        $this->db->join('P_COLOR AS c', 'c.id = ic.color_id');
        $this->db->join('P_PRODUCT_STATUS AS s', 'i.status_id = s.id');
        $this->db->where('i.product_id', $prod_id);
        $this->db->where('s.web_vis', 1);
        $this->db->where('i.archived', 'N');
        if(strtolower($prod_type) == 'r' || strtolower($prod_type) == 'regular'){
            $this->db->where_not_in('i.code', array('Digital'));
        }
        if(strtolower($prod_type) == 'd' || strtolower($prod_type) == 'digital'){
            $this->db->where_in('i.code', array('Digital'));
        }
        // print the query before executing
        //$qry_str = $this->db->get_compiled_select();
        //echo $qry_str;
        $query = $this->db->get();
        return $query->row_array();
    }




}