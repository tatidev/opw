<?
class Digital_grounds_model extends MY_Model {
  
  function __construct(){
    // Set initial variables
    parent::__construct();
  }
	
	function search_for_id($str){
		
		$this->db->select('A.C_STYLE_ID as id')
						 ->from('DP_GROUNDS A')
						 ->where('A.url_title', $str);
		$this->where_product_is_visible_dp_ground('A');
		//return $this->db->get_compiled_select();
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0){
			$row = $q->row();
			return $row->id;
		} else {
			return null;
		}
		
	}
	
	function is_valid_product_id($id){
		$this->db->select('*')
						 ->from('DP_GROUNDS A')
						 ->where('A.mShow', 'N') // DONT CHANGE! in this table the mShow is INVERTED !!!!
						 ->where('A.C_STYLE_ID', $id);
		$this->where_product_is_visible_dp_ground('A');
    //$this->where_product_is_visible_and_not_archived('A');
		$q = $this->db->get();
		return ($q->num_rows() > 0);
	}
  
  /*
    Only used for the Digital/get_ground_info() call
  */
  function get_digital_ground_info($id){
    $this->db->select('A.C_STYLE_ID as id, A.url_title as url_title, A.X_NAME as name, A.X_COLOR as color, A.N_CODE as code, A.N_WIDTH as width, A.N_VREPEAT as vrepeat, A.N_HREPEAT as hrepeat, B.X_DESC as weight, C.X_NAME as cleaning')
             ->from('DP_GROUNDS A')
             ->join('DP_GROUNDS_WEIGHTS B', 'A.C_WEIGHT_ID = B.C_WEIGHT_ID')
						 ->join('P_CLEANING_CODE C', 'A.C_CLEANING_ID = C.C_CLEANING_ID')
             ->where('A.C_STYLE_ID', $id);
		$this->where_product_is_visible_dp_ground('A');
    $q = $this->db->get();
    return $q->row_array();
  }
  
  function get_digital_ground_content($id=''){
    $sql = "SELECT CASE B.X_DESC
                   WHEN 'N/A'
                   THEN B.X_DESC
                   ELSE CONCAT( C.N_PERCENTAGE, '% ', B.X_DESC )
                   END AS DESCR
            FROM P_TYPE_CONTENT B, DP_GROUNDS_CONTENT C
            WHERE C.C_CONTENT_ID = B.C_TIPE_CONTENT_ID 
              AND C.C_STYLE_ID = ? 
            ORDER BY C.N_PERCENTAGE DESC, B.X_DESC;";
		$q = $this->db->query($sql, array($id));
    return $q->result_array();
  }
  
  function get_digital_ground_abrasion($id){
    $sql = 'SELECT A.X_DESC as DESCR
            FROM P_ABRASION A, DP_GROUNDS_ABRASION B 
            WHERE A.C_ABRASION_ID = B.C_ABRASION_ID 
              AND B.C_STYLE_ID = ?
            ORDER BY A.X_DESC;';
    $q = $this->db->query($sql, array($id));
    return $q->result_array();
  }
  
  function get_digital_ground_firecodes($id){
    $sql = 'SELECT A.X_NAME AS DESCR 
            FROM P_FIRE_CODE A, DP_GROUNDS_FIRECODE B 
            WHERE A.C_FIRECODE_ID = B.C_FIRECODE_ID 
              AND B.C_STYLE_ID = ? ORDER BY A.X_NAME';
    $q = $this->db->query($sql, array($id));
    return $q->result_array();
  }
	
      function where_product_is_visible_dp_ground($table){
        $this->db->where($table.'.mShow', 'N');
      }
  
}