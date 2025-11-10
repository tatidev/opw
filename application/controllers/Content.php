<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends MY_Controller {
  
  public function __construct(){
    // Set initial variables
    parent::__construct();
    $this->load->model('content_model', 'model');
    $this->data['navigation'][0] = 'Contents';
	  $this->data['level'] = product;
	  $this->data['SpecBaseUrl'] = $this->model->SpecBaseUrl;
  }
  
  function index($z=''){
    $id = $this->input->post('member_id');
    $valid = true;
    $category = 'fabrics'; // There doesn't exists Digital Styles with a different content types
    
    // Only if it's a URI call
    if( null == $id ) {
      /*
        Call by URI
      */
      $uri = explode('/', uri_string());
      if( isset($uri[1]) ){
        $str = str_replace('-', ' ', $uri[1] );
        $id = $this->model->search_content_by_name($str);
      }
      /*
        End URI process
      */
    }
    
    if( null !== $id ){
      switch($category){
        case 'fabrics':
		      $this->data['activeMenu'] = 'FABRICS';
          $title = $this->model->get_content_name($id);
          array_push($this->data['navigation'], $title);
          $this->data['purpose'] = $category;
          $this->data['content_selected'] = $id;
          break;
      }
      $this->menu_view(['filters_fab', 'product_list']);
    } else {
      // Invalid call
      $this->show_404();
    }
    /*
      Index End
    */
  }
  
}

?>