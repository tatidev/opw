<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portfolio extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('portfolio_model', 'model');
		$this->add_navigation_crumb('Portfolio');
	}
	
	public function index()	{
		$this->data['activeMenu'] = 'PORTFOLIO';
		
		$this->add_external_library('head', 'css', asset_url()."others/photoswipe/css/photoswipe.css");
		$this->add_external_library('head', 'css', asset_url().'others/photoswipe/css/default-skin/default-skin.css');
		$this->add_external_library('head', 'js', asset_url().'others/photoswipe/js/photoswipe.min.js');
		$this->add_external_library('head', 'js', asset_url().'others/photoswipe/js/photoswipe-ui-default.min.js');
		
		$this->prepareImagesForView();
	  $this->menu_view('portfolio_view', $this->data);
	}
	
	
	public function prepareImagesForView(){
		$aux = $this->model->get_pictures();
		$ret = array();
		foreach($aux as $img){
			$i['alt'] = $img['alt'];
			// $i['src'] = 'https://www.opuzen.com/showcase/images/press/'.$img['id'].'.jpg';
			$i['src'] = S3_IMAGE_URL . '/press/' . $img['id'] . '.jpg';
			$sizes = getimagesize($i['src']);
			$i['w'] = $sizes[0]; // Width
			$i['h'] = $sizes[1]; // Height
			$i['id'] = $img['id'];
			array_push($ret, $i);
		}
		$this->data['imagesCollection'] = $ret;
	}
	
}

?>