<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_model extends MY_Model {
  
  function __construct(){
  	parent::__construct();
  }
  
  function search_fabric_by_content($content_id){
		/*
    $sql = "SELECT B.C_PATTERN_ID as id, B.X_NAME as name, COUNT(C.C_ITEM_ID) as cant_items
            FROM T_PATTERN_CONTENT_WEB A
            LEFT OUTER JOIN T_PATTERN B ON A.ID_PATTERN = B.C_PATTERN_ID
            LEFT OUTER JOIN T_ITEM C ON A.ID_PATTERN = C.C_PATTERN_ID
            WHERE B.mShow = 'Y' AND (B.FH_ARCHIVE IS NULL OR B.FH_RETRIEVE > B.FH_ARCHIVE) AND A.ID_CONTENT_WEB = ?
            GROUP BY B.C_PATTERN_ID
            ORDER BY B.X_NAME;";
    $q = $this->db->query($sql, array($content_id));
		*/
		$this->db
			->select("B.C_PATTERN_ID as id, B.X_NAME as name, COUNT(C.C_ITEM_ID) as cant_items")
			->from("$this->t_showcase_product_contents_web A")
			->join("$this->t_product B", "A.product_id = B.id")
			->join("$this->t_item C", "A.product_id = C.product_id")
			->where("A.content_web_id", $content_id)
			->group_by("B.id")
			->order_by("B.name");
		$this->where_product_is_visible_and_not_archived("B");
		$this->where_product_is_visible_and_not_archived("C");
    return $this->db->result_array();
  }
  
  function get_content_name($id){
		/*
    $sql = "SELECT X_DESC as name
            FROM P_CONTENT_WEB
            WHERE ID = ?;";
    $q = $this->db->query($sql, array($id));
    if(count($q) > 0){
      $row = $q->row();
      return $row->name;
    } else {
      return '';
    }
		*/
		$this->db
			->select("name")
			->from($this->t_showcase_contents_web)
			->where("id", $id)
            ->where("active", "Y");
		$row = $this->db->get()->row();
		return $row->name;
  }
  
  function search_content_by_name($name){
		/*
    $this->db->select('id')
             ->from('P_CONTENT_WEB')
             ->where('X_DESC', $name);
    $q = $this->db->get();
    if($q->num_rows() > 0){
      $row = $q->row();
      return $row->id;
    } else {
      return null;
    }
		*/
		$this->db
			->select('id')
			->from($this->t_showcase_contents_web)
			->where("name", $name);
		$row = $this->db->get()->row();
		return $row->id;
  }
  
}