<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pattern extends MY_Controller {
  
  
  public function __construct(){
    // Set initial variables
    parent::__construct();
    $this->load->model('pattern2_model', 'model');
	  $this->data['level'] = product;
	  $this->data['SpecBaseUrl'] = $this->model->SpecBaseUrl;
      $this->data['navigation'][0] = 'Collection';
      $this->data['level'] = product;
  }
  
  function index($z=''){
    $id = $this->input->post('member_id');
    $category = $this->input->post('category');
      $category = (strlen($category) > 0 ? $category : 'fabrics');
    $valid = true;
    
    // Only if it's a URI call
    if( null == $id ){
      /*
        Call by URI
        Start
      */
      $uri = explode('/', uri_string());
      if($uri[0] == 'digital'){
        $category = 'digital_styles';
        $str = $uri[1];
      }else {
        $category = 'fabrics';
        $str = $uri[1];
      }
      
      if( isset($uri[1]) ){
        
        if( $uri[1] == 'view-all' ){
          $id = '0';
        } else {
          $str = str_replace('-', ' ', $str );
          $id = $this->model->search_for_id($str, $category);
        }
        
      }
    }
      /*
        End URI processing
      */
//      var_dump(uri_string()); var_dump($id); var_dump($category); exit();
    
    if( null !== $id ){
      switch($category){
        case 'fabrics':
		      $this->data['activeMenu'] = 'FABRICS';
          
          $title = $this->model->get_pattern_name_fabrics($id);
          array_push($this->data['navigation'], 'Patterns', $title);
          $this->data['purpose'] = $category;
          $this->data['pattern2_selected'] = $id;
          break;
        case 'digital_styles':
        	$this->data['activeMenu'] = 'DIGITAL PRINTS';
          $title = ( $id !== '0' ? $this->model->get_pattern_name_digital($id) : 'View All');
          array_push($this->data['navigation'], 'Digital', 'Patterns', $title);
          $this->data['purpose'] = $category;
          $this->data['pattern2_selected'] = $id;
          break;
      }
      $this->menu_view(['filters_fab', 'product_list'], $this->data);
    } else {
      $this->show_404();
    }
    
  }
  
}