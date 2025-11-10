<?
class Weave_model extends MY_Model {
  
  function __construct(){
    parent::__construct();
  }
  
  function search_fabric_by_weave($weave_id){
    $sql = "SELECT B.C_PATTERN_ID as id, B.X_NAME as name, COUNT(C.C_ITEM_ID) as cant_items
            FROM T_PATTERN B
            LEFT OUTER JOIN T_ITEM C ON B.C_PATTERN_ID = C.C_PATTERN_ID
            WHERE B.mShow = 'Y' AND (B.FH_ARCHIVE IS NULL OR B.FH_RETRIEVE > B.FH_ARCHIVE) AND B.C_WEAVE_ID = ?
            GROUP BY B.C_PATTERN_ID
            ORDER BY B.X_NAME;";
    $q = $this->db->query($sql, array($weave_id));
    return $q->result_array();
  }
  
  function get_weave_name($id){
		$this->db
			->select('name')
			->from($this->p_weave)
            ->where("active", "Y")
			->where("id", $id);
    $q = $this->db->get();
    $row = $q->row();
    return $row->name;
  }
  
  function search_weave_by_name($name){
    $this->db->select('id')
             ->from($this->p_weave)
             ->where('name', $name);
    $q = $this->db->get();
    if($q->num_rows() > 0){
      $row = $q->row();
      return $row->id;
    } else {
      return null;
    }
  }
  
}