<?= $anim ?>
<script>
    $(document).ready(function () {
        if (window.location.hash == "") {
// <<<<<<< HEAD
            // const animation_delay = 4700;
            const START_ANIMATION_DELAY_SECS = 4;
            const CAROUSEL_NEXT_DELAY = 1;
            // $(".start").delay(ANIMATION_DELAY_SECS*1000).fadeOut(700);
            setTimeout(function () {
                $(".start").fadeOut(200);
                $('#slideshow').carousel({interval: CAROUSEL_NEXT_DELAY * 1000});
            }, START_ANIMATION_DELAY_SECS * 1000)
// =======
//             const animation_delay = 4700;
//             $(".start").delay(animation_delay).fadeOut(700);
// >>>>>>> new_website
        } else {
            $(".start").addClass('hide');
        }
    })
</script>
<style>
    .carousel-item:hover {
        cursor: pointer;
    }
</style>
<div id="slideshow" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        <?
        $c = 0;
        $carousel_indicators = [];
        foreach ($images as $img_data) {
            $img = $img_data['url'];
            $link = $img_data['link'];
            $name = $img_data['name'];
            $anchor_cls = "btn bkgr-green-op digital-btns";
            if ($c == 0) {
                $img_indicator = "<li data-target='#slideshow' data-slide-to='$c' class='active bkgr-green-op'></li>";
                ?>
                <div class="carousel-item active" onclick="window.location='<?= $link ?>'">
                    <!--<<<<<<< HEAD-->
                    <img class="d-block img-fluid fixwidth force-preload" src="<?= $img ?>" alt="<?= $name ?>">
                    <!--=======-->
                    <!--						<img class="d-block img-fluid fixwidth force-preload" src="-->
                    <? //=asset_url()
                    ?><!--images/home/slide/--><? //=$img
                    ?><!--" alt="--><? //=$name
                    ?><!--">-->
                    <!-->>>>>>> new_website-->
                    <!--                        <div class="carousel-item-annotation"><a class="--><? //=$anchor_cls
                    ?><!--" href="--><? //=$link
                    ?><!--">--><? //=$name
                    ?><!-- <i class="fa fa-arrow-circle-right"></i></a></div>-->
                </div>
                <?
            } else {
                $img_indicator = "<li data-target='#slideshow' data-slide-to='$c' class='bkgr-green-op'></li>";
                ?>
                <div class="carousel-item" onclick="window.location='<?= $link ?>'">
                    <!--<<<<<<< HEAD-->
                    <img class="d-block img-fluid fixwidth force-preload" src="<?= $img ?>" alt="<?= $name ?>">
                    <!--=======-->
                    <!--						<img class="d-block img-fluid fixwidth force-preload" src="-->
                    <?//=asset_url()?><!--images/home/slide/--><?//=$img?><!--" alt="--><?//=$name?><!--">-->
                    <!-->>>>>>> new_website-->
                    <!--                        <div class="carousel-item-annotation"><a class="-->
                    <?//=$anchor_cls?><!--" href="--><?//=$link?><!--">-->
                    <?//=$name?><!-- <i class="fa fa-arrow-circle-right"></i></a></div>-->
                </div>
                <?
            }
            $carousel_indicators[] = $img_indicator;
            $c += 1;
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#slideshow" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slideshow" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <ol class="carousel-indicators" style="bottom: -45px;">
        <?
        foreach ($carousel_indicators as $ind) {
            echo $ind;
        }
        ?>
    </ol>
</div>

<style>
    .carousel-control-next, .carousel-control-prev {
        width: 7% !important;
    }
    .carousel-indicators li .active {
        background-color: white !important;
    }

    .carousel-indicators li {
        max-width: 5px;
        height: 5px;
        border-radius: 100%;
        margin: 0 7.5px;
        background: #bfac02;
    }

    .carousel-item-annotation {
        position: fixed;
        right: 10px;
        z-index: 9999;
        bottom: 10px;
        color: white;
    }

    .fa-clone:before {
        display: none;
    }

    #instagram-feed {
        /*width: 50%;*/
        width: 60%;
        margin: auto;
        margin-top: 95px;
        margin-bottom: 15px;
    }

    #sbi_images {
        padding: 0;
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        flex-wrap: nowrap;
    }

    #sb_instagram.sbi_col_4 #sbi_images .sbi_item {
        width: 23%;
    }

    .sbi_photo img {
        height: inherit !important;
        width: 100% !important;
        object-fit: cover !important;
    }

    #sb_instagram .sbi_photo_wrap {
        /*height: 112px;*/
        height: 144px;
    }

    .sbi_follow_btn > a {
        background: transparent !important;
        /*text-align: center;*/
        /*margin-bottom: 0px;*/
        color: #bfac02 !important;
        font-size: 11px !important;
        font-weight: bold !important;
    }

    .sbi_follow_btn > a > i {
        font-size: 13px !important;
    }

    #sbi_load {
        margin-bottom: 6px;
    }

    .sbi_photo {
        height: 100%;
    }

    .fa-clone:before {
        display: none;
    }

    .sbi_playbtn {
        /* display: none!important; */
        opacity: 0;
    }
</style>
<script>
    //https://smashballoon.com/instagram-feed/standalone/settings, 
    var feed1 = {
        "path": "<?=asset_url()?>others/instagram-feed-pro-standalone/connect.php",
        "user": "opuzendesign", //Separate multiple User names with commas. Must have a related access token for the user entered into the config.php file
        "num": "4", //Number of posts to display
        "cachetime": "5", //Number of minutes until the plugin will look for new posts. Set to "0" to disable caching.
        "showcaption": false,
        "showlikes": false,
        "showheader": false,
        "lightboxcomments": false,
        "showbutton": false,
        "followtext": "FOLLOW US ON INSTAGRAM",
        'captionlinks': true
    };

    function sbi_custom_js() {
        /**
         * Custom callback function called by SB Instagram Feed
         */

        // Take out logo
        $("#sbi_load").find("i.fa-instagram").remove();

        /**
         * Move the "FOLLOW US" title to the top
         */
        // $('#sbi_images').parent().append($('#sbi_load'));
        $('#sbi_images').parent().prepend($('#sbi_load'));

        /**
         * Disable lightbox, and direct link to instagram when click
         */
        $('#sb_instagram .sbi_item').each(function () {
            $sbi_link_area = $(this).find('.sbi_link_area');
            $sbi_link_area.attr({
                'href': $sbi_link_area.attr('data-url'),
                'target': '_blank'
            }).removeAttr('data-lightbox-sbi');
            $sbi_link_area.find('.sbi_lightbox_link').remove();
        });
    }
</script>
<div id="instagram-feed" >
    <div id="sb_instagram" class="sbi" data-settings="feed1"> </div>
</div>

<link href='<?= asset_url() ?>others/instagram-feed-pro-standalone/instagram-feed/css/sb-instagram-standalone-3.3.min.css'
      rel='stylesheet' id='sb_instagram_standalone_styles-css' type='text/css' media='all'/>
<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.6.3' rel='stylesheet'
      id='sbi-font-awesome-css' type='text/css' media='all'/>
<script src='<?= asset_url() ?>others/instagram-feed-pro-standalone/instagram-feed/js/sb-instagram-standalone-3.3.min.js'
        id='sb_instagram_standalone_scripts-js' type='text/javascript'></script>
<script>
    // <<<<<<< HEAD
    // $(document).ready(function() {
    //     $('#slideshow').carousel({
    //         interval: 3000
    //     });
    // });
    // =======
    //     $(document).ready(function() {
    //         $('#slideshow').carousel({
    //             interval: 3000
    //         });
    //     });
    // >>>>>>> new_website

    function redir(call) {
        window.location = $(call).attr('href');
    }
</script>