<style>
    .card {
        border: none !important;
    }

    .mythumb {
        /*max-width: 125px;*/
        /*max-height: 125px;*/
        cursor: pointer;
        /*border: solid 1px #282828;*/
        /*border-radius: 5px;*/
    }

    .text-preview-item {
        font-size: 10px !important;
        margin-top: 3px;
        margin-left: 1px;
        color: white;
        line-height: 14px;
    }

    .text-alt-style {
        color: #636c72 !important;
    }

    .img-alt-style {
        /*border-radius: 50% !important;*/
        /*border: none!important*/;
    }

    @media (max-width: 736px) {

    }

    .closeout-title {
        color: #c32107;
        font-weight:bold;
        margin: 20px 0;
    }
</style>
<?
	function generate_thumbnail($row, $purpose, $clsImg, $clsTxt, $clsDiv, $yardage=null){
		$big_img_url = $row['pic_big_url'];
		$hd_img_url_available = (strlen($row['pic_hd_url']) > 0 ? 'Y' : 'N');
		
		$url_title = isset($row['url_title']) ? $row['url_title'] : '';
		$item_id = $row['id'];
		$data_code = $row['code'];
		$data_name = $row['name'];
		$color = $row['color'];
		$html_code = (strlen($row['code']) > 0 ? $row['code'] : '');
		$html_name = (strlen($row['name']) > 35 ? substr($row['name'], 0, 35) . '..' : $row['name']);
		
		$html_yardage = (!is_null($yardage) ? "<br><span class='closeout-color'><b>Available $yardage yds</b></span>" : '');
		
		return "<div class='mb-3 $clsDiv' style='width: 230px; margin-right: 5px;'>
                    <figure>
                        <div style='max-height: 107px; overflow: hidden;'>
                            <img data-src='$big_img_url'
                                 class='mythumb img-fluid mx-auto $clsImg'
                                 data-item-id='$item_id'
                                 data-category='$purpose'
                                 data-code='$data_code'
                                 data-name='$data_name'
                                 data-color='$color'
                                 data-hd='$hd_img_url_available'
                                 data-url-title='$url_title'>
                        </div>
                        <figcaption class='text-preview-item $clsTxt'>
                            $html_name
                            <br>
                            $color<br />
                            $html_code
                            $html_yardage
                        </figcaption>
                    </figure>
                </div>
                ";
	}
	
	/*
	  Special Classes
	*/
	if (!strpos($_SERVER['REQUEST_URI'], 'product', 0)) {
		$search_page = true;
		$clsTxt = '';# 'text-alt-style';
		$clsImg = '';#'img-alt-style';
	} else {
		$search_page = false;
		$clsTxt = '';
		$clsImg = '';
	}
	$clsDiv = '';#; (!$search_page ? "margin: 5px;" : "margin-right:5px;");
	
	//		echo "<pre>"; var_dump($closeout_items); echo "<pre>";
	if(isset($closeout_items)){
		$closeout_ids = array_column($closeout_items, 'id');
		$closeout_rows = [];
	} else {
		$closeout_ids = [];
		$closeout_rows = [];
	}
	//		echo "<pre>"; var_dump($closeout_ids); echo "<pre>";
	
	// Colors view
	foreach ($colors_arr as $section) {
		$purpose = $section['purpose'];
		unset($section['purpose']);
		$title = $section['title'];
		unset($section['title']);
		
		$total = count($section);
		if ($total > 0) {
			?>

            <h4 class='container-title <?= ($title == '' ? 'hide' : '') ?>'>
                <b><?= strtoupper($title) ?></b> / <?= $total ?> result<?= ($total > 1 ? 's' : '') ?>
            </h4>

            <div class='products-container d-flex flex-row flex-wrap'">
				
				<?
					$i = 0;
					foreach ($section as $row) {
//						if(in_array($row['id'], $closeout_ids)){
//							array_push($closeout_rows, $row);
//							continue;
//						}
						echo generate_thumbnail($row, $purpose, $clsImg, $clsTxt, $clsDiv, $closeout_items[$i]['yardsAvailable']);
						$i++;
					}
				?>
                <div style='clear: both;'></div>
            </div>
			<?
		} // End if
	} // End foreach $section
