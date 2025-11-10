<?php
	
	class Menu_model extends MY_Model
	{
		
		protected $menu;
		
		public function __construct()
		{
			parent::__construct();
//			$this->menu = $this->generate();
		}
		
		public function get_menu()
		{
			return $this->menu;
		}
		
		function generate($documents)
		{
			
			// Create Menu
			$menu = array(
				array('name' => 'HOME', 'url' => site_url('home/1'), 'sub' => array()),
				array('name' => 'ABOUT', 'url' => site_url('about/'), 'sub' => array(
                    array('name' => 'MEET THE TEAM', 'url' => site_url("about/"), 'sub' => array()),
                    array('name' => 'FAQ', 'url' => site_url("faq"), 'sub' => array()),
                    array('name' => 'TERMS AND CONDITIONS', 'url' => $documents["terms"], 'target' => '_blank', 'sub' => array()),
                    array('name' => 'FABRIC CLEANING', 'url' => site_url("cleanings"), 'sub' => array()),
                    array('name' => 'WARRANTIES', 'url' => $documents["warranty"], 'target' => '_blank', 'sub' => array()),
                )),
//				array('name' => 'ABOUT', 'url' => site_url('about/'), 'sub' => array()),
				array('name' => 'FABRICS', 'url' => site_url('collection/viewall'), 'sub' => array(
					array('name' => 'VIEW ALL', 'url' => site_url('collection/viewall'), 'sub' => array()),
                    array('name' => 'NEW ARRIVALS', 'url' => site_url('collection/new-arrivals'), 'sub' => array()),
					array('name' => 'LISA SLAYMAN COLLECTION', 'url' => site_url('collection/lisa-slayman'), 'sub' => array()),
                    array('name' => 'DRAPERY', 'url' => site_url('collection/drapery'), 'sub' => array()),
					array('name' => 'UPHOLSTERY', 'url' => site_url('collection/upholstery'), 'sub' => array()),
					array('name' => 'OUTDOORS', 'url' => site_url('collection/outdoors'), 'sub' => array()),
//					array('name' => 'PERFORMANCE FABRICS', 'url' => site_url('collection/performance'), 'sub' => array()),
					array('name' => 'VINYLS', 'url' => site_url('collection/vinyls'), 'sub' => array()),
					array('name' => 'PRINTS', 'url' => site_url('collection/prints'), 'sub' => array()),
					array('name' => 'SHEERS', 'url' => site_url('collection/sheers'), 'sub' => array()),
					array('name' => 'CONTENTS', 'url' => '#', 'sub-sub' => $this->get_contents(), 'desktopOnly' => true),
					array('name' => 'COLORS', 'url' => '#', 'sub-sub' => $this->get_colorways(), 'desktopOnly' => true),
					array('name' => 'PATTERNS', 'url' => '#', 'sub-sub' => $this->get_pattern_styles(), 'desktopOnly' => true),
					array('name' => 'WEAVES', 'url' => '#', 'sub-sub' => $this->get_weaves(), 'desktopOnly' => true)
				)
				),
				array('name' => 'DIGITAL PRINTS', 'url' => site_url('about/digital'), 'sub' => array(
					array('name' => 'WHAT WE DO', 'url' => site_url('about/digital'), 'sub-sub' => array(), 'mobileOnly' => true),
					array('name' => 'VIEW ALL', 'url' => site_url('digital/view-all'), 'sub-sub' => array(), 'mobileOnly' => true),
					array('name' => 'PATTERNS', 'url' => '#', 'sub-sub' => $this->get_pattern_styles_digital(), 'desktopOnly' => true),
					array('name' => 'GROUNDS', 'url' => '#', 'sub-sub' => array(
						array('name' => 'VIEW ALL', 'id' => 0, 'category' => 'digital_grounds', 'contr' => 'digital/grounds'),
						array('name' => 'DRAPERY', 'id' => 0, 'category' => 'digital_grounds', 'contr' => 'digital/grounds'),
						array('name' => 'UPHOLSTERY', 'id' => 0, 'category' => 'digital_grounds', 'contr' => 'digital/grounds'),
						array('name' => 'SHEERS', 'id' => 0, 'category' => 'digital_grounds', 'contr' => 'digital/grounds'),
					)
					)
				)
				),
				array('name' => 'HOSPITALITY / RESIDENTIAL', 'url' => site_url('about/hospitality'), 'sub' => array(
					array('name' => 'WHAT WE DO', 'url' => site_url('about/hospitality'), 'sub-sub' => array(), 'mobileOnly' => true),
//		    array('name'=>'$30 AND UNDER', 'url'=>site_url('30-under'), 'sub'=>array() )
				)
				),
				
//      array('name'=>'PORTFOLIO', 'url'=>site_url('portfolio/'), 'sub'=>array() ),
				array('name' => 'SHOWROOMS / AGENTS', 'url' => site_url("showrooms"), 'sub' => [
					['name' => 'USA', 'url' => site_url('showrooms/usa')],
					['name' => 'International', 'url' => site_url('showrooms/international')]
				]
				),
				array('name' => 'CLOSEOUT', 'url' => site_url('closeout'), 'sub' => array()),
				array('name' => 'CONTACT', 'url' => site_url('contact'), 'sub' => array()),

//      array('name'=>'NEW ARRIVALS', 'url'=>site_url('new-arrivals'), 'sub'=>array() ),

//      array('name'=>'SCREEN-PRINTS', 'url'=>site_url('about/screenprints'), 'sub'=>array(
//          array('name'=>'WHAT WE DO', 'url'=>site_url('about/screenprints'), 'sub-sub'=>array(), 'mobileOnly'=>true ),
//          array('name'=>'ARCHIVE', 'url'=>site_url('screenprints/archive'), 'sub-sub'=>array() ),
//          array('name'=>'GROUNDS', 'url'=>'#', 'sub-sub'=>array(
//              array('name'=>'VIEW ALL', 'id'=>0, 'category'=>'screenprints_grounds', 'contr'=>'screenprints/grounds' ),
//              array('name'=>'DRAPERY', 'id'=>0, 'category'=>'screenprints_grounds', 'contr'=>'screenprints/grounds' ),
//              array('name'=>'UPHOLSTERY', 'id'=>0, 'category'=>'screenprints_grounds', 'contr'=>'screenprints/grounds' )
//            )
//          )
//        )
//      ),
//      array('name'=>'CONTACT', 'url'=>site_url('contact'), 'sub'=>array() )
			);
			return $menu;
		}
		
		function get_contents()
		{
			return $this->get_all_web_contents();
		}
		
		function get_weaves()
		{
			return $this->get_all_weaves();
		}
		
		function get_colorways()
		{
			return $this->get_all_colorways();
		}
		
		function get_pattern_styles()
		{
			return $this->get_all_pattern2();
		}
		
		function get_pattern_styles_digital()
		{
			$q = $this->get_all_pattern2_digital();
			array_unshift($q, array('name' => 'VIEW ALL', 'id' => 0, 'category' => 'digital_styles', 'contr' => 'digital'));
			return $q;
		}
		
	}

?>