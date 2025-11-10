<?
class Screenprints_model extends MY_Model {
  
  function __construct(){
    // Set initial variables
    parent::__construct();
  }
  
  function get_prints($id=0){
    $this->db->select("
			A.id as id, A.name as name, SS.descr as comment, A.width as width, A.height as height, A.hrepeat as hrepeat, A.vrepeat as vrepeat, SS.descr as comment
			")
			->from("$this->t_screenprint_style A")
			->join("$this->t_showcase_screenprint SS", "A.id = SS.style_id")
			->order_by('A.name');
    if($id !== 0){
      $this->db->where('A.id', $id);
    }
		$this->where_is_visible("SS");
		$this->where_is_not_archived("A");
    $q = $this->db->get();
    return $q->result_array();
  }
  
  function get_print_name($id=0){
    $this->db
			->select('A.name as name')
			->from("$this->t_screenprint_style A")
			->order_by('A.name')
			->where('A.id', $id);
    $q = $this->db->get();
    $r = $q->row();
    return $r->name;
  }
  
  function where_print_is_not_hidden_or_deleted($tbl){
    $this->db->where($tbl.'.mShow', 'Y')
             ->where($tbl.'.DELETED', 'N');
  }
  
  
  
}