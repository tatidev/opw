<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends MY_Controller {
	
	/*
	This class defines the following pages:
		./about
		 /showrooms
		 /about/hospitality
		 /about/digital
		 /about/screenprints

	*/
	
	private $images;
	private $title;
	private $text;
	
	public function __construct(){
		parent::__construct();
		$this->data['images'] = array();
		$this->images = array();
	}

	public function index($page='')	{
		$this->data['activeMenu'] = 'ABOUT';
		
		$this->data['team'] = [
			[
				'img' => 'FeliciaFrench.jpg',
				'order' => 1,
				'name' => 'Felicia French',
				'position' => 'Owner & President'
			],
			[
				'img' => 'MiriamJohnson.jpg',
				'order' => 2,
				'name' => 'Miriam Johnson',
				'position' => 'Controller'
			],
			/*[
				'img' => 'AmberDiFruscio.jpg',
				'order' => 3,
				'name' => 'Amber DiFruscio',
				'position' => 'Hospitality Business Development Director'
			], */
			[
				'img' => 'MatthewMaloney.jpg',
				'order' => 4,
				'name' => 'Matt Maloney',
				'position' => 'Residential Customer Service Director'
			],
			[
				'img' => 'MelissaPanganiban.jpg',
				'order' => 5,
				'name' => 'Melissa Panganiban',
				'position' => 'Digital Project Coordinator'
			],
			[
				'img' => 'FiekhinNio.jpg',
				'order' => 6,
				'name' => 'Fiekhin Nio',
				'position' => 'Shipping Manager'
			],
			[
				'img' => 'AnnEvans.jpg',
				'order' => 7,
				'name' => 'Ann Evans',
				'position' => 'Product Data Manager'
			],
			[
				'img' => 'SueFlannagan.jpg',
				'order' => 8,
				'name' => 'Sue Flannagan',
				'position' => 'Senior Hospitality Coordinator'
			],
			[
				'img' => 'GracielaMateo.jpg',
				'order' => 9,
				'name' => 'Graciela Mateo',
				'position' => 'Showroom and Rep Display'
			],
			[
				'img' => 'GayleSmock.jpg',
				'order' => 10,
				'name' => 'Gayle Smock',
				'position' => 'Senior Accountant'
			],
			[
				'img' => 'VictorAlvarez.jpg',
				'order'  => 11,
				'name' => 'Victor Alvarez',
				'position' => 'Hospitality Quoting'
			],
			[
				'img' => 'GloriaRodriguez.jpg',
				'order' => 12,
				'name' => 'Gloria Rodriguez',
				'position' => 'Production Sampling Manager'
			],
			[
				'order' => 13,
				'img' => 'JessicaFlores.jpg',
				'name' => 'Jessica Flores',
				'position' => 'Assistant to Residential Manager'
			],
			[
				'order' => 14,
				'img' => 'NataliaZlatin.jpg',
				'name' => 'Natalia Zlatin',
				'position' => 'Hospitality Account Services'
			],
			[
				'order' => 15,
				'img' => 'SaraCressman.jpg',
				'name' => 'Sara Cressman',
				'position' => 'Assistant to Residential Director'
			],/*
			[
				'order' => 15,
				'img' => 'VictoriaCedeno.jpg',
				'name' => 'Victoria Cedeno',
				'position' => 'Junior Residential Account Services'
			],*//*
			[
				'order' => 16,
				'img' => 'NichaTaylor.jpg',
				'name' => 'Nicha Taylor',
				'position' => 'Small Orders Specialist'
			],*/
			[
				'order' => 17,
				'img' => 'LeslieMorataya.jpg',
				'name' => 'Leslie Morataya',
				'position' => 'Production Sampling Assistant'
			],
			[
				'order' => 18,
				'img' => 'JuanCarlosMojica.jpg',
				'name' => 'Juan Carlos Mojica',
				'position' => 'Digital - Shipping & Receiving'
			],
			[
				'order' => 19,
				'img' => 'JorgeLezama.jpg',
				'name' => 'Jorge Lezama',
				'position' => 'Digital Sublimation Manager'
			],
			[
				'order' => 20,
				'img' => 'DavidVilchez.jpg',
				'name' => 'David Vilchez',
				'position' => 'Warehouse Shipping Staff'
			],
			[
				'order' => 21,
				'img' => 'TaylorBelanglaze.jpg',
				'name' => 'Taylor Belanglaze',
				'position' => 'Senior Textile Designer'
			],
			[
				'order' => 22,
				'img' => 'MoniqueLee.jpg',
				'name' => 'Monique Lee',
				'position' => 'Textile Designer'
			],
			[
				'order' => 23,
				'img' => 'DannyMateo-Gutierrez.jpg',
				'name' => 'Danny Mateo-Gutierrez',
				'position' => 'Digital Department Assistant'
			],
			[
				'order' => 24,
				'img' => 'CesarPaiz.jpg',
				'name' => 'Cesar Paiz',
				'position' => 'Logistics Coordinator'
			],
			[
				'order' => 26,
				'img' => 'AndrewSimmons.jpg',
				'name' => 'Andrew Simmons',
				'position' => 'Hospitality Sampling Associate'
			]
		];
		
		$this->menu_view('about', $this->data);
	}
	
	/***
	
	Showrooms View
	
	***/
	
	private function back_button($url, $content, $attr){
		return anchor($url, $content, $attr);
	}
	
	public function showrooms($country=''){
		$this->load->model('showroom_model', 'model');
		array_push($this->data['navigation'], 'Showroom', 'Agents');
        $this->data["preTitle"] = "Find a Showroom";
		$this->data['activeMenu'] = 'SHOWROOM/AGENTS';
		
		if ( $country == 'usa' ){
			$this->showrooms_usa();
		}
		else if( $country == 'international' ){
			$this->showrooms_international();
		}
		else {
			$this->showrooms_all();
		}
	}
	
	private function showrooms_all(){
//		array_push($this->data['navigation']);
		$this->menu_view('showrooms_view_pre', $this->data);
	}
	
	private function showrooms_usa(){
		array_push($this->data['navigation'], 'USA');
		
		$this->include_dropdown_dependencies();
		$this->data['state_selected'] = '';
		$this->data['showrooms_data'] = $this->model->get_showrooms_us();
		$this->data['options_states'] = $this->model->get_showroom_states();
		$this->data['btnBack'] = $this->back_button(site_url('showrooms/international'), "<i class='fa fa-play fa-rotate-180'></i> INTERNATIONAL", ["class"=>"btnback oz-color"]);
		$this->menu_view('showrooms_view_us-flex', $this->data);
	}
	
	private function showrooms_international(){
		array_push($this->data['navigation'], "International");
		
		$this->data['state_selected'] = '';
		$this->data['showrooms_data'] = $this->model->get_showrooms_international();
		$this->data['options_states'] = [];#$this->model->get_showroom_states();
		$this->data['btnBack'] = $this->back_button(site_url('showrooms/usa'), "<i class='fa fa-play fa-rotate-180'></i> USA", ["class"=>"btnback oz-color"]);
		$this->menu_view('showrooms_view_inter', $this->data);
	}
	
	/***
	
	Hospitality View
	
	***/
	
	public function hospitality(){
		$this->data['activeMenu'] = 'HOSPITALITY/RESIDENTIAL';
	/*
		$this->add_image_to_view(asset_url().'images/hospitality/2021-1.jpg', '');
		$this->add_image_to_view(asset_url().'images/hospitality/2021-2d.jpg', '');
		$this->add_image_to_view(asset_url().'images/hospitality/2021-3c.jpg', '');
		$this->add_image_to_view(asset_url().'images/hospitality/2021-4d.jpg', '');
   */	
		$aws_imge_uri = 'https://opuzen-site-assets.s3.us-west-1.amazonaws.com/images/hospitality/';
        //$aws_imge_uri = 'https://opuzen-web-assets-public.s3.us-west-1.amazonaws.com/showcase/images/hospitality/';
		$config['asset_storage'] = 
		// resized images
		$this->add_image_to_view($aws_imge_uri . 'Misty-Mountain1-W527xH428.png', ''); // Same
		$this->add_image_to_view($aws_imge_uri . 'sheepskin-W.321xH428.jpg', ''); 
		$this->add_image_to_view($aws_imge_uri . 'navada-W306xH382.jpg', ''); 
		$this->add_image_to_view($aws_imge_uri . 'Zircon-W511xH382.png', ''); 
	
		

		$this->set_sidetitle('Hospitality');
//		$this->set_text('Opuzen does not put a price on style and innovation. We offer a range of signature fabrics specifically targeted to accommodate cost conscious budgets of the hospitality and commercial markets, without compromising that look that quality which sets us apart.<br><br>Please contact '.anchor(site_url('showrooms'), 'one of our representatives', " class='inline-link' " ).' to discuss your distinctive requirements.');
		
		$this->prepare_view();
		$this->menu_view('about_hospitality', $this->data);
	}
	
	/***
	
	Digital View
	
	***/
	
	public function digital(){
        $this->data["preTitle"] = "Digital Prints";
		$this->data['activeMenu'] = 'DIGITAL PRINTS';
		
		$this->add_image_to_view(asset_url().'images/digital/D-2021-1.jpg', '');
//		$this->add_image_to_view(asset_url().'images/digital/Digital1.jpg', '');
//		$this->add_image_to_view(asset_url().'images/digital/Digital3.jpg', '');
		
		$this->set_sidetitle('Digital');
		
		$this->prepare_view();
		$this->menu_view('about_digital', $this->data);
	}
	
	/***
	
	Class Methods
	
	***/
	
	// Stacks given images
	function add_image_to_view($url, $alt){
		$aux = array('src'=>$url, 'alt'=>$alt);
		array_push($this->images, $aux);
	}
	
	function set_sidetitle($text){
		$this->title = $text;
	}
	
	function set_text($text){
		$this->text = $text;
	}
	
	// Finalize data for the view
	function prepare_view(){
		foreach($this->images as $img){
			array_push($this->data['images'], $img);
		}
		$this->data['title'] = $this->title;
		$this->data['text'] = $this->text;
	}
	
		
}

?>