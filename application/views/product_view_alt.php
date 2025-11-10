<?
  $url = image_src_path($purpose).$id.'.jpg';
  $img = img($url, false, array('class'=>'img-fluid fixwidth bkgr-white pb-1') );
?>

  <style>
    .thumb> .card> img {
      box-shadow: 0 0 15px white;
    }
    
    .specbox {
      border-left: 3px solid #bfac02;
      border-top: 3px solid #bfac02;
      border-right: 3px solid white;
      border-bottom: 3px solid white;
      background: #bfac02;
    }
    
    #image400 {
      width: 400px;
      height: auto;
      box-shadow: 0 0 20px white;
    }
    
    #image400caption {
      color: white;
    }
    
    .bold {
      font-weight: bold;
    }
    
    .btnBack {
      color: white;
      background-color: #bfac02;
    }
    
    .btnSpec {
      bottom: 0;
      right: 0;
      font-size: 14px;
      color: white !important;
      background-color: black;
    }
  </style>

  <div class='pb-5 bkgr-black'>

    <!-- Main image -->
    <div class='row fixrow'>
      <?=$img?>
    </div>

    <div class='row fixrow'>
      <div class='col-12 col-md-6'>
        <a class='btn btnBack pull-left my-3' href="javascript:window.history.go(-1);">Go back</a>
      </div>
    </div>

    <div class='row fixrow'>


      <div class='hidden-sm-down col-md-6'>
        <img id='image400' src='' class='img-fluid'>
        <div class="caption mt-2">
          <p id='image400caption'></p>
        </div>
      </div>

      <div class='col-12 col-md-6 p-0'>
        <div class='w-100 h-100 specbox p-2'>

          <div class='row fixrow'>
            <p class="h6 lead px-3 text-justify bold">
              <?=$aux['NAME']?>
            </p>
            <p class="h6 px-3 py-2 text-justify">
              <?=$aux['DESCRIPTION']?>
            </p>
          </div>

          <dl class='row fixrow' style='font-size: 14px;'>
            <!-- Spec info -->
            <?
          foreach($spec as $row){
          
            if(count($row['data']) > 0){
  ?>
              <dt class='col-sm-6 bold'><?=$row['text']?>:</dt>
              <?
              $counter = 0;
              foreach($row['data'] as $dato){
                $counter++; $offset = ''; $noMargin = '';
                if($counter < count($row['data'])){
                  $offset = "<dd class='col-sm-6 m-0'></dd>";
                  $noMargin = 'm-0';
                }
  ?>
                <dd class='col-sm-6 <?=$noMargin?>'>
                  <?=$dato?>
                </dd>
                <?=$offset?>
                  <?
              }
            }
          }
  ?>
          </dl>
          <a href="<?=site_url('product/specsheet/'.$id)?>" target='_blank' class='btnSpec pull-right m-4 p-1'>DOWNLOAD SPEC SHEET</a>
        </div>
      </div>


    </div>

    <!-- Colorways -->
    <div class='d-flex flex-wrap mt-5 p-0 align-items-start'>
      <?
    foreach($items as $c){
      $href = image_src_path($purpose.'_items').'big/'.$c['id'].'.jpg';
      $url = image_src_path($purpose.'_items').$c['id'].'.jpg';
      $img = img($url, false, array('class'=>'img-fluid rounded-circle', 'style'=>'width: 125px;') );
  ?>
        <div class='thumb mb-3' data-href='<?=$href?>' data-color='<?=$c[' color ']?>' data-code='<?=$c[' code ']?>'>
          <div class="card card-inverse br-0 mb-0 ml-3 mr-3 mt-3 d-inline-block bkgr-black">
            <?=$img?>
          </div>
          <div class='w-100 ml-3 mr-3'>
            <p class="card-title text-thumb m-0">
              <?=$c['code'];?>
            </p>
            <p class="card-title text-thumb m-0">
              <?=$c['item_name'];?>
            </p>
            <p class="card-title text-thumb m-0">
              <?=$c['color'];?>
            </p>
          </div>
        </div>
        <?
    }
  ?>
    </div>


  </div>

  <script>
    $(document).ready(function() {
      var first_item = $('.thumb').first();
      $('#image400').attr('src', first_item.attr('data-href'));
      var txtHtml = (first_item.attr('data-code').length > 0 ? first_item.attr('data-code') + '<br>' : '') + first_item.attr('data-color');
      $('#image400caption').html(txtHtml);
    })

    $(document).on('click', '.thumb', function() {
      $('#image400').attr('src', $(this).attr('data-href'));
      var txtHtml = ($(this).attr('data-code').length > 0 ? $(this).attr('data-code') + '<br>' : '') + $(this).attr('data-color');
      $('#image400caption').html(txtHtml);
    });
  </script>