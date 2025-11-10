
  <style>
      dt {
          font-weight: normal;
      }
    .specbox {
      /*background: #bfac02;*/
        color:white;
      padding-right: 19px;
      padding-top: 10px;
      padding-left: 20px;
      /*border-right: 9px solid white;*/
      min-height: 500px!important;
    }
    
    @media (max-width: 767px) {
      .specbox {
        border-right: none!important;
        min-height: 300px!important;
      }
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
    

    
    .product-name {
      margin: 10px 0;
      font-size: 15px!important;
      font-weight: 600!important;
    }
    
    .product-desc {
      margin: 5px 0 20px 0;
      font-size: 11px!important;
      line-height: 14px;
    }
    
    .thumb {
      margin: 10px!important;
    }
    
    .mythumb {}
    
    .card {
      border: none!important;
    }
    
    .thumb-img {
      /*max-width: 125px;*/
      /*max-height: 125px;*/
      /*  max-width: 200px;*/
      /*  max-height: 200px;*/
      /*cursor: pointer;*/
      border: solid 1px #282828;
      border-radius: 5px;
    }
    
    .thumb-txt {
      font-size: 10px!important;
      margin-top: 3px;
      margin-left: 1px;
      color: white;
      line-height: 11px;
    }
    .products-container .flex-item {
        margin: 0 1em 0 0;
    }

    p.order-sample-text {
      color: #fff;
      font-size: .8em;
      padding: 1em 0 1em 0;
    }


  </style>
  
  <div class=' bkgr-black' style=''>

    <!-- Main image -->
    <div class='row fixrow' style='padding-bottom: 9px; position: relative;'>
        <?=$img?>
<!--        <span style="position:absolute; right:0; margin: 10px;">-->
<!--            <img class="--><?php //=($is_new ? "" : "hide")?><!--" src="--><?php //=asset_url()?><!--images/new_sticker.png" />-->
<!--        </span>-->

        <span class="btn-custom-pinterest">
            <a data-pin-do="buttonBookmark" data-pin-tall="true" data-pin-round="true" href="https://www.pinterest.com/pin/create/button/">
                <img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_round_red_32.png" />
            </a>
        </span>
    </div>

    <div class='row fixrow'>

      <div class='col-12 col-md-6 p-0 hide'>

      </div>

      <div class='col-12 col-md-4 specbox'>

        <div class='leftContainer'>
          <div class='row fixrow'>
            <p class='m-0 text-justify <?=($purpose == 'digital_styles' ? '' : ' hide ')?>'>
              Digital Pattern
            </p>
            <p class="lead product-name text-justify w-100 mt-0">
              <?=$aux['NAME']?>
            </p>
            <p class="product-desc ">
              <?=stripslashes($aux['DESCRIPTION'])?>
            </p>
          </div>

          <dl class='row fixrow' style='font-size: 10px;'>
            <!-- Spec info -->
            <?
//            $cleaningLink = $documents["cleaning"];
            $cleaningLink = site_url("cleanings");
            foreach($spec as $row){

              if(count($row['data']) > 0){
    ?>
              <dt class='col-6 text-uppercase p-0'>
                  <?=(strtolower($row['text'])=="cleaning"?"<a class='oz-color' href='$cleaningLink'>".$row['text']."</a>":$row['text'])?>:
              </dt>
              <?
                $counter = 0;
                foreach($row['data'] as $dato){
                  $counter++; $offset = ''; $noMargin = '';
                  if($counter < count($row['data'])){
                    $offset = "<dd class='col-6 m-0'></dd>";
                    $noMargin = 'm-0';
                  }
    ?>
                <dd class='col-6 <?=$noMargin?> p-0'>
                  <?=$dato?>
                </dd>
                <?=$offset?>
                  <?
                }
              }
            }
    ?>
          </dl>
          <!-- <div class='d-flex flex-column justify-content-between '> -->
          <div class='d-flex flex-column'>
                <?//=$btnSpecUrl?>

<?php
      //echo "<pre> SPEC ";
			//print_r( $spec_data );
			//echo "</pre>";
?>

                <a href='<?php echo $SpecUrl."/~web"; ?>' class='<?=($purpose == 'digital_styles' ? 'hide ' : ' ')?> btnSpec oz-color mt-4 <?=strlen($SpecUrl)==0?"hide":""?>' target='_blank'>DOWNLOAD SPEC SHEET</a>
                <a href="mailto: ?subject=I'd%20like%20to%20share%20an%20Opuzen%20fabric%20with%20you&amp;body=Hi%2C%0A%0AI%20thought%20you%20might%20be%20interested%20in%20this%20item%20from%20Opuzen%3A%0A%0A<?=site_url( 'product/'.($purpose == 'digital_styles' ? 'digital/' : '' ) . $aux['url_title'] )?>%0A%0ABest%2C" class='btnSpec oz-color mt-2'>SHARE</a>
                <a href='<?=$WarrantyUrl?>' class='<?=(($purpose == 'digital_styles' or strlen($WarrantyUrl) == 0) ? 'hide ' : ' ')?> btnSpec oz-color mt-2' target='_blank'>WARRANTY</a>
              <a href='<?=$CareInstrUrl?>' class='<?=(($purpose == 'digital_styles' or strlen($CareInstrUrl) == 0) ? 'hide ' : ' ')?> btnSpec oz-color mt-2' target='_blank'>CARE INSTRUCTIONS</a>
          </div>
          <div class='row mx-0 mt-4 mb-5' style=''>
<!--              <p style="font-size:11px">To order samples please contact Opuzen at <a href='mailto:warehousesampling@opuzen.com' class="oz-color">warehousesampling@opuzen.com</a> or call <nobr><a href='tel:+1-323-549-3489' class="oz-color">323-549-3489</a></nobr></p>-->
              <a class="btn bkgr-green-op digital-btns" href="mailto:warehousesampling@opuzen.com?subject=Order%20Samples&amp;body=Thank%20you%20for%20your%20memo%20request.%20Please%20advise%20the%20following:%0A%0AName%20of%20Fabric:%0AColor:%0AItem%20#:%0ASample%20Qty:%0AApplication:%0A%0AYour%20Name:%0AEmail:%0APhone%20Number:%0AShipping%20Address:%0A%0AIs%20this%20for%20a%20Residential%20or%20Hospitality/Commercial%20project?%0A%0AWhat%20is%20the%20project%20name/sidemark?%0A%0AWhich%20design%20firm%20are%20you%20with?%0A%0A">ORDER SAMPLES HERE</a>
              <br / >
              <p class="order-sample-text">Or send your request to info@opuzen.com</p>
          </div>
        </div>

      </div>

      <div class='col-12 col-md-8' style='padding: 10px 0 10px 10px;'>
<!--      <div class='col-12 col-md-8' style='padding: 10px 0 10px 10px'>-->
        <div class='d-flex flex-row justify-content-start align-items-center go-back-row oz-color' style='margin-top: 0; margin-left: 65px;'>
          <i class="fa fa-chevron-left" style='font-size: 19px;cursor:pointer;' aria-hidden="true" onclick="goBack('<?=$url_title?>')"></i>
          <p class='m-0 pl-1' style='font-size:12px;cursor:pointer;' onclick="goBack('<?=$url_title?>')">Back</p>
        </div>

          <!-- Colorways -->
          <?
            include('colorway_list.php');
          ?>

      </div>

    </div>

  </div>
