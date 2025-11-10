<?
class Colorway_model extends MY_Model {
  
  function __construct(){
    parent::__construct();
  }
  
  function search_for_id($str){
    $this->db->select('id as id')
             ->from($this->t_showcase_coord_colors)
             ->where('active', 'Y')
             ->where('name', $str);
    $q = $this->db->get();
    if($q->num_rows() > 0){
      $row = $q->row();
      return $row->id;
    } else {
      return null;
    }
  }
  
  function search_items_by_colorway($colorway_id){
		/*
    $sql = "SELECT B.C_PATTERN_ID as pattern_id,
                   A.url_title as url_title,
                   A.C_ITEM_ID as id, 
                   A.N_CODE as code, 
                   B.X_NAME as name, 
                   GROUP_CONCAT(DISTINCT D.X_DESC SEPARATOR ' / ') as color, 
                   A.pic_hd
            FROM $this->t_showcase_item_coord_color Z
            LEFT OUTER JOIN $this->t_item A ON Z.item_id = A.id
						LEFT OUTER JOIN $this->t_showcase_item SI ON Z.item_id = SI.item_id
            LEFT OUTER JOIN $this->t_product B ON A.product_id = B.id
            LEFT OUTER JOIN $this->t_item_color C ON A.id = C.item_id
            LEFT OUTER JOIN $this->p_color D ON C.color_id = D.id
            WHERE A.archived = 'N' AND SI.visible = 'Y' AND B.mShow = 'Y' AND Z.C_COORD_COLOR_ID = ?
            GROUP BY A.C_ITEM_ID
            ORDER BY B.X_NAME, A.N_CODE;";
		*/
    //$q = $this->db->query($sql, array($colorway_id));
		$this->db
			->select("
				B.id as pattern_id,
				SI.url_title as url_title,
        A.id as id, 
        A.code as code, 
        B.name as name, 
        GROUP_CONCAT(DISTINCT D.name SEPARATOR ' / ') as color,
				SI.pic_big,
				SI.pic_big_url,
        SI.pic_hd,
				SI.pic_hd_url
				")
			->from("$this->t_showcase_item_coord_color Z", false)
			->join("$this->t_item A", "Z.item_id = A.id")
			->join("$this->t_showcase_item SI", "Z.item_id = SI.item_id")
            ->join("$this->t_showcase_product ZP", "A.product_id = ZP.product_id")
			->join("$this->t_product B", "A.product_id = B.id")
			->join("$this->t_item_color C", "A.id = C.item_id")
			->join("$this->p_color D", "C.color_id = D.id")
			->where("Z.coord_color_id", $colorway_id)
            ->where_not_in("A.status_id", $this->product_status_to_dont_print)
			->group_by("A.id")
			->order_by("B.name, A.code");
		$this->where_is_not_archived('A');
		$this->where_is_not_archived('B');
		$this->where_is_visible('SI');
        $this->where_is_visible('ZP');
    return $this->db->get()->result_array();
  }
  
  function get_colorway_name($id){
		/*
    $sql = "SELECT X_DESC as name
            FROM P_COORD_COLOR
            WHERE C_COORD_COLOR_ID = ?;";
    $q = $this->db->query($sql, array($id));
		$row = $q->row();
		*/
		$this->db
			->select("name")
			->from($this->t_showcase_coord_colors)
			->where("id", $id)
            ->where('active', 'Y');
    $row = $this->db->get()->row();
    return $row->name;
  }
  
}