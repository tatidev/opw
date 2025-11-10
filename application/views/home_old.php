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
		.box {
			max-width: 323px;
			width: 49%!important;
			height: 49%!important;
		}
		
		.box-social {
			max-width: 158px;
			max-height: 158px;
			margin-right: auto!important;
			margin-left: auto!important;
		}
		
		.box-social-2 {
			max-width: 316px;
			max-height: 316px;
			margin-right: auto!important;
			margin-left: auto!important;
		}
		
		.box-social:nth-child(2n) {
			margin-right: 0!important;
		}
		
		.box-social-md-down {
			display: none;
		}
		
		@media (max-width: 736px) {
			.box:last-child {
				margin-right: 0!important;
			}
			.box-social {
				width: 24%!important;
				margin-right: 0!important;
				margin-left: 0!important;
			}
			.box-social-md-down {
				display: inline;
				margin-top: 10px;
			}
		}
		
		@media (max-width: 767px){
			
		}
		
		@media (max-width: 1024px) {
			.box-social {
				width: 49%;
			}
		}
		
		.fa {
			color: black;
		}
		
		.box:hover,	.box-social:hover {
			opacity: 0.6;
			cursor: pointer;
		}

        #instagram-feed {
            width:100%;
            margin:auto;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        #instagram-feed > p {
            text-align: center;
            margin-bottom: 0px;
            color: #bfac02;
            font-size: 11px;
            font-weight: bold;
        }
        .instagram-image:hover, .instagram-sidecar:hover {
            opacity: 0.5;
        }
	</style>

	<?
	$facebook = 'https://www.facebook.com/Opuzen-Design-276133809220546/';
	$instagram = 'https://www.instagram.com/opuzendesign/';
	$linkedin = 'https://www.linkedin.com/company/opuzen-design';
	$pinterest = 'https://www.pinterest.com/opuzen0457/';
?>

		<script>
			$(document).ready(function() {
				$('#slideshow').carousel({
					interval: 3000
				});
			});

			function redir(call) {
				window.location = $(call).attr('href');
			}
		</script>


        <div id="instagram-feed">
            <p><a class="nostyle" href="https://www.instagram.com/opuzendesign/" target="_blank">FOLLOW US ON INSTAGRAM</a></p>
            <div id="instagram-feed-content" class="d-flex"></div>
        </div>

<style>
    a.nostyle:link, a.nostyle:visited {
        text-decoration: inherit;
        color: inherit;
        /*cursor: auto;*/
    }

    #instagram-feed-content, .instagram_gallery {
        text-align: center;
    }
    .instagram-image, .instagram-sidecar {
        /*width: 92px;*/
        /*height: 72px;*/
        /*width: 25%;*/
        /*height: 100px;*/
        width: 25%;
        height: 190px;
        margin: 1% 2%;
        position: relative;
        display: inline-block;
        overflow: hidden;
    }
    .instagram-image > img, .instagram-sidecar > img {
        width: 100%;
        
        margin: -10px 0 0 0;
    }
    .instagram-image > img.resized {
        height: 100%;
        width: initial;
        margin: 0;
    }
</style>
<script>
    function fix_instagram_thumbs(){
        $(".instagram-image > img").each(function(ix, imgDOM){
                var jimg = $(imgDOM);
                const w = jimg.get(0).naturalWidth;
                const h = jimg.get(0).naturalHeight;
                // console.log(jimg.width(), jimg.height());
                // console.log(w, h, w>h);
                if (w >= h){
                    jimg.addClass("resized");
                }
            }
        )
    }

    $(document).ready(function(){
        var feed = new Instafeed({
            accessToken: 'IGQVJYNTZA3UWhtSWNnaEI2RzBBVjRNNnhqZAzYyVFJ0clU2Y0o4QU5LejdfOVExOTN1WU1nNFlnWHM5S2lSbC0tc1dQZAzdDZAFNpR3ZAxd0VEUG5pWU9McVlOemZAEb2ZA2ZAEFkeFBFazliMWFmLWJoM1lDTgZDZD',
            target: 'instagram-feed-content',
            limit: 4,
            template: '<a class="instagram-image" href="{{link}}" target="_blank"><img title="{{caption}}" src="{{image}}" /></a>',
            // transform: function(item){
            //     console.log(item);
            //     return item;
            // },

            // render: function(obj){
            //     // getMeta(obj.link, console.log);
            //     return '<a class="instagram-image" href="'+obj.link+'" target="_blank"><img title="'+obj.caption+'" src="'+obj.image+'" /></a>'
            // },
            // success: function(i){
            //     console.log("Success", i)
            // },
            // mock: true,
            after: function(){
                setTimeout(fix_instagram_thumbs, 500);
            }
        });
        feed.run();
    })
</script>