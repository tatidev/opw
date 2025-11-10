<!--<div id="slideshow" class="carousel slide" data-ride="carousel">-->
<!--	<div class="carousel-inner" role="listbox">-->
<!--		--><?//
//		$c = 0;
//		foreach($images as $img){
//			$c += 1;
//			if($c == 1){
//				?>
<!--				<div class="carousel-item active">-->
<!--					<img class="d-block img-fluid fixwidth" src="--><?//=$img['src']?><!--" alt="--><?//=$img['alt']?><!--">-->
<!--				</div>-->
<!--				--><?//
//			} else {
//				?>
<!--				<div class="carousel-item">-->
<!--					<img class="d-block img-fluid fixwidth" src="--><?//=$img['src']?><!--" alt="--><?//=$img['alt']?><!--">-->
<!--				</div>-->
<!--				--><?//
//			}
//
//		}
//		?>
<!--	</div>-->
<!--</div>-->

<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $('#slideshow').carousel({-->
<!--            interval: 2000-->
<!--        });-->
<!--    });-->
<!--</script>-->
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

<style>
    .digital-btns {
        color:white!important;
        border-radius: inherit;
        font-size: 12px;
        font-weight: bold;
        line-height: 11px;
        min-width:150px;
    }
</style>
<div class='' style=''>

	<div class="d-flex justify-content-between mt-5" style="">
        <img src="<?=$images[0]['src']?>">
	</div>
    <div class="my-3">
        <a class="btn bkgr-green-op digital-btns" href="<?=site_url("digital/view-all")?>">PATTERNS</a>
        <a class="btn bkgr-green-op digital-btns" href="<?=site_url("digital/grounds/view-all")?>">GROUNDS</a>
    </div>

	<div class="" style="margin: 30px 70px 100px 70px;color:white;font-size: 13px;text-align: justify;">
        Opuzen specializes in digital printing. With our highly skilled on-site artists, we are able to create custom patterns in any scale and color tailored to suit your projects perfectly. Handling the production from start to finish we deliver a high quality custom fabric, uniquely manufactured just for you.<br><br>For more information please contact <a class="inline-link" href="mailto:digitaldept@opuzen.com">digitaldept@opuzen.com</a>
	</div>

</div>