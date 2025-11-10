<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Digital extends MY_Controller {
  
  
  public function __construct(){
    // Set initial variables
    parent::__construct();
    $this->load->model('Product_model', 'model');
    $this->data['level'] = product;
	  $this->data['SpecBaseUrl'] = $this->model->SpecBaseUrl;
  }
  
  /*
    Index for Print Styles
  */
  function index($z=''){
    
  }
  
  function view_grounds($collection_id, $title){
		$this->data['activeMenu'] = 'DIGITAL PRINTS';
    
    $this->data['purpose'] = 'digital_grounds';
    array_push($this->data['navigation'], 'Digital', 'Grounds', $title);
    $this->data['collection_selected'] = $collection_id;
    $this->menu_view(['filters_fab', 'product_list_digital_ground']);
//    $this->menu_view('product_list');
  }
  
  // Show all Digital Grounds
  function grounds(){
    $this->view_grounds(0, 'View All');
  }
  
  function gr_drapery(){
    $this->view_grounds(21, 'Drapery');
  }
  
  function gr_upholstery(){
    $this->view_grounds(25, 'Upholstery');
  }
  
  function gr_sheers(){
    $this->view_grounds(23, 'Sheers');
  }
  
  function ground_specsheet($uriname=''){
      // Evaluate $uriname
      if( is_int($uriname) ){ // If it's an integer already
        $id = $uriname;
      } else {
        // If it's a string
        $id = $this->model->search_for_id($uriname);
      }
    
    if( $this->model->is_valid_product_id($id) ){ // Checks if the product is not ARCHIVED or hidden
      $this->collectDataDigitalGround($id);
      $this->data['specType'] = 'items';//'digital_grounds';
      
      // Process the correct data for the spec sheet
      $this->data['id'] = $this->data['ret']['result']['id'];
      $this->data['product_name'] = $this->data['ret']['result']['name'];
      
      $this->data['item_data'] = array( 'type' => 'digital_grounds',
                                        'id' => $this->data['id'],
                                        'name' => $this->data['ret']['result']['name'],
                                        'color' => $this->data['ret']['result']['color'],
                                        'code' => $this->data['ret']['result']['code']
                                        //'weight' => $this->data['ret']['result'][0]['weight']
                                      );
      $this->data['spec'] = $this->data['ret']['spec'];
    }
    $this->load->view('spec_sheet_print', $this->data);
  }
  
  /*
    Ajax call
  */
  
  function get_ground_info(){
    $id = $this->input->post('member_id');
	  $this->data['purpose'] = 'digital_grounds';
    $this->collectDataDigitalGround($id);
    $ret['html'] = $this->load->view('digital_ground_modal_content', $this->data, true);
    echo json_encode($ret);
  }
  
  /*
    Function to collect the data either for the Ajax call or the Specsheet
  */
  
  function collectDataDigitalGround($item_id){
		$this->load->model('Product_model', 'model');
		
    if( $this->model->is_valid_item_id($item_id) ){ // Checks if the items is not hidden or discontinued
      $this->data['specType'] = 'items';
      $item_data = $this->model->get_item_data($item_id);
      $item_data['type'] = 'fabrics_items';
			$pid = $item_data['product_id'];
			$ret['result'] = $this->model->get_pattern_spec($pid, 'fabrics');
			$item_data = array_merge($item_data, array('name'=>$ret['result']['NAME']));
      $this->data['item_data'] = $item_data;
		} else {
			return;
		}
		
    //$ret['result'] = $this->model->get_digital_ground_info($id);
    $this->add_product_log( 'digital-ground', $ret['result']['NAME'] . ' ' . $item_data['color'] );
    $this->data['spec'] = array();
    
    $this->data['downloadSrc'] = image_src_path('digital_grounds', 'big').$item_id.'.jpg';
//    $this->data['specSrc'] = site_url('item/specsheet/'.$item_data['url_title']);
    $this->data['specSrc'] = $this->model->SpecBaseUrl . $item_data['url_title'];
    $this->data['shareUrl'] = "mailto: ?subject=I'd%20like%20to%20share%20an%20Opuzen%20fabric%20with%20you&amp;body=Hi%2C%0A%0AI%20thought%20you%20might%20be%20interested%20in%20this%20item%20from%20Opuzen%3A%0A%0A" . site_url( 'digital/grounds/all') . '#' . $item_data['url_title'] . "%0A%0ABest%2C";
    $this->data['imgUrl'] = image_src_path('digital_grounds', 'big') . $item_id . '.jpg';
		
        // Weight/Use
        $aux = $this->model->get_fabric_use($pid);
        if($this->is_valid_spec_arr($aux)){
          $a = array();
          foreach($aux as $b){
            array_push($a, $b['DESCR']);
          }
          $aux = array('text'=>'Use', 'data'=>$a);
          array_push($this->data['spec'], $aux);
        }
		
        // Cleaning
        $aux = $this->model->get_fabric_cleaning($pid);
        if($this->is_valid_spec_arr($aux)){
          $a = array();
          foreach($aux as $b){
            array_push($a, $b['DESCR']);
          }
          $aux = array('text'=>'Cleaning', 'data'=>$a);
          array_push($this->data['spec'], $aux);
        }
    
        // Front Content
        $aux = $this->model->get_fabric_content($pid);
        if($this->is_valid_spec_arr($aux)){
          $a = array();
          foreach($aux as $b){
            array_push($a, $b['DESCR']);
          }
          $aux = array('text'=>'Face Content', 'data'=> str_replace('.00', '', $a) );
          array_push($this->data['spec'], $aux);
        }
        
    
        // Abrasion
        $aux = $this->model->get_fabric_abrasion($pid);
        if($this->is_valid_spec_arr($aux)){
          $a = array();
          foreach($aux as $b){
            array_push($a, $b['DESCR']);
          }
          $aux = array('text'=>'Abrasion', 'data'=>$a);
          array_push($this->data['spec'], $aux);
        }
        
        // Firecodes
        $aux = $this->model->get_fabric_firecodes($pid);
        if($this->is_valid_spec_arr($aux)){
          $a = array();
          foreach($aux as $b){
            array_push($a, $b['DESCR']);
          }
          $aux = array('text'=>'Fire Rating', 'data'=>$a);
          array_push($this->data['spec'], $aux);
        }
        
		
  }
  
}