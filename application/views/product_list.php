<script>
    var spec_base_url = '<?=$SpecBaseUrl?>';
    var thisController = '<?=base_url("search/get_filtered_search")?>';
    var thisPage = '<?php echo "product_list_template"; ?>';
</script>

<?
//<<<<<<< HEAD
//=======
//    include('filters_fab.php');
//>>>>>>> new_website
	include('colorway_modal.php');
?>
    <script src="<?=asset_url()?>/js/colorway_list.js?v=<?=rand()?>"></script>
    <link rel="stylesheet" href="<?=asset_url()?>/css/colorway_list.css?v=<?=rand()?>">

    <div class='products-container d-flex flex-wrap '>
    </div>
    <div class='products-container-no-results hide'>
        No results found, please update filter choices.
    </div>

    <form id='product_view' method="post" accept-charset="utf-8" action="<?=site_url('product/')?>">
        <input type="hidden" name="category" id='category' value="" />
        <input type="hidden" name="member_id" id='member_id' value="" />
    </form>
<style>
    .content-container {
        /* padding-top: 113px; */
        /* padding-top: 185px; */
        /* padding-top: 170px; */
         padding-top: 123px !important;
        /*padding-top: 170px;*/
    }
    .products-container {
        /* padding-top: 150px; */
        /* padding-top: 200px;*/
    }
</style>
<?
    include('digital_ground_modal_view.php');
?>