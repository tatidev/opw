<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection extends MY_Controller {

  public function __construct(){
    // Set initial variables
    parent::__construct();
      $this->load->model('search_model', 'model');
      $this->load->model('collection_model', 'collection_model');
	  $this->data['SpecBaseUrl'] = $this->model->SpecBaseUrl;
      $this->data['navigation'][0] = 'Collection';
      $this->data['level'] = product;
  }

  public function index($collName){
//      $id = $this->input->post('member_id');
      $category = 'fabrics'; // There doesn't exists Digital Styles with a Collection type
      $valid = true;

      $collName = str_replace('-', ' ', $collName);
      $collection_id = $this->collection_model->search_collection_by_name($collName);

      if(null !== $collection_id){

          switch($category){
              case 'fabrics':
                  $template_vars = [];
                  $this->data['activeMenu'] = 'FABRICS';
                  $template_addons = ['filters_fab', 'product_list'];
                  $title = $this->collection_model->get_collection_name($collection_id);
                  array_push($this->data['navigation'], $title);
                  $this->data['purpose'] = $category;
                  $this->data['collection_selected'] = $collection_id;
                  // special cases
                  if ($collection_id == 32) {
                      $items = $this->collection_model->search_showcase_items_in_collection($collection_id);
                      $items = $this->process_colelction_items($items);
                      $template_addons = ['filters_fab', 'product_list_slayman'];
                      $template_vars = ['mode' => 'pre_searched','items' => $items];
                  }
                  break;
          }
          $this->menu_view($template_addons, $template_vars);

      } else {
          // Items not found!
          // Show screen for item not found
          //
          $this->show_404();
      }
  }
 
  function process_colelction_items($items){
     $data = [];
     foreach($items as $k => $item){
         $data[$k] = [
             'id' => $item['id'],
             'name' => $item['name'],
             'cant_items' => $item['cant_items'],
             'url_title' => $item['url_title'],
             'pic_big' => $item['pic_big'],
             'pic_big_url' => $item['pic_big_url'],
             'is_new' => $item['is_new'],
             'thumb_src' => FALSE
         ];
         // check for thumb image existence
         //$s3imageUriPrefix = 'https://opuzen-site-assets.s3.us-west-1.amazonaws.com/images';
         $s3imageUriPrefix = 'https://opuzen-web-assets-public.s3.us-west-1.amazonaws.com/showcase/images';
         $thumnailUri = $s3imageUriPrefix . '/thumbs/thumb-'.$data[$k]['id'] . '.jpg';
         $is_new_sticker_src = $s3imageUriPrefix . '/stickers/is_new_sticker.png';
         $data[$k]['img_src'] = $item['pic_big_url'];
         //if($this->checkImageExists($thumnailUri)){
             $data[$k]['thumb_src'] = $thumnailUri;
             $data[$k]['img_src'] = $thumnailUri;
         //}
         // set color text
         if (intval($data[$k]['cant_items']) > 0) {
           $data[$k]['colors_text'] = ' color' . ($data[$k]['cant_items'] > 1 ? 's' : '');
         } else {
           $data[$k]['colors_text'] = '';
         }    
         // Set is new or not
         $data[$k]['is_new'] = (key_exists('is_new', $data[$k]) && $data[$k]['is_new'] == '1') ? True : False;
         $data[$k]['isNew_sticker_elem'] = '';
         if($data[$k]['is_new']){
          $data[$k]['isNew_sticker_elem'] = '<span class="is_new_sticker">';
          $data[$k]['isNew_sticker_elem'] .= '<img src="'. $is_new_sticker_src.'" style="position:absolute;right:0;margin:10px;width:40px;height:auto;">';
          $data[$k]['isNew_sticker_elem'] .= '</span>';
         }

         // create thumnail_img
         // build thumbnail_inmg bas on the following...
         $thumbnail_img  = '<img ';
         $thumbnail_img .= 'src="'.$data[$k]['img_src'] .'" ';
         //$thumbnail_img .= 'data-id="'.$data[$k]['id'].'" ';
         $thumbnail_img .= 'alt="'.$data[$k]['name'].'" ';
         //$thumbnail_img .= 'class="img-fluid image-preview mx-auto" '; 
         //$thumbnail_img .= 'data-name="'.$data[$k]['url_title'].'" '; 
         //$thumbnail_img .= 'data-category="fabrics" '; 
         //$thumbnail_img .= 'style="background-color: grey; width: 230px; height: 107px;" ';
         //$thumnail_img .= 'data-src="'.$data[$k]['img_src'].'" >';
         $thumbnail_img .= 'alt="Image description" ';
         $thumbnail_img .= '/>';

         //$imgSpanId = in_array($data[$k]['url_title'], ['logo', 'home', 'about', 'contact']) ? 'anchor_elem' : $data[$k]['url_title'];
         $imgSpanId = '';
         $data[$k]['thumnail_img_elem'] = $thumbnail_img;
         $href = site_url('product/' . $data[$k]['url_title']);
         $data[$k]['thumnail_img_elem_with_span'] = '<span class="anchor_elem" id="'. $imgSpanId .'" ></span><a href="'.$href.'" >'.$thumbnail_img.'</a>';
     }
     return $data;
  }

  /*
    Common View
  */
  
  function collection_view($collection_id, $title){
		$this->data['activeMenu'] = 'FABRICS';
    
    $this->data['purpose'] = 'fabrics';
    $this->data['level'] = product;
    array_push($this->data['navigation'], 'Fabrics', $title);
    $this->data['category_selected'] = $this->data['purpose'];
    $this->data['collection_selected'] = $collection_id;
    $this->menu_view(['filters_fab', 'product_list']);
  }
  
  //function collection_view_slayman($collection_id, $title){
	//	$this->data['activeMenu'] = 'FABRICS';
  //  
  //  $this->data['purpose'] = 'fabrics';
  //  $this->data['level'] = product;
  //  array_push($this->data['navigation'], 'Fabrics', $title);
  //  $this->data['category_selected'] = $this->data['purpose'];
  //  $this->data['collection_selected'] = $collection_id;
  //  $this->menu_view(['filters_fab', 'product_list_slayman']);
  //}

  /*
    Options
  */
  
  function viewall(){
    $this->collection_view(0, 'View All');
  }
  

  //PKL - 2020-09-09
  //function slayman(){
  //  // Collection/Lisa-Slayman ID 32
  //  $this->collection_view_slayman(32, 'Lisa Slayman');
  //}
  
  function drapery(){
    // Collection/Drapery ID 21
    $this->collection_view(21, 'Drapery');
  }
  
  function upholstery(){
    // Collection/Upholstery ID 25
    $this->collection_view(25, 'Upholstery');
  }
  
  function outdoors(){
    // Collection/Outdoor ID 12
    $this->collection_view(12, 'Outdoor');
  }
  
  function performance(){
    // Collection/Performance Fabrics ID 22
    $this->collection_view(22, 'Performance Fabrics');
  }
  
  function vinyls(){
    // Collection/Vinyls ID 24
    $this->collection_view(24, 'Vinyls');
  }
  
  function prints(){
    // Collection/Prints ID 19
    $this->collection_view(19, 'Prints');
  }
  
  function sheers(){
    // Collection/Sheers ID 23
    $this->collection_view(23, 'Sheers');
  }

  function firecode($name){
      $this->data['level'] = product;
//      var_dump($name);
      $name = urldecode($name);
      $name = str_replace('-', ' ', $name);
      $r = $this->model->search_firecodes_by_name($name);
//      var_dump($this->db->last_query());
//      var_dump($name);
//      var_dump($r);
      array_push($this->data['navigation'], "View All");
      $this->data['purpose'] = 'fabrics';
      $this->data['firecode_selected'] = $r[0]['id'];
      $this->menu_view(['filters_fab', 'product_list']);

  }


  /*
    Specials
  */
  
  function under30(){
		$this->data['activeMenu'] = 'HOSPITALITY';
    
    $aux = $this->model->get_under30();
    //$aux['title'] = '$30 & Under';
    $this->data['purpose'] = 'fabrics';
    array_push($this->data['navigation'], 'Hospitality', '$30 and Under');
    array_push($this->data['styles_arr'], $aux);
    $this->data['special_selected'] = $this->model->web_list_id['30_under']; // ID from the dropdown
    $this->menu_view(['filters_fab', 'product_list']);
  }
  
  function newarrivals(){
	$this->data['activeMenu'] = 'NEW ARRIVALS';
    
    $aux = $this->model->get_new_arrivals();
    //$aux['title'] = 'New Arrivals';
    $this->data['purpose'] = 'fabrics';
    array_push($this->data['navigation'], 'New Arrivals');
    array_push($this->data['styles_arr'], $aux);
    $this->data['special_selected'] = $this->model->web_list_id['new_arrivals']; // ID from the dropdown
    $this->menu_view(['filters_fab', 'product_list']);
    // echo '<pre> New Arrivals:';
    // print_r($this->data);
    // echo '</pre>';
  }
  
  
}

?>