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

    /* PKL Adjust for new Layout  */

    .centering-cont {
        margin: 0 auto;
    }

    .hosp-imgs-container .img-row-1 img,
    .hosp-imgs-container .img-row-2 img {
        height: auto;
    }

    .img-row-1 .img-row-1-left {
        width: 58%;
        margin: 1em 1em 0 1em;
    }
    .img-row-1 img.img-row-1-right {
        width: 35%;
        margin: 1em 0 0 0;
    }
    .img-row-2 .img-row-2-left {
        width: 34%;
        margin: 1em 3em 0 1em;
    }
    .img-row-2 img.img-row-2-right {
        width: 56%;
        margin: 1em 0 0 0;
    }

</style>

<div class='hosp-imgs-container' style=''>

    <div class="centering-cont" >
      <div class="img-row-1" style="">
        <a href="https://opuzen.com/product/digital/misty-mountain" >
          <img  class="img-row-1-left" style=""  src="<?php echo $images[0]['src'] ?>">
        </a>
        <a href="https://opuzen.com/product/sheepskin" >
          <img  class="img-row-1-right" style="" src="<?php echo $images[1]['src'] ?>">
        </a>
      </div>
      <div class="img-row-2" style="">
        <a href="https://opuzen.com/product/nevada" >
          <img  class="img-row-2-left" style="" src="<?php echo $images[2]['src'] ?>">
        </a>
        <a href="https://opuzen.com/product/zircon" >
          <img  class="img-row-2-right" style="" src="<?php echo $images[3]['src'] ?>">
        </a>
      </div>
    </div>


    <!--    <div class="" style="margin: 30px 70px 100px 70px;color:white;font-size: 14px;text-align: justify;">-->
    <div class="" style="color:white;font-size: 12px;text-align: justify;margin: 0 auto; padding: 50px 30px 30px 30px;">
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
            <span>Please contact <?php echo anchor(site_url('showrooms'), 'one of our representatives', " class='inline-link' ") ?> or call <a
                        class="inline-link" href="tel:+1-323-549-3489">323 549 3489</a> to discuss your distinctive requirements.</span>
        </p>
        <p>
            RESIDENTIAL:
            <span>Please contact <a class="inline-link" href="mailto:matt@opuzen.com">matt@opuzen.com</a> or call <a
                        class="inline-link" href="tel:+1-323-549-3489">323 549 3489</a> for your residential fabric needs.</span>
        </p>
    </div>

</div>