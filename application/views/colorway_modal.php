<div class="modal modal-colorway fade">
    <div class="modal-dialog" role="document" style=''>
        <div class="modal-content bkgr-black">
            <div class="modal-header">
                <p class="modal-title mx-auto p-0">COLORWAY DETAILS</p>
                <button type="button" class="close ml-auto" style="position:absolute;top:24px;right:15px;" data-dismiss="modal" aria-label="Close">
                    <span class='mr-1' aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body p-0">
                <div class='d-flex flex-column justify-content-center my-2'>
                    <p id='thumbName'></p>
                    <p id='thumbColor'></p>
                    <p id='thumbCode'></p>
                </div>

                <div class='d-flex justify-content-center mt-3'>
                    <img id='image400' style='' class='img-fluid' src=''>
                </div>
                <p class="mt-3" style="font-size: 11px;text-align: center;color: white;">Actual colors may vary from what appears on
                    your screen</p>

                <div class='d-flex flex-column align-items-center my-2'>
                    <!--              <form method='post' id='itemSpecForm' action='-->
					<? //=site_url('product/specsheet/R/')?><!--' target='_blank'>-->
                    <input type='hidden' name='member_id' value=''>
                    <a href='<?= $SpecBaseUrl ?>' target='_blank' id='modalBtnSpec'
                       class='modalBtnSpec btn px-2 py-0 mr-2 oz-color <?= ($purpose == 'digital_styles' ? 'hide ' : ' ') ?>'
                       style='cursor:pointer;'>
                        <p class='d-inline'>DOWNLOAD SPEC SHEET</p>
                    </a>
                    <!--              </form>-->

                    <a target='_blank' download='' href='' id='btnDownloadImg'
                       class='btn px-2 py-1 hidden-sm-down oz-color'>
                        <p class='d-inline'> DOWNLOAD IMAGE</p>
                    </a>
                </div>

                <p class="my-2" style="font-size:12px; color:white; text-align:center; ">
                    <a class="btn bkgr-green-op digital-btns" href="mailto:warehousesampling@opuzen.com?subject=Order%20Samples&amp;body=Thank%20you%20for%20your%20memo%20request.%20Please%20advise%20the%20following:%0A%0AName%20of%20Fabric:%0AColor:%0AItem%20#:%0AQty:%0AApplication:%0A%0AName:%0AEmail:%0APhone%20Number:%0AShipping%20Address:%0A%0AIs%20this%20for%20a%20Residential%20or%20Hospitality/Commercial%20project?%0A%0AWhat%20is%20the%20project%20name/sidemark?%0A%0AWhat%20design%2A0firm%20are%20you%20with?%0A%0A">ORDER SAMPLES</a>
<!--                    To order samples please contact Opuzen at <a href='mailto:warehousesampling@opuzen.com'-->
<!--                                                                 class="oz-color">warehousesampling@opuzen.com</a> or-->
<!--                    call <a href='tel:+01-323-549-3489' class="oz-color">323-549-3489</a>-->
                </p>
            </div>


            <!--          <div id='icon-bar-footer' class='modal-footer p-0 my-1 d-flex flex-row flex-nowrap align-items-center justify-content-center' style='background-color: #bfac02; color:white;'>-->
            <!--            <p id='howtoorder' data-tipped-options=" skin: 'mygrey', position: 'top', maxWidth: 300, size: 'large', inline: 'inline-tooltip-1'  ">How to order</p>-->
            <!--          </div>-->
            <!--          <div id='inline-tooltip-1' style='display:none'>-->
            <!--            To order samples please contact Opuzen at <a href='mailto:warehousesampling@opuzen.com'>warehousesampling@opuzen.com</a> or call <a href='tel:+01-323-549-3489'>323-549-3489</a>.-->
            <!--          </div>-->

            <!--          <div class='modal-footer p-0'>-->
            <!--            <p class='p-2 m-auto' style='line-height: 12px;'>-->
            <!--              Please note that screen samples may vary from actual colors.<br>Color depends on each monitor’s color calibration.-->
            <!--            </p>-->
            <!--          </div>-->

        </div>
    </div>
</div>