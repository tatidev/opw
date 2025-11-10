<style>
  .modal-open {
    padding: 0!important;
  }

  .modal-dialog {
    margin-top: 8%;
    max-width: 800px;
    ;
  }

  .modal-content {
    padding: 15px;
    /*background-color: black;*/
  }

  .modal-header {
      color: white;
      padding: 5px 0;
      /* background-color: #bfac02; */
      border: none;
      font-size: 14px;
      font-weight: bold;
  }


  .#thumbName>p {
    line-height: 15px;
    color: white;
  }

  #image400 {
    width: 400px;
    height: 400px;
  }

  .modal-footer {
    justify-content: center;
    font-size: 12px;
    background-color: #E0E0E0;
  }

  #spec-container {
    font-size: 10px;
  }

  #spec-container>dt {
    padding: 0 !important;
    text-transform: uppercase;
      font-weight: normal;
  }

  #spec-container>dd {
    padding: 0 !important;
  }

  .modalBtnSpec,
  .btnDownloadImg,
  .btnShare {
    /*background-color: #909090;*/
    /*border-radius: 0;*/
  }

  .modalBtnSpec:hover,
  .btnDownloadImg:hover,
  .btnShare:hover {
    /*opacity: 0.8;*/
      color: white;
  }

  .modalBtnSpec>p,
  .btnDownloadImg>p,
  .btnShare>p {
    /*color: white;*/
    font-weight: bold;
    /*font-size: 12px;*/
  }

  #icon-bar-footer>p {
    margin: 0;
    padding: 6px;
  }

  #icon-bar-footer>p:hover {
    cursor: pointer;
    font-weight: bold;
  }

  @media (max-width: 736px) {
    .modal-dialog {
      margin: 0!important;
      max-width: none!important;
    }
    #image400 {
      height: auto;
    }
  }

  .products-container {
    overflow: hidden;
  }

  .modal-footer {
    border: none;
  }
</style>


<div class="modal-header">
<!--  <p class="modal-title ml-auto p-0">DIGITAL GROUND DETAILS</p>-->
  <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
    <span class='mr-1' aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-body row py-0">
  <div class='col-12 col-md-4' style='color:white;'>
    <div class='specbox'>
      <div class='row mx-0 mb-4' style='line-height: 19px; font-size:12px;'>
        <p><b>Digital Ground Detail</b></p>
<!--        <p class="lead product-name text-justify w-100 m-0">--><?//=$item_data['name']?><!--</p>-->
<!--        <p class='product-color w-100 m-0'>--><?//=$item_data['color']?><!--</p>-->
<!--        <p class='product-code w-100 m-0'>--><?//=$item_data['code']?><!--</p>-->

          <p class="text-justify w-100 m-0"><?=$item_data['name']?></p>
          <p class='w-100 m-0'><?=$item_data['color']?></p>
          <p class='w-100 m-0'><?=$item_data['code']?></p>
      </div>

      <div class='col-12 col-md-8 hidden-sm-up mb-5'>
          <div class='d-flex justify-content-center'>
              <img id='image400' class='img-fluid image400' src='' style='' />
          </div>
          <p style="font-size: 11px;text-align: center;color: white;">Actual colors may vary from what appears on your screen.</p>
      </div>


      <dl id='spec-container' class='row fixrow' style=''>
        <?
          foreach($spec as $s){
        ?>
            <dt class='col-6'><?=$s['text']?>:</dt>
        <?  
            $n = 0;
            foreach($s['data'] as $d){
        ?>
              <dd class="col-6 <?=( $n !== 0 && count($s['data']) > $n ? 'offset-6' : '' )?>"><?=$d?></dd>
        <?    
              $n++;
            }
          }
        ?>
      </dl>

    </div>

    <!--
              <a id='btnDownloadImg' class='btn p-1 my-3 hide' style='background-color: #909090;'>
                <i class="fa fa-download fa-4" aria-hidden="true"></i>
                <p class='d-inline' style='color:white;font-weight:bold;font-size:12px;'> DOWNLOAD</p>
              </a>-->

    <div class='d-flex flex-column flex-nowrap align-items-start justify-content-between'>
        <a id='modal-dp-gr-BtnSpec' href='<?=$specSrc?>' class='btnSpec oz-color mt-4 my-1 py-1  <?=($purpose == ' digital_styles ' ? 'hide ' : ' ')?>' target='_blank'>
            <p class='d-inline'>DOWNLOAD SPEC SHEET</p>
        </a>

      <a id='dp-gr-btnDownloadImg' target="_blank" href='<?=$downloadSrc?>' download='<?=$item_data['name'] . '-' . str_replace(' ', '', str_replace(' / ', '-', $item_data['color']))?>' class='btnDownloadImg btnSpec oz-color py-1 my-1 hidden-sm-down'>
        <p class='d-inline'> DOWNLOAD IMAGE</p>
      </a>

      <a id='modal-dp-gr-btnShare' class='btnShare btnSpec oz-color py-1 my-1' href="<?=$shareUrl?>" onclick="javascript: console.log( $(this).attr('href') )">
        <p class='d-inline'> SHARE</p>
      </a>
    </div>

      <div class='d-flex flex-column flex-nowrap align-items-start justify-content-between my-4' style="font-size:11px; line-height: 19px;">
          <span>Actual colors may vary from what appears on your screen.</span>
<!--          <span>For 100% accuracy please order samples from:<br><a href='mailto:warehousesampling@opuzen.com' class="oz-color">warehousesampling@opuzen.com</a><br>or call <a href='tel:+01-323-549-3489' class="oz-color">323-549-3489</a></span>-->
          <a class="btn bkgr-green-op digital-btns mt-4" href="mailto:warehousesampling@opuzen.com?subject=Order%20Samples&amp;body=Thank%20you%20for%20your%20memo%20request.%20Please%20advise%20the%20following:%0A%0AName%20of%20Fabric:%0AColor:%0AItem%20#:%0ASample%20Qty:%0AApplication:%0A%0AYour%20Name:%0AEmail:%0APhone%20Number:%0AShipping%20Address:%0A%0AIs%20this%20for%20a%20Residential%20or%20Hospitality/Commercial%20project?%0A%0AWhat%20is%20the%20project%20name/sidemark?%0A%0AWhich%20design%20firm%20are%20you%20with?%0A%0A">ORDER SAMPLES</a>
      </div>

  </div>
  <div class='col-12 col-md-8 hidden-sm-down'>
      <div class='d-flex justify-content-center'>
          <img id='image400' class='img-fluid image400' src='' style='' />
      </div>
<!--      <p style="font-size: 11px;text-align: center;color: white;">Actual colors may vary from what appears on your screen.</p>-->
  </div>
</div>

<!--<p class="my-2" style="font-size:12px; color:white; text-align:center; ">-->
<!--    To order samples please contact Opuzen at <a href='mailto:warehousesampling@opuzen.com' class="oz-color">warehousesampling@opuzen.com</a> or call <a href='tel:+01-323-549-3489' class="oz-color">323-549-3489</a>-->
<!--</p>-->
