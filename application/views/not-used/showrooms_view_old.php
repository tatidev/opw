<style>
  .item-region {
    font-size: 20px;
    color: #bfac02;
  }
  
  .showroom-title {
    color: #bfac02;
  }
  
  .showroom-contact {
    color: white;
  }
  
  .showroom-card {
    font-size: 12px;
  }
  
  .showroom-contact> a[href^="tel:"] {
    color: white;
  }
  
  @media (max-width: 736px) {
    .showrooms-container {
      max-height: none!important;
    }
    .showroom-card {
      width: 100%!important;
    }
  }
</style>
<div class='' style='    background: black;'>

  <div class='row fixrow'>
<!--    <div class='col-12 col-md-4 pt-4 pr-4 title side-style text-right'>-->
<!--      Showrooms / Agents-->
<!--    </div>-->

    <div class='col-12 col-md-8 pt-3 pb-3 colfix bkgr-black'>
      <?
    foreach($master_arr as $region){
      $maxheight = " style='border-bottom: 1px solid #bfac02;' ";
      if($region['title'] == 'International') $maxheight = " style='max-height: 200px; ' ";
      
?>
        <div class='row fixrow'>
          <div class='col-12 p-0 m-2 mx-5 item-region'>
            <?=$region['title']?>
          </div>
        </div>
        <div class='showrooms-container d-flex flex-wrap mt-2 mb-4 mx-5' <?=$maxheight?> </div>
        <?
        foreach($region['showrooms'] as $showroom){
?>
          <div class='showroom-card w-50 mb-4'>
            <div class='showroom-title'>
              <?=$showroom['name']?>
            </div>
            <div class='showroom-contact'>
              <?=$showroom['address']?>
            </div>
          </div>
          <?
        }
?>
    </div>
    <div class='w-100 m-4'></div>
    <?
      }
?>


  </div>
</div>

</div>

<script>
  $(document).ready(function() {
    $('#main-menu').css('border-bottom', 'none');
  });
</script>