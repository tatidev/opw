<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Colorway extends MY_Controller {
  
  
  public function __construct(){
    // Set initial variables
    parent::__construct();
    $this->load->model('colorway_model', 'model');
    $this->data['navigation'][0] = 'Colors';
	  $this->data['SpecBaseUrl'] = $this->model->SpecBaseUrl;
  }
  
  function index($z=''){
    $id = $this->input->post('member_id');
    $category = 'fabrics_items';
    $valid = true;
    
    // Only if it's a URI call
    if( null == $id ){
      /*
        Call by URI
        Start
      */
      $uri = explode('/', uri_string());
      if( isset($uri[1]) ){
        $str = str_replace('-', '/', $uri[1] );
        $id = $this->model->search_for_id($str);
      }
      /*
        End URI process
      */
    }
    
    if( null !== $id ){
		  $this->data['activeMenu'] = 'FABRICS';
      
      $title = $this->model->get_colorway_name($id);
      array_push($this->data['navigation'], $title);
      $aux = $this->model->search_items_by_colorway($id);
			foreach( $aux as $key => $value ){
				// Process Big image
				if( !is_null($aux[$key]['pic_big_url']) ){
					// Keep as it is
				} else if ( !is_null($aux[$key]['pic_big']) && $aux[$key]['pic_big'] !== 'N' ){
					$aux[$key]['pic_big_url'] = image_src_path($category, 'big').$aux[$key]['id'].'.jpg';
				} else {
					$aux[$key]['pic_big_url'] = placeholder_image('thumb');
				}
				// Process HD image
				if( !is_null($aux[$key]['pic_hd_url']) ){
					// Keep as it is
				} else if ( !is_null($aux[$key]['pic_hd']) && $aux[$key]['pic_hd'] !== 'N' ){
					$aux[$key]['pic_hd_url'] = image_src_path($category, 'hd').$aux[$key]['id'].'.jpg';
				} else {
					$aux[$key]['pic_hd_url'] = '';
				}
			}
      $aux['purpose'] = $category;
      $aux['title'] = ''; // to hide a secondary menu that is in the view
      array_push($this->data['colors_arr'], $aux);

      $this->menu_view('colorway_list', $this->data);
    } else {
      $this->show_404();
    }
    /*
      Index End
    */
  }
  
}