?>
<style>
    .modal-open {
        padding: 0 !important;
    }

    .modal-dialog {
        /*margin-top: 8%;*/
        max-width: 450px;
    }

    .modal-content {
        padding: 15px;
        /*background-color: black;*/
    }

    .modal-header {
        color: white;
        padding: 5px 0;
        /*background-color: #bfac02;*/
        border: none;
        font-size: 14px;
        font-weight: bold;
    }

    #thumbName, #thumbColor, #thumbCode {
        color: white;
        text-align: center;
        margin-bottom: 0px !important;
        line-height: 20px;
        font-size: 13px;
    }

    #thumbName {
        text-transform: uppercase;
    }

    #image400 {
        /*max-width: 400px;*/
        width: 100%;
        /*border: solid 1px #282828;*/
    }

    .modal-footer {
        justify-content: center;
        font-size: 12px;
        background-color: #E0E0E0;
    }

    .modalBtnSpec, #btnDownloadImg {
        /*background-color: #909090; */
        /*border-radius:0;*/
    }

    .modalBtnSpec:hover, #btnDownloadImg:hover {
        /*opacity:0.8;*/
        color: white !important;
    }

    .modalBtnSpec > p, #btnDownloadImg > p {
        /*color:white;*/
        font-weight: bold;
        font-size: 12px;
    }

    #icon-bar-footer > p {
        margin: 0;
        padding: 6px;
    }

    #icon-bar-footer > p:hover {
        cursor: pointer;
        font-weight: bold;
    }

    .modal-footer {
        border: none;
    }

    @media (max-width: 736px) {
        .modal-dialog {
            margin: 0 !important;
            max-width: none !important;
        }


    }
</style>

<div class="modal modal-colorway fade">
    <div class="modal-dialog" role="document" style=''>
        <div class="modal-content bkgr-black">
            <div class="modal-header">
                <p class="modal-title ml-auto p-0">COLORWAY DETAILS</p>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
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
                <p style="font-size: 11px;text-align: center;color: white;">Actual colors may vary from what appears on
                    your screen.</p>

                <div class='d-flex flex-column align-items-center my-2'>
                    <!--              <form method='post' id='itemSpecForm' action='-->
					<? //=site_url('product/specsheet/R/')?><!--' target='_blank'>-->
                    <input type='hidden' name='member_id' value=''>
                    <a href='<?= $SpecBaseUrl ?>' target='_blank' id='modalBtnSpec'
                       class='modalBtnSpec btn px-2 py-1 mr-2 oz-color <?= ($purpose == 'digital_styles' ? 'hide ' : ' ') ?>'
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
                    To order samples please contact Opuzen at <a href='mailto:warehousesampling@opuzen.com'
                                                                 class="oz-color">warehousesampling@opuzen.com</a> or
                    call <a href='tel:+01-323-549-3489' class="oz-color">323-549-3489</a>
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

<script>
    var spec_base_url = '<?=$SpecBaseUrl?>'
    Tipped.create('#howtoorder');

    $('figure img').on('click', function () {
        //var isMobile = false; //initiate as false
        /* device detection
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
          /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;
        */
        if (true /*|| !isMobile*/) {
            console.log($(this));
            var item_id = $(this).attr('data-item-id');
            var pattern_name = $(this).attr('data-name');
            var item_id = $(this).attr('data-item-id');
            var color = $(this).attr('data-color');
            var code = $(this).attr('data-code');
            var href = $(this).attr('data-src');
            var pic_hd = $(this).attr('data-hd');
            var url_title = $(this).attr('data-url-title');
            console.log(url_title);

            // Update spec href
            if ($(this).attr('data-category') !== 'digital_styles_items') {

                $('#modalBtnSpec').removeClass('hide');
                // var site_url = $('#itemSpecForm').attr('action');
                // var i = site_url.lastIndexOf('specsheet/');
                //console.log('found '+i);
                var raw_url = spec_base_url; //site_url.slice(0, i+10);
                let product_url_title = url_title.split('/')[0]
                console.log(raw_url);
                raw_url += product_url_title;
                console.log(raw_url);
                $('#modalBtnSpec').attr('href', raw_url);
                $('#itemSpecForm').attr('action', raw_url);
                $('#itemSpecForm > input').val(item_id);

            } else {
                $('#modalBtnSpec').addClass('hide');
            }


            // Evalute if there exists a HD
            if (pic_hd === 'N') {
                $('#btnDownloadImg').addClass('hide')
                    .attr('href', '');
            } else {
                var srcHd = $(this).attr('data-src').replace('big/', '').replace('_items', '_items_hd');
                $('#btnDownloadImg').removeClass('hide')
                    .attr('download', pattern_name + '-' + color.replace(' / ', '-').replace(' ', ''))
                    .attr('href', srcHd);
            }

            $('#image400').attr('src', href);
            addthumbname(pattern_name, color, code);
            $('.modal.modal-colorway').modal('show');
        }
    });

    function addthumbname(pattern, color, code) {
        $('#thumbName').html(pattern);
        $('#thumbColor').html(color);
        $('#thumbCode').html(code);
    }

</script>