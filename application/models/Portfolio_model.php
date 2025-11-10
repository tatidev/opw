<?
class Portfolio_model extends MY_Model {
  
  function __construct(){
		parent::__construct();
  }
  
  function get_pictures(){
		/*
    $sql = "SELECT id, NAME as alt
            FROM 
            WHERE mShow = 'Y'
            ORDER BY nOrder DESC;";
						*/
		$q = $this->db
			->select("id, name as alt")
			->from($this->t_showcase_press)
			->where("visible", 'Y')
			->order_by("n_order", "desc")
			->get();
    //$q = $this->db->query($sql, array());
    return $q->result_array();
  }
  
}

?>