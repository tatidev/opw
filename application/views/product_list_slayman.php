<script>
    var thisController = '<?php echo base_url("search/get_filtered_search"); ?>';
    var thisPage = '<?php echo "product_list_slayman"; ?>';
</script>
<script src="<?=asset_url()?>/js/colorway_list.js?v=<?=rand()?>"></script>
<div class='products-container d-flex flex-wrap '>
<?php
   foreach($search_values as $item){
      echo '<div class="product-wrap mr-2 my-1 pkl" style="float:left; position:relative;">';
      echo '  <span class="anchor_elem pkl" id="'.$item['name'].'"></span>';
      echo '  <a class="lisa-slayman-thumnail" href="'.site_url('product/'.$item['url_title']).'">';
      echo $item['thumnail_img_elem'];
      echo '  </a>';
      echo $item['isNew_sticker_elem'];
      echo '  <div class="text-preview pkl ">';
      echo '    <div class="pull-left">'.$item['name'].'</div>';
      echo '    <div class="pull-right">';
      echo '      '.$item['cant_items'].' '.$item['colors_text'].' ';
      echo '    </div>';
      echo '  </div><!-- text-preview -->';
      echo '</div><!-- product-wrap -->';
    }
?>
</div><!-- products-container -->
<div class='products-container-no-results hide'>
    No results found, please update filter choices.
</div>
<form id='product_view' method="post" accept-charset="utf-8" action="<?=site_url('product/')?>">
    <input type="hidden" name="category" id='category' value="" />
    <input type="hidden" name="member_id" id='member_id' value="" />
</form>






