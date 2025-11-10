<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	}

	public function index($new=0)	{
		$this->data['isHomePage'] = true;
		/* Slide Show images */
//		$fixedImg_A = array('home7.jpg', 'home14.jpg', 'home5.jpg');
//		$imagesArr = array('home0.jpg','home1.jpg','home3.jpg','home4.jpg','home8.jpg', 'home11.jpg', 'home12.jpg');
//		shuffle($imagesArr);
		$imagesArr = [
			[
				"url"=>asset_url()."images/home/slide-2021-10-14-2/1.jpg",
//				"url"=>"2021-1.jpg",
                "name"=>"Intermingle",
                "link"=>site_url("product/intermingle")
			],
			[
                "url"=>asset_url()."images/home/slide-2021-10-14-2/2.jpg",
//				"url"=>"2021-2.jpg",
                "name"=>"Vacay in the Palms",
                "link"=>site_url("product/vacay-in-the-palms")
			],
			[
                "url"=>asset_url()."images/home/slide-2021-10-14-2/3.jpg",
//				"url"=>"2021-3.jpg",
                "name"=>"Pixel Glitch",
                "link"=>site_url("product/digital/pixel-glitch")
			],
			[
                "url"=>asset_url()."images/home/slide-2021-10-14-2/4.jpg",
//				"url"=>"2021-4.jpg",
                "name"=>"Mondrian",
                "link"=>site_url("product/mondrian")
			],
            [
                "url"=>asset_url()."images/home/slide-2021-10-14-2/6.jpg",
//				"url"=>"2021-6.jpg",
                "name"=>"Intwined",
                "link"=>site_url("product/digital/intwined-54-inches")
            ],
			[
                "url"=>asset_url()."images/home/slide-2021-10-14-2/5.jpg",
//				"url"=>"2021-5.jpg",
                "name"=>"Puzzled",
                "link"=>site_url("product/puzzled")
			],
			[
                "url"=>asset_url()."images/home/slide-2021-10-14-2/7.jpg",
//<!--				"url"=>"2021-7.jpg",-->
				"name"=>"Lilo",
				"link"=>site_url("product/lilo")
			],
			[
                "url"=>asset_url()."images/home/slide-2021-10-14-2/8.jpg",
//				"url"=>"2021-8.jpg",
                "name"=>"Crocodile Mile",
                "link"=>site_url("product/crocodile-mile")
			],
			[
                "url"=>asset_url()."images/home/slide-2021-10-14-2/9.jpg",
//				"url"=>"2021-9.jpg",
				"name"=>"Petit Trianon",
				"link"=>site_url("product/petit-trianon-reversible")
			],
			[
                "url"=>asset_url()."images/home/slide-2021-10-14-2/10.jpg",
                "name"=>"Dogon",
                "link"=>site_url("product/dogon")
			],
            [
                "url"=>asset_url()."images/home/slide-2021-10-14-2/11.jpg",
                "name"=>"Uptown",
                "link"=>site_url("product/uptown")
            ],
            [
                "url"=>asset_url()."images/home/slide-2021-10-14-2/12.jpg",
                "name"=>"Maui",
                "link"=>site_url("product/maui")
            ]
		];


		$randomN = rand(0, count($imagesArr)-1);
		$i = 0;
		$images = array();
		
		do {
//			if($randomN == $i){
//		  	do{
//		    	array_push($images, array_shift($fixedImg_A));
//		    }while (!empty($fixedImg_A));
//		  } else {
//		    array_push($images, array_shift($imagesArr));
//		  }
			array_push($images, array_shift($imagesArr));
		    $i++;
		} while (!empty($imagesArr));
		
		/* New Arrivals Images */
		$newArrivals = array('cuadro_new_arrivals.jpg', 'cuadro_new_arrivals_2.jpg');
		$rand = rand(0, count($newArrivals)-1);
		$selected = $newArrivals[$rand];
		
		/* Start Animation */
//		$show_anim = $new == 0 or !str_contains(current_url(), 'home/1')
//		$gifUrl = asset_url().'images/opuzen_logo_new_v1998-gif.gif';

//		$gifUrl = asset_url().'images/welcome/1.gif';
//		$gifEl = img($gifUrl, false, array('class'=>'start-anim') );
		$gifUrl = asset_url().'images/welcome/2AA.gif';
		$gifEl2 = img($gifUrl, false, array('class'=>'start-anim') );
//		$gifUrl = asset_url().'images/welcome/15.gif';
//		$gifEl3 = img($gifUrl, false, array('class'=>'start-anim', 'style'=>'top:55%;') );
		$this->data['anim'] = ($new == 0 ? "<div class='start bkgr-black'>".$gifEl2."</div>" : '');
		
		// Initialize
		$this->data['images'] = $images;
		$this->data['selected'] = $selected;

		$this->add_external_library('head', 'js', asset_url().'js/instafeed.js');

		$this->menu_view('home', $this->data);
	}
	
	public function faq(){
//        $this->set_latest_documents();
//		array_push($this->data['navigation'], 'FAQ');
////        var_dump($this->data["documents"]);
//        foreach($this->data["documents"] as $document){
//            if($document["g"] == "faq"){
//                $url_dir = "https://app.opuzen.com/pms/" . $document["url_dir"];
//                break;
//            }
//        }
//        $html = file_get_contents($url_dir);
//        $this->data["content"] = $html;
//        $this->menu_view("doc_html_display");

        $this->menu_view("faq");
	}


    public function cleanings(){
        $this->menu_view("cleaning");
    }
}

?>