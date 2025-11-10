<div class='d-flex flex-column py-2'>
  <p class='m-0 container-title'>
      <b>SEARCH:</b> <?=$txtsearch?> / <?=$totalFound?> result<?=($totalFound>1?'s':'')?> found
  </p>
</div>

<div class='products-container-no-results <?=($totalFound==0?'':'hide')?>' style="padding-top:0px;">
  Please contact Opuzen for information at <a class="" style="color: white;" href="tel:+01-323-549-3489">323 549 3489</a> or <a href='mailto:info@opuzen.com' style='color:white'>info@opuzen.com</a>. <?//="'".$txtsearch."'"?>
</div>

<?
// Keywords View
if( count($keywords_arr) > 0 ){
    foreach($keywords_arr as $section){
        $purpose = $section['purpose'];
        $title = $section['title'];
        unset($section['purpose']);
        unset($section['title']);
        $total = count($section);
        if($total > 0){
        ?>
        <h4 class="container-title">
            <b><?=strtoupper($title)?></b> / <?=$total?> result<?=($total>1?'s':'')?>
        </h4>

        <ul class='container-title mb-4'>
        <?
            foreach($section as $row){
//                $href_path = implode('/', [strtolower($row['g']), strtolower($row['name'])])
            ?>
                <li>
<!--                    <a class="oz-color" href="--><?php //=site_url($href_path)?><!--" target="_blank">-->
                    <a class='oz-color redir' href="#" data-id='<?=$row['id']?>' data-name='<?=url_title( str_replace('/', ' ', $row['name']), '-', true)?>' data-contr='<?=strtolower($row['g'])?>'>
                        <?=$row['g']?>: <?=$row['name']?>
                    </a>
                </li>
            <?
            }
        ?>
        </ul>
        <?php

        }
    }
}

// Styles View
if( count($styles_arr) > 0 ){
  foreach($styles_arr as $section){
    $purpose = $section['purpose'];
    $title = $section['title'];
    unset($section['purpose']);
    unset($section['title']);
    $total = count($section);
    if($total > 0) {
  ?>

    <h4 class='container-title'>
      <b><?=strtoupper($title)?></b> / <?=$total?> result<?=($total>1?'s':'')?>
    </h4>

    <div class='products-container d-flex flex-wrap' style="padding-top:0px;">
<!--    <div class='products-container d-flex flex-wrap'>-->
        <?
          foreach($section as $row){
            // $visible_items_count = $this->model->get_prod_items_count_by_web_visibility($row['id'], 'R');
            // $row['count_of_visible_items'] = $visible_items_count['visible_items'];
						// echo "<pre>LINE:(". __LINE__   .") of ".__FILE__." - ";
		        // print_r( $row);
				    // echo "</pre>";

						if( !is_null( $row['pic_big_url'] ) ) {
							$url = $row['pic_big_url'];
						} else if ( !is_null($row['pic_big']) && !in_array($row['pic_big'], array('P', 'N')) ) {
							$url = image_src_path($purpose).$row['id'].'.jpg';
							/*
							if( !my_file_exists($url) ){
								$url = image_src_path($purpose).$row['id'].'.jpeg';
								if( !my_file_exists($url) ){
									$url = placeholder_image();
								}
							}
							*/
						} else {
							$url = placeholder_image();
						}
            //$placeholder = ( isset($row['big_pic']) ? ( $row['big_pic'] == 'P' ? true : false) : false );
            //$url = ( $placeholder ? $placeholder_url : image_src_path($purpose).$row['id'].'.jpg' );
            $img = img($url, false, array(
                                          'data-id'=>$row['id'], 
                                          'data-name'=>$row['url_title'], 
                                          'data-category'=>$purpose, 
                                          'class'=>'force-preload card-img-top image-preview mx-auto', //image-preview
                                          'style'=>'background-color: grey; max-width: 230px; max-height: 107px;', 
                                          'data-src'=>$url
                                          ) 
            );
        ?>



        <div class='mr-2 mb-4' style='float:left;'>
          <?
            switch($purpose){
              case 'fabrics':
                $href = site_url('product/'.$row['url_title']);
                break;
              case 'fabrics_items':
                $href = site_url('product/'.$row['url_title']);
                break;
              case 'digital_styles':
                $href = site_url('product/digital/'.$row['url_title']);
                break;
              default:
                $href = '#';
                break;
            }
          ?>
          <span class='anchor_elem' id='<?=$row['url_title']?>' ></span>
          <a href='<?=$href?>'>
            <?=$img?>
          </a>

          <div class='w-100 text-preview'>
            <div class='pull-left'>
              <?=( strlen($row['name']) > 30 ? substr($row['name'], 0, 29).'..' : $row['name'] )?>
            </div>
            <div class='pull-right'>
              <? 
                if( isset($row['count_of_visible_items']) && intval($row['count_of_visible_items']) > 0 ){
                    echo $row['count_of_visible_items'] . ' color'.(  $row['count_of_visible_items']    > 1 ? 's' : ''); 
                } elseif( intval($row['cant_items']) > 0 ) {
                    echo $row['cant_items']      . ' color'.(  $row['cant_items']    > 1 ? 's' : '');
                } else {
							  	  echo '';
							  }
              ?>
            </div>
          </div>

        </div>


        <?
          }
        ?>
          <div style='clear:both;'></div>
    </div>
    <?
    }
  }
}
    include('colorway_list.php');
    include('digital_ground_modal_view.php');
?>

      <form id='product_view' method="post" accept-charset="utf-8" action="<?=site_url('product/')?>">
        <input type="hidden" name="category" id='category' value="" />
        <input type="hidden" name="member_id" id='member_id' value="" />
      </form>



 