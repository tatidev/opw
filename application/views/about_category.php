<div id="slideshow" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <?
  $c = 0;
  foreach($images as $img){
    $c += 1;
    if($c == 1){
?>
      <div class="carousel-item active">
        <img class="d-block img-fluid fixwidth" src="<?=$img['src']?>" alt="<?=$img['alt']?>">
      </div>
      <?
    } else {
?>
        <div class="carousel-item">
          <img class="d-block img-fluid fixwidth" src="<?=$img['src']?>" alt="<?=$img['alt']?>">
        </div>
        <?
    }
    
  }
?>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#slideshow').carousel({
      interval: 2000
    });
  });
</script>
<style>
  @media(max-width: 736px) {
    #mobileChange {
      -webkit-box-orient: vertical!important;
      -webkit-box-direction: normal!important;
      -webkit-flex-direction: column!important;
      -ms-flex-direction: column!important;
      flex-direction: column!important;
    }
    #mobileChange> div:first-child {
      min-height: 0px!important;
      min-width: 0px!important;
    }
    .content-text {
      min-height: 270px!important;
    }
  }
</style>

<div class='bkgr-white' style='border-top:6px solid white;min-height:330px;'>

  <div id='mobileChange' class='d-flex flex-row '>
    <div class=' pt-4 pr-4 title side-style text-right' style='min-width: 300px;min-height: 330px;'>
      <?=$title?>
      <iframe class='pt-4' src='https://libs.a2zinc.net/Common/Widgets/ExhibitorBadge.aspx?applicationid=gM+M1z2efQdG+80vAgrVYldily4MF7jwI+voQf0xjKDx/f/3oqsywXi/TjKM5ggR&CompanyID=855888&BoothID=1027328&EventID=1436' frameBorder='0' allowtransparency='true' scrolling='no' width='200px' height='330px'></iframe>
    </div>

    <div class=' p-4 bkgr-black content-text'>
      <?=$text?>
    </div>
  </div>

</div>