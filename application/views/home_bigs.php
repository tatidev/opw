<?//=$anim?>
<div id="slideshow" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
		<?
			$c = 0;
			foreach($images as $img){
				$c += 1;
				if($c == 1){
					?>
					<div class="carousel-item active">
						<img class="d-block img-fluid fixwidth force-preload" src="<?php echo asset_url(); ?>images/home/slide/<?=$img?>" alt="<?=$c?>">
					</div>
					<?
				} else {
					?>
					<div class="carousel-item">
						<img class="d-block img-fluid fixwidth force-preload" src="<?php echo asset_url(); ?>images/home/slide/<?=$img?>" alt="<?=$c?>">
					</div>
					<?
				}
				
				
			}
		?>
	</div>
</div>

<style>
    #instagram-feed {
        width:100%;
        margin:auto;
        margin-top: 50px;
        margin-bottom: 50px;
    }
    #sbi_images {
	    padding: 0 !important;
	    display: flex !important;
        justify-content: space-between !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
    }
    #sb_instagram.sbi_col_4 #sbi_images .sbi_item {
	    width: 23% !important;
    }
    .sbi_follow_btn > a{
        background: transparent !important;
        /*text-align: center;*/
        /*margin-bottom: 0px;*/
        color: #bfac02 !important;
        /*font-size: 11px !important;*/
        font-weight: bold !important;
    }
    
</style>
<script>
    var feed1 = {
        // https://smashballoon.com/instagram-feed/standalone/settings
        "path": "<?=asset_url()?>others/instagram-feed-pro-standalone/connect.php",
        "user": "opuzendesign", //Separate multiple User names with commas. Must have a related access token for the user entered into the config.php file
        "num" : "4", //Number of posts to display
	    "cachetime" : "30", //Number of minutes until the plugin will look for new posts. Set to "0" to disable caching.
	    "showcaption": false,
	    "showlikes": false,
	    "showheader": false,
	    "lightboxcomments": false,
	    "showbutton": false,
	    "followtext": "FOLLOW US ON INSTAGRAM"
    };
    $(document).ready(function() {
        $('#slideshow').carousel({
            interval: 3000
        });

        $('#sbi_images').parent().prepend( $('#sbi_load') );

    });

    function redir(call) {
        window.location = $(call).attr('href');
    }
</script>

<div id="instagram-feed">
	<div id="sb_instagram" class="sbi" data-settings="feed1"></div>
</div>

<link href='<?=asset_url()?>others/instagram-feed-pro-standalone/instagram-feed/css/sb-instagram-standalone-3.3.min.css' rel='stylesheet' id='sb_instagram_standalone_styles-css' type='text/css' media='all' />
<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.6.3' rel='stylesheet' id='sbi-font-awesome-css' type='text/css' media='all' />
<script src='<?=asset_url()?>others/instagram-feed-pro-standalone/instagram-feed/js/sb-instagram-standalone-3.3.min.js' id='sb_instagram_standalone_scripts-js' type='text/javascript'></script>
