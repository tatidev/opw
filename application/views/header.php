<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
  	<meta name="description" content="Opuzen is a premiere fabric supplier for the interior design industry. We pride ourselves on providing quality textiles at all ranges of price point.">
  	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">
  	<meta name='keywords' content='Opuzen, Opuzen Design, home decor, textile, textiles, fabric, fabrics, interior design'>
  	<meta name='author' content='Ezequiel Donovan'>
  
    <!-- Meta tags to prevent caching -->
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
  	
  	<title><?=(isset($aux['NAME']) ? $aux['NAME'] . ' - ' : '' )?>Opuzen</title>
    
<?    // Libraries loading
      // Common libraries are set up on Core/MY_Controller
      // Then invidivual libraries are set up by each controller
      foreach($library_head as $lib){
        switch($lib['type']){
          case 'css':
?>
            <link type='text/css' rel="stylesheet" href="<?=$lib['url']?>"  />
<?          break;
          case 'js':
?>
            <script type='text/javascript' src='<?=$lib['url']?>'></script>
<?          break;
          default:
            echo $lib['url'];
            break;
        }
      }
?>
    
  	
  </head>
  <body class='mx-auto bkgr-black' style='max-width:980px;'>
    
    <?=(isset($anim)?$anim:'')?>
    <div class='loading-div invisible'></div>
    
    <div class='page d-flex flex-column justify-content-between mx-auto' style='background: white;'>
      
      <!-- Header -->
      <div class='' style='width: 100%; max-width: 980px; position: fixed; z-index: 1030;'>
        <?
//          if (ENVIRONMENT == 'development') {
//            echo "<div class='col-12 text-center' style='background-color:black; color:white; border: 1px solid white;'>DEVELOPMENT STAGE @ ". constant('MT_SERVER') ." ". $_SERVER['SERVER_ADDR'] ." / ". $this->db->database ."</div>";
//            echo "<script>
//                    $(document).ready(function(){
//                      $('.content-container').css('padding-top', '137px');
//                    });
//                  </script>";
//          }
        ?>
        <!-- Header over menu -->
        <div class='bkgr-black border-btm-white-mobile' style="padding-top:5px; padding-bottom: 8px;">

            <div class='row fixrow header align-items-center'>

              <div class='col-12 col-sm-5 logo-position hidden-sm-down'>
                <a href='<?=base_url('home/1')?>'>
                  <img id='logo' src="<?=asset_url()?>images/opuzen_logo_background-color.jpg">
                </a>
              </div>

              <div class="col-12 col-sm-4">
                  <div class='d-flex justify-content-between flex-lg-row flex-sm-column'>
                      <!--                      <span class='hide'>T</span>-->
                      <!--                        <a class=''><i class="fa fa-phone" style='color:white;font-size:9px;' aria-hidden="true"></i>-->
                      <!--                        </a>-->
<!--                      <span class="contact-clk" style="color:white; font-size: 16px;">CONTACT</span>-->
                      <a class='phone-link' href="tel:+01-323-549-3489">323 549 3489</a>
                      <a class='email-link' href="mailto:info@opuzen.com">info@opuzen.com &nbsp;&nbsp;<span style="color: rgb(103, 99, 96);"></span></a>
<!--                      <script>-->
<!--                          $('.contact-clk').on('click', function(){-->
<!--                              // console.log($('.phone-num'));-->
<!--                              $('.phone-link')[0].click();-->
<!--                          })-->
<!--                      </script>-->
                  </div>
<!--                  <div class="hidden-md-up">-->
<!--                      <span class="contact-clk" style="color:white; font-size: 16px;">CONTACT US</span>-->
<!--                      <a class='phone-num' style='color: white; font-size:16px;' href="tel:+01-323-549-3489">323 549 3489</a>-->
<!--                  </div>-->
              </div>

              <div class='col-12 col-sm-3 searchbox pr-0 mt-3'>
                  <a href='<?=base_url('home/1')?>'>
<!--                    <img id='logo' class='m-0 hidden-md-up' src="--><?//=asset_url()?><!--images/opuzen_logo49x49.jpg" style="width:40px; height:40px;">-->
                      <img id='logo' class='m-0 hidden-md-up' src="<?=asset_url()?>images/logo_small_c.png" style="width:40px; height:40px;">
                  </a>
                  <a class='dl-trigger-copy hidden-md-up' style='line-height: 40px;margin-left: 10px;'>
                    <i class="fa fa-bars" style='color:white;' aria-hidden="true"></i>
                  </a>
                  <form action='<?=site_url('search');?>' method='post' style='display: inline;' class="float-right search-form mt-2 mt-sm-0">
                      <input type="text" name="txtsearch" id="txtsearch" placeholder="SEARCH" value="<?=$txtsearch;?>">
                  </form>
              </div>

            </div>

            <form id='menu_ex' method="post" accept-charset="utf-8" action="<?=site_url('')?>">
              <input type="hidden" name="category" id='category' value="" />
              <input type="hidden" name="member_id" id='member_id' value="" />
            </form>
        </div>
        
        <? include('header_menu.php'); ?>
        <? include('header_mobile_menu.php'); ?>
        
      </div>
      <!-- Content -->

      <div class='content-container bkgr-black' style='flex-grow:2;'>
