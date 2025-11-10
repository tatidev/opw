<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {
  
  private $locations;
  
  function __construct(){
    parent::__construct();
    $this->locations = array();
  }
  
  public function index(){
      $this->data["preTitle"] = "Get In Touch";
		$this->data['activeMenu'] = 'CONTACT';
		$this->data['contact_map_url'] = asset_url() . "images/contact_map2.jpg";
    
    // add_location (@name, @address, @phone, @f, $e)
    $this->add_location('Office / Studio', 'https://goo.gl/maps/jN6oG', array("5788 Venice Blvd., Los Angeles, CA 90019", "<span class='hidden-sm-down'>| </span>t <a href='tel:+01-323-549-3489'>323 549 3489</a>", "<span class='hidden-sm-down'>| </span>f 323 549 3494", "<span class='hidden-sm-down'>| </span>e <a style='color:white;' href='mailto:info@opuzen.com'>info@opuzen.com</a>"));
    $this->add_location('Warehouse / Digital Studio', 'https://goo.gl/maps/QsJWiT1eAis', array("345 N. Oak St., Inglewood, CA 90302", "<span class='hidden-sm-down'>| </span>t <a href='tel:+01-310-330-9928'>310 330 9928</a>") );
//     $this->add_location('Showroom to the Trade', 'https://goo.gl/maps/DN1vp', array("8687 Melrose Ave., West Hollywood, CA 90069", "<span class='hidden-sm-down'>| </span>t <a href='tel:+01-310-278-2456'>310 278 2456</a>", "<span class='hidden-sm-down'>| </span>f 323 549 3494") );
    
    $this->prepare_view();
    $this->menu_view('contact_view', $this->data);
  }
  
  function add_location($name, $googleMapsLink, $addressArr){
    $aux = array('name'=>$name, 'link'=>$googleMapsLink, 'info'=>$addressArr);
    array_push($this->locations, $aux);
  }
  
	// Finalize data for the view
	function prepare_view(){
	  $this->data['locations'] = $this->locations;
	}
  
}

?>