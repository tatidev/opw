<style>
    .mythumb {
        max-width: 175px!important;
        max-height: 175px!important;
        cursor: pointer;
        /*border: solid 1px #282828;*/
        /*border-radius: 5px;*/
    }
    .products-container .flex-item {
        margin: 0 1em 0 0;
    }
    .text-preview-item {
        font-size: 10px !important;
        margin-top: 3px;
        margin-left: 1px;
        color: white;
        line-height: 14px;
        max-width: 175px !important;
        max-height: 175px !important;
    }
}
</style>
<?
    function generate_thumbnail($row, $purpose, $clsImg, $clsTxt, $clsDiv, $yardage=null){

        $big_img_url = $row['pic_big_url'];
        $hd_img_url_available = $row['pic_hd_url']; # (strlen($row['pic_hd_url']) > 0 ? 'Y' : 'N');
        
        $url_title = isset($row['url_title']) ? $row['url_title'] : '';
        $item_id = $row['id'];
        $data_code = $row['code'];
        $data_name = $row['name'];
        $color = $row['color'];
        $html_code = (strlen($row['code']) > 0 ? $row['code'] . '<br>' : '');
        $html_name = (strlen($row['name']) > 35 ? substr($row['name'], 0, 35) . '..' : $row['name']);
	
	    $html_yardage = (!is_null($yardage) ? "<br><span class='closeout-color'><b>Available $yardage yds</b></span>" : '');

        //=======
//        return "<div class='$clsDiv' style='margin-right: 5px;'>
//        return "<div class='$clsDiv flex-item' style=''>
//                    <figure>
//                        <img data-src='$big_img_url'
//                             class='mythumb img-fluid $clsImg'
//>>>>>>> new_website

//        return "<div class='$clsDiv' style='max-width: 125px; max-height:200px; margin-right: 5px;'>
          return "<div class='$clsDiv flex-item ' style=''>
                    <figure>
                        <img data-src='$big_img_url'
                             class='mythumb img-fluid mx-auto $clsImg'

                             data-item-id='$item_id'
                             data-category='$purpose'
                             data-code='$data_code'
                             data-name='$data_name'
                             data-color='$color'
                             data-hd='$hd_img_url_available'
                             data-url-title='$url_title'>
                        <figcaption class='text-preview-item $clsTxt'>
                            $html_code
                            $html_name
                            <br>
                            $color
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

//	// Colors view
//	foreach ($colors_arr as $section) {
//		$purpose = $section['purpose'];
//		unset($section['purpose']);
//		$title = $section['title'];
//		unset($section['title']);
//
//		$total = count($section);
//		if ($total > 0) {
//			?>
<!---->
<!--            <h4 class='container-title --><?//= ($title == '' ? 'hide' : '') ?><!--'>-->
<!--                <b>--><?//= strtoupper($title) ?><!--</b> / --><?//= $total ?><!-- result--><?//= ($total > 1 ? 's' : '') ?>
<!--            </h4>-->
<!---->
<!--            <div class='products-container d-flex flex-row flex-wrap' style="--><?//=($search_page ? '' : 'margin-left: 65px;')?><!--">-->
<!--				-->
<!--				--><?//
//
//					foreach ($section as $row) {
//					    if(in_array($row['id'], $closeout_ids)){
//					        array_push($closeout_rows, $row);
//					        continue;
//					    }
//						echo generate_thumbnail($row, $purpose, $clsImg, $clsTxt, $clsDiv);
//					}
//				?>
<!--                <div style='clear: both;'></div>-->
<!---->
<?
    $colors_per_row = ($search_page ? 5 : 3);

	// Colors view
	foreach ($colors_arr as $section) {
		$purpose = $section['purpose'];
		unset($section['purpose']);
		$title = $section['title'];
		unset($section['title']);

        // If not Digital Styles, filter out items that are not visible on the website
        if( isset($category) && $category !== 'digital_styles'){
          $section = array_filter($section, function($item){
              return $item['prod_status_website_visibility'];
          });
        }

        // echo "<pre>get_item_web_visiblity(id)  ";
		// print_r($section);
		// echo "</pre>";

		$total = count($section);
		if ($total > 0) {
			?>

            <h4 class='container-title <?= ($title == '' ? 'hide' : '') ?>'>
                <b><?= strtoupper($title) ?></b> / <?= $total ?> result<?= ($total > 1 ? 's' : '') ?>
            </h4>

            <div class='products-container d-flex flex-row flex-wrap' style="<?=($search_page ? '' : 'margin-left: 65px;')?>">
                <!-- removed .justify-content-between -->

				<?
//					foreach ($section as $row) {
//					    if(in_array($row['id'], $closeout_ids)){
//					        array_push($closeout_rows, $row);
//					        continue;
//					    }
//						echo generate_thumbnail($row, $purpose, $clsImg, $clsTxt, $clsDiv);
//					}
                $c = 0;
                foreach ($section as $row) {

                    if(in_array($row['id'], $closeout_ids)){
                        array_push($closeout_rows, $row);
                        continue;
                    }
                    echo generate_thumbnail($row, $purpose, $clsImg, $clsTxt, $clsDiv);
                    $c = $c + 1;
                    if($c % $colors_per_row == 0){
                        echo "</div><div class='products-container d-flex flex-row flex-wrap justify-content-between' style='".($search_page ? '' : 'margin-left: 65px;')."'>";
                    }
                }
                if($c % $colors_per_row > 0){
                    for($j=0; $j<($c%$colors_per_row)-1; $j++){
                        echo "<div class='$clsDiv flex-item' style='width:175px;'></div>";
                    }
                }
				?>
                <div style='clear: both;'></div>

            </div>
			<?
		} // End if
	} // End foreach $section
    
    # Closeout starts here
    if(count($closeout_rows) > 0){
        ?>
                <h5 class="closeout-color" style="margin: 10px 0; <?=($search_page ? 'display:none;' : 'margin-left: 65px;')?> font-size: 12px;"><b><a href="/closeout">CLOSEOUT</a></b></h5>
<!--<<<<<<< HEAD-->
                <div class='products-container d-flex flex-row flex-wrap' style="<?=($search_page ? '' : 'margin-left: 65px;')?>">
				<?
                    $i = 0;
					foreach ($closeout_rows as $row) {
						echo generate_thumbnail($row, $purpose, $clsImg, $clsTxt, $clsDiv, $closeout_items[$i]['yardsAvailable']);
						$i += 1;
					}
				?>
                <div style='clear: both;'></div>
<!--=======-->
<!--                <div class='products-container d-flex flex-row flex-wrap justify-content-between' style="--><?//=($search_page ? '' : 'margin-left: 65px;')?><!--">-->
<!--				--><?//
//                    $c = 0;
//                    foreach ($section as $row) {
//    //                    if(in_array($row['id'], $closeout_ids)){
//    //                        array_push($closeout_rows, $row);
//    //                        continue;
//    //                    }
//                        echo generate_thumbnail($row, $purpose, $clsImg, $clsTxt, $clsDiv);
//                        $c = $c + 1;
//                        if($c % $colors_per_row == 0){
//                            echo "</div><div class='products-container d-flex flex-row flex-wrap justify-content-between' style='".($search_page ? '' : 'margin-left: 65px;')."'>";
//                        }
//                    }
//                    if($c % $colors_per_row > 0){
//                        for($j=0; $j<($c%$colors_per_row)-1; $j++){
//                            echo "<div class='$clsDiv flex-item' style='width:175px;'></div>";
//                        }
//                    }
//				?>
<!--                <div style='clear: both;'></div>-->
            </div>
<?php
    }
?>

<?
include('colorway_modal.php');
?>
<script>
    var spec_base_url = '<?=$SpecBaseUrl?>'
</script>
<script src="<?=asset_url()?>js/colorway_list.js?v=<?=rand()?>"></script>
<link rel="stylesheet" href="<?=asset_url()?>css/colorway_list.css">