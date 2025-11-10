<div style="color:white;">
	<!--	    --><?//=var_dump($options_states)?>
	<!--		<pre style="color:white;">--><?// var_dump($showrooms_data); ?><!--</pre>-->
</div>

<style>
    .dropdown-menu {
        min-width: 9rem!important;
    }

    .showroom-block {
        /*padding: 0 15px 0 0;*/
        /*width: 25%;*/
        /*margin: 0 0 25px 0;*/
        color: white;
        font-size: 11px;
        max-width:250px;
        padding: 0 0 20px 0;
        margin: 0 0 15px 0;
    }

    #showroom-blocks-wrap-v > .showroom-block {
        border-bottom: 1px solid white;
    }

    .showroom-name {
        font-size: 12px;
        font-weight: bold;
    }
    .showroom-territory {
        /*font-weight: bold;*/
        word-wrap: break-word;
    }
    .territory-name {
        white-space: nowrap;
    }
    .digital-btns {
        min-width: 150px;
    }
    .about-text {
        color:white;
        /*margin: 40px 65px;*/
        color: white;
        font-size: 15px;
        line-height: 29px;
    }
</style>
<div class="row mt-3 mb-5">
    <div class="col-12">
        <a class="btn bkgr-green-op digital-btns mb-3" href="<?=site_url('showrooms/usa')?>">USA</a>
    </div>
	<div class="col-3">
        <a class="btn bkgr-green-op digital-btns" href="<?=site_url('showrooms/international')?>">INTERNATIONAL</a>
	</div>
    <div id="showroom-blocks-wrap-v" class="col-sm-12 col-md-3 d-flex flex-wrap flex-column">
    </div>
    <div class="col-sm-12 col-md-6" style="">
        <img class="d-md-block d-none float-right showroom-img" style="max-width:450px;" src="<?=asset_url()."images/showroom-main.jpg"?>" />
    </div>
</div>
<div class="mt-3">
	<br>
</div>
<div class="my-5 row">
    <div class="col text-center font-Karla" style="color:white;">
        If your area isn’t listed, please contact us directly<br>by phone <a class="phone-link" href="tel:+01-323-549-3489">+1 (323) 549-3489</a> or email <a class="email-link" href="mailto:info@opuzen.com">info@opuzen.com</a>
    </div>
</div>