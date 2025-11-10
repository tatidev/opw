<style>
    a[href^="tel:"] {
        color: white;
    }
    @media (max-width: 736px){
        .content-text {
            display: block;
        }

    }

</style>

<div class='bkgr-white'>
	<img class='img-fluid' src="<?=$contact_map_url?>" usemap="#Map">
	
	<div class="bkgr-black">
		
		<?
			$counter = 0;
			foreach($locations as $shop){
				$counter++;
				$border = ( $counter < count($locations) ? "border-bottom: solid 1px #bfac02;" : '');
				?>
				<div class="row fixrow p-3  contactItem" style='line-height: 20px;<?=$border?>'>
					<div class="col-12 h-3 oz-color point-me">
						<a href="<?=$shop['link']?>" style='color: #bfac02;' target='_blank'><?=$shop['name']?></a>
					</div><br>
					<div class='col-lg-12'>
						<?
							$cant = 0;
							foreach($shop['info'] as $text){
								?>
								<span class='content-text'><?=$text?></span>
								<?
							}
						?>
					
					</div>
				
				</div>
				
				<?
			}
		?>
	
	</div>
	
	<map name="Map" id="Map">
		<area alt="" title="8687 Melrose Ave., West Hollywood, CA 90069 " href="https://goo.gl/maps/DN1vp" target="_blank" shape="poly" coords="506,120,508,162,376,164,373,120" />
		<area alt="" title="5788 Venice Blvd., Los Angeles, CA 90019" href="https://goo.gl/maps/jN6oG" target="_blank" shape="poly" coords="561,252,565,306,449,300,451,249" />
		<area alt="" title="345 N. Oak St., Inglewood, CA 90302" href="https://goo.gl/maps/QsJWiT1eAis" target="_blank" shape="poly" coords="512,551,514,484,661,486,657,548" />
	</map>