<?
class Pattern2_model extends MY_Model {
  
  function __construct(){
    parent::__construct();
  }
  
	function search_for_id($str, $category){
		/*
		switch($category){
			case 'fabrics':
				$t_table = 'P_PATTERN2 A';
				$c_id = 'A.C_PATTERN2';
				break;
			case 'digital_styles':
				$t_table = 'DP_TCATEGORIES A';
				$c_id = 'A.C_CATEGORY_ID';
				break;
		}
		
		$this->db->select($c_id.' as id')
						 ->from($t_table)
						 ->where('A.X_NAME', $str);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			$row = $q->row();
			return $row->id;
		} else {
			return null;
		}
		*/
		$this->db->select('id')
						 ->from($this->t_showcase_patterns)
						 ->where('name', $str)
                         ->where("active", "Y");
		$row = $this->db->get()->row();
		return $row->id;
	}
  
  function search_fabric_by_pattern($pattern_id){
		/*
    $sql = "SELECT B.C_PATTERN_ID as id, B.X_NAME as name, COUNT(C.C_ITEM_ID) as cant_items
            FROM T_PATTERN_PATTERN2 A
            LEFT OUTER JOIN T_PATTERN B ON A.C_PATTERN = B.C_PATTERN_ID
            LEFT OUTER JOIN T_ITEM C ON A.C_PATTERN = C.C_PATTERN_ID
            WHERE B.mShow = 'Y' AND (B.FH_ARCHIVE IS NULL OR B.FH_RETRIEVE > B.FH_ARCHIVE) AND A.C_PATTERN2 = ?
            GROUP BY B.C_PATTERN_ID
            ORDER BY B.X_NAME;";
    $q = $this->db->query($sql, array($pattern_id));
		*/
		$this->db
			->select("B.id as id, B.name as name, COUNT(C.id) as cant_items")
			->from("$this->t_showcase_product_patterns A")
			->join("$this->t_product B", "A.product_id = B.id")
			->join("$this->t_item C", "A.product_id = C.product_id")
			->where("A.pattern_id", $pattern_id)
			->group_by('B.id')
			->order_by("B.name");
		$this->where_product_is_visible_and_not_archived('B');
		//$this->where_product_is_visible_and_not_archived('C');
    return $this->db->get()->result_array();
  }
  
  function search_digital_by_pattern($pattern_id){
		/*
    $sql = "SELECT B.C_STYLE_ID as id, B.X_NAME as name, COUNT(C.C_ITEM_ID) as cant_items
            FROM DP_TSTYLES_PATTERN2 A
            LEFT OUTER JOIN DP_TSTYLES B ON A.C_PATTERN = B.C_STYLE_ID
            LEFT OUTER JOIN DP_TITEMS C ON A.C_STYLE_ID = C.C_STYLE_ID
            WHERE B.mShow = 'Y' AND (B.FH_ARCHIVE IS NULL OR B.FH_RETRIEVE > B.FH_ARCHIVE) AND A.C_PATTERN2 = ?
            GROUP BY B.C_STYLE_ID
            ORDER BY B.X_NAME;";
    $q = $this->db->query($sql, array($pattern_id));
    return $q->result_array();
		*/
		$this->db
			->select("B.id as id, B.name as name, COUNT(C.id) as cant_items")
			->from("$this->t_showcase_styles_patterns A")
			->join("$this->t_digital_style B", "A.style_id = B.id")
			->join("$this->t_showcase_style_items C", "A.style_id = C.style_id")
			->where("A.pattern_id", $pattern_id)
			->group_by("B.id")
			->order_by("B.name");
		$this->where_product_is_visible_and_not_archived("B");
		return $this->db->get()->result_array();
  }
  
  function get_pattern_name_fabrics($id){
		/*
    $sql = "SELECT X_NAME as name
            FROM P_PATTERN2
            WHERE C_PATTERN2 = ?;";
    $q = $this->db->query($sql, array($id));
    $row = $q->row();
    return $row->name;
		*/
		$this->db
			->select("name")
			->from($this->t_showcase_patterns)
			->where("id", $id)
            ->where("active", "Y");
		$row = $this->db->get()->row();
		return $row->name;
  }
  
  function get_pattern_name_digital($id){
		/*
    $sql = "SELECT X_NAME as name
            FROM DP_TCATEGORIES
            WHERE C_CATEGORY_ID = ?;";
    $q = $this->db->query($sql, array($id));
    $row = $q->row();
    return $row->name;
		*/
		return $this->get_pattern_name_fabrics($id);
  }
  
}