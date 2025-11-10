<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Screenprints extends MY_Controller {
  
  
  public function __construct(){
    // Set initial variables
    parent::__construct();
    $this->load->model('screenprints_model', 'model');
  }
  
  /*
    Index for Print Styles
  */
  function index($z=''){
		$this->data['activeMenu'] = 'SCREEN-PRINTS';
		
		$this->add_external_library('head', 'css', asset_url()."others/photoswipe/css/photoswipe.css");
		$this->add_external_library('head', 'css', asset_url().'others/photoswipe/css/default-skin/default-skin.css');
		$this->add_external_library('head', 'js', asset_url().'others/photoswipe/js/photoswipe.min.js');
		$this->add_external_library('head', 'js', asset_url().'others/photoswipe/js/photoswipe-ui-default.min.js');
    $aux = $this->model->get_prints();
    $this->data['printsAll'] = $aux;
    $this->menu_view('screenprints_view');
  }
  
  function view_grounds($collection_id, $title){
		$this->data['activeMenu'] = 'SCREEN-PRINTS';
		
    $this->data['purpose'] = 'sc_grounds';
    array_push($this->data['navigation'], 'Screen-Prints', 'Grounds', $title);
    $this->data['collection_selected'] = $collection_id;
    
    $this->menu_view(['filters_fab', 'product_list']);
  }
  
  // Show all SP Grounds
  function grounds(){
    $this->view_grounds(0, 'View All');
  }
  
  function gr_drapery(){
    $this->view_grounds(21, 'Drapery');
  }
  
  function gr_upholstery(){
    $this->view_grounds(25, 'Upholstery');
  }
  
  /*
    Ajax call for each item
  */
  function get_print(){
    $id = ( isset($_POST['member_id']) ? $this->input->post('member_id') : 0);
		
		if( $id !== 0 ){
			$this->add_product_log( 'screen-print', $this->model->get_print_name($id) );
		}
		
    $ret['print'] = $this->model->get_prints($id);
    echo json_encode($ret);
  }
  
  function get_print_detail(){
    $id = ( isset($_POST['member_id']) ? $this->input->post('member_id') : 0) ;
    
    $imgtypes = array('full_repeat', 'actual_scale', 'additional1', 'additional2');
    $ret['imgs'] = array();
    foreach($imgtypes as $t){
      $src = image_src_path('screenprints', $t).$id.'.jpg';
      $response = get_headers($src);
      //array_push($ret['imgs'], array($src, $file_exists) );
      $file_exists = (strpos($response[0], "200") !== false);
      if( $file_exists ){
        $sizes = getimagesize($src);
        array_push($ret['imgs'], array('src'=>$src,
                                       'id'=>$id,
                                       'w'=>$sizes[0],
                                       'h'=>$sizes[1])
                  );
      }
    }
		
    //$ret['print'] = $this->model->get_prints($id);
    echo json_encode($ret);
  }
  
}