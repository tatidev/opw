<!--<div id="slideshow" class="carousel slide" data-ride="carousel">-->
<!--	<div class="carousel-inner" role="listbox">-->
<!--		--><? //
//		$c = 0;
//		foreach($images as $img){
//			$c += 1;
//			if($c == 1){
//				?>
<!--				<div class="carousel-item active">-->
<!--					<img class="d-block img-fluid fixwidth" src="--><? //=$img['src']?><!--" alt="--><? //=$img['alt']?><!--">-->
<!--				</div>-->
<!--				--><? //
//			} else {
//				?>
<!--				<div class="carousel-item">-->
<!--					<img class="d-block img-fluid fixwidth" src="--><? //=$img['src']?><!--" alt="--><? //=$img['alt']?><!--">-->
<!--				</div>-->
<!--				--><? //
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
    .welcome_vid {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 720px;
    }

    @media (max-width: 736px) {
        #mobileChange {
            -webkit-box-orient: vertical !important;
            -webkit-box-direction: normal !important;
            -webkit-flex-direction: column !important;
            -ms-flex-direction: column !important;
            flex-direction: column !important;
        }

        #mobileChange > div:first-child {
            min-height: 0px !important;
            min-width: 0px !important;
        }

        .content-text {
            min-height: 270px !important;
        }
    }

    .hosp-imgs-container {
        margin: 22px 30px 0 41px;
    }

    .hosp-imgs-container > .d-flex:first-child > img {
        width: 443px;
    }

    .hosp-imgs-container > .d-flex:first-child {
        margin-bottom: 25px;
    }

    .hosp-imgs-container > .d-flex:nth-child(2) > img:first-child {
        width: 554px;
        height: intrinsic;
    }
</style>

<div class='hosp-imgs-container' style=''>

    <div class="d-flex justify-content-between flex-wrap" style="">
        <!--        <img style="width:453px;" src="--><? //=$images[0]['src']?><!--">-->
        <!--        <img style="width:453px;" src="--><? //=$images[1]['src']?><!--">-->
        <img style="" src="<?= $images[0]['src'] ?>">
        <img style="" src="<?= $images[1]['src'] ?>">
    </div>
    <div class="d-flex justify-content-start flex-wrap" style="">
        <img style="" src="<?= $images[2]['src'] ?>">
        <img class="ml-auto" style="" src="<?= $images[3]['src'] ?>">
    </div>

    <!--    <div class="" style="margin: 30px 70px 100px 70px;color:white;font-size: 14px;text-align: justify;">-->
    <div class="" style="color:white;font-size: 12px;text-align: justify;margin: 30px 0;">
        <p>
            Opuzen does not put a price on style and innovation. We offer a range of signature fabrics specifically
            targeted to accommodate cost<br> conscious budgets of the residential, hospitality and commercial markets,
            without compromising that look that quality which sets us apart.
        </p>
        <p>
            <br>
            <div class="col text-center sections-subtitles-h2" style="color:white;">We Create Custom Sampling Packages!</div>
            <br><br>
            <div class="text-center">
                <video class="welcome_vid" controls autoplay loop muted>
                    <source src="https://opuzen.com/showcase/Package_Making_1.MP4" type="video/mp4">
                    This browser does not display the video tag.
                </video>
            </div>
            <br><br>
        </p>
        <p style="margin-bottom: 0.5rem;">
            HOSPITALITY:
            <span>Please contact <?= anchor(site_url('showrooms'), 'one of our representatives', " class='inline-link' ") ?> or call <a
                        class="inline-link" href="tel:+1-323-549-3489">323 549 3489</a> to discuss your distinctive requirements.</span>
        </p>
        <p>
            RESIDENTIAL:
            <span>Please contact <a class="inline-link" href="mailto:matt@opuzen.com">matt@opuzen.com</a> or call <a
                        class="inline-link" href="tel:+1-323-549-3489">323 549 3489</a> for your residential fabric needs.</span>
        </p>
    </div>

    <!--	<div id='mobileChange' class='d-flex flex-row '>-->
    <!--		<div class=' pt-4 pr-4 title side-style text-right' style='min-width: 300px;min-height: 330px;'>-->
    <!--			--><? //=$title?>
    <!--		</div>-->
    <!---->
    <!--		<div class=' p-4 bkgr-black content-text'>-->
    <!--			--><? //=$text?>
    <!--		</div>-->
    <!--	</div>-->

</div>