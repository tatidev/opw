<!--<pre>--><?//=var_dump($team)?><!--</pre>-->
<style>
    /*@font-face {*/
    /*    font-family: 'Creattion';*/
    /*    font-style: normal;*/
    /*    font-weight: normal;*/
    /*    src: local('Creattion'), url('*/<?php //=asset_url()?>/*Creattion.otf') format('truetype');*/
    /*}*/
    .font-creattion {
        font-family: 'Creattion', serif;
        /*font-size: 48px;*/
    }
    .about-text {
        color:white;
        margin: 40px 65px;
        color: white;
        line-height: 29px;
        font-size:13px;
    }
</style>
<div class="text-justify about-text">
    <em style="font-size:16px;">‘Opuzen is a way of being, a balance. Opulence joins zen, east meets west, richness and value unite.’</em>
    <br>
	Felicia French, Owner/President
	<br><br>
	Opuzen was founded in 1984 by Owner/President, Felicia French. With its inception as a one-woman
	operation firmly rooted in the craft of hand printing and dyeing of textiles, Opuzen has evolved and
	expanded into a premiere fabric supplier for the interior design industry, stocking well over 1000 SKUs
	in our local warehouse.
	<br><br>
	With a vast array of fabrics ranging from digital prints, one-of-a-kind woven upholstery and drapery/sheers
	to hand screen-printing, Opuzen is known worldwide for its innovative spirit, friendly customer service,
	glamorous and unique fabrics. Opuzen strives to bring the best products and services to every project,
	and prides itself on providing quality textiles at all ranges of price point.
</div>

<!--<link rel="preconnect" href="https://fonts.gstatic.com">-->
<!--<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">-->

<!--<div class="" style="margin:50px 0; color:white;">-->
<!--    <p class="font-creattion" style="text-align:center;font-size: 43px;">Meet the team</p>-->
<!--</div>-->

<div class="" style="margin:50px 0; color:white;">
    <div class="text-center sections-subtitles-h2" style="">Meet the team</div>
</div>

<style>
    .text-about {
    
    }
	.emp-photo {
	    width:100%;
	}
	.emp-data {
		color:white;
		/*font-size: 12px;*/
        line-height: 18px;
        margin: 3px 0 20px 0;
	}
    .emp-name {
        /*font-weight: bold;*/
        font-size: 13px;
        margin-bottom: 7px;
    }
    .emp-position {
        font-size: 11px;
        line-height: 15px;
    }
	.emp-box {
        width: 197px;
	}
</style>
<div class="d-flex flex-row flex-wrap justify-content-between">
	<?
		function create_thumb($employee_data=null){
		    if(is_null($employee_data)){
		        return "<div class='emp-box d-flex flex-column'></div>";
            }
			$img_src = S3_IMAGE_URL . 'team/' . $employee_data["img"];
			$name = $employee_data['name'];
			$position = $employee_data['position'];
			return "
				<div class='emp-box d-flex flex-column'>
					<img class='emp-photo' src='$img_src'>
					<div class='emp-data d-flex flex-column'>
						<span class='emp-name'>$name</span>
						<span class='emp-position'>$position</span>
					</div>
				</div>
			";
		}
		$NUM_PER_ROW = 4;
		$empty = $NUM_PER_ROW - (count($team)%$NUM_PER_ROW);
		foreach($team as $t){
			echo create_thumb($t);
		}
		for($i = 0; $i < $empty; $i++){
		    echo create_thumb();
        }
	?>
</div>
<script>
    $(document).ready(function(){
        $("img").unveil()
    })
</script>