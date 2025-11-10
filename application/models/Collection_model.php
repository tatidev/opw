<?
class Collection_model extends MY_Model {

    function __construct(){
        parent::__construct();
    }

//    function search_fabric_by_collection($id){
//        $sql = "SELECT B.C_PATTERN_ID as id, B.X_NAME as name, COUNT(C.C_ITEM_ID) as cant_items
//            FROM T_PATTERN B
//            LEFT OUTER JOIN T_ITEM C ON B.C_PATTERN_ID = C.C_PATTERN_ID
//            WHERE B.mShow = 'Y' AND (B.FH_ARCHIVE IS NULL OR B.FH_RETRIEVE > B.FH_ARCHIVE) AND B.C_WEAVE_ID = ?
//            GROUP BY B.C_PATTERN_ID
//            ORDER BY B.X_NAME;";
//        $q = $this->db->query($sql, array($id));
//        return $q->result_array();
//    }

    function get_collection_name($id){
        $this->db
            ->select('name')
            ->from($this->t_showcase_collection)
            ->where("id", $id);
        $q = $this->db->get();
        $row = $q->row();
        return $row->name;
    }

    function search_collection_by_name($name){
        $this->db->select('id')
            ->from($this->t_showcase_collection)
            ->where('LOWER(name)', $name);
        $q = $this->db->get();
        if($q->num_rows() > 0){
            $row = $q->row();
            return $row->id;
        } else {
            return null;
        }
    }

    /*
     * Get all the showcase items in a collection
     * @param $list_id int
     * @param $collection_id int  (32)
     * @return array
     * 
     * This quary also indicates if an item is new
     * by checking if the item is in the list 234
     * 
     */
             
    function search_showcase_items_in_collection($collection_id){
        $this->db->select("
          p.id as id, 
          p.name as name, 
          (
              SELECT COUNT(sub_i.id) 
              FROM T_ITEM sub_i 
              JOIN SHOWCASE_ITEM sub_si ON sub_i.id = sub_si.item_id
              WHERE sub_i.product_id = p.id 
                AND sub_i.product_type = 'R' 
                AND sub_i.archived = 'N' 
                AND sub_si.visible = 'Y'
          ) as cant_items, 
          COUNT(i.id) as cant_items_in_list, 
          SP.url_title as url_title, 
          SP.pic_big as pic_big, 
          SP.pic_big_url as pic_big_url,
          CASE WHEN NEWS.id IS NULL THEN 0 ELSE 1 END as is_new
      ", false);
      
      $this->db->from('T_PRODUCT p');
      $this->db->join('SHOWCASE_PRODUCT SP', 'p.id = SP.product_id', 'inner');
      $this->db->join('T_ITEM i', 'p.id = i.product_id', 'inner');
      $this->db->join('SHOWCASE_ITEM SI', 'i.id = SI.item_id', 'inner');
      $this->db->join(
          '(SELECT DISTINCT Item.product_id as id
              FROM Q_LIST_ITEMS ListItems
              JOIN T_ITEM Item ON ListItems.item_id = Item.id
              WHERE ListItems.list_id = 234) NEWS',
          'p.id = NEWS.id',
          'left'
      );
      $this->db->join('SHOWCASE_PRODUCT_COLLECTION spc', 'p.id = spc.product_id', 'inner');
      
      $this->db->where('SP.visible', 'Y');
      $this->db->where('SI.visible', 'Y');
      $this->db->where_not_in('i.status_id', [2, 3]);
      $this->db->where('p.archived', 'N');
      $this->db->where('i.archived', 'N');
      $this->db->where_in('spc.collection_id', [$collection_id]);
      $this->db->group_by('p.id');
      $this->db->order_by('p.name');
      $query = $this->db->get();
      $result = $query->result_array(); // Fetch the result as an array 
      return $result;       
    }



}