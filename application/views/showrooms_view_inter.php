<div style="color:white;">
	<!--    --><?//=var_dump($options_states)?>
	<!--	<pre style="color:white;">--><?// var_dump($showrooms_data); ?><!--</pre>-->
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
        /*padding: 0 0 20px 0;*/
        /*margin: 0 0 15px 0;*/
        margin: 0 0 18px 0;
    }

    #showroom-blocks-wrap-v > .showroom-block {
        /*border-bottom: 1px solid white;*/
    }

    .showroom-name {
        font-size: 12px;
        /*font-weight: bold;*/
        text-transform: uppercase;
    }

    .showroom-name p {
        font-size: 12px;
        padding: 0 2px;
        color: #fff;
        /* font-family: 'Karla', sans-serif; */
        font-family: Verdana, Geneva, sans-serif;
        font-weight: 100;
        text-transform: uppercase;
    }

    .showroom-territory {
        /*font-weight: bold;*/
        word-wrap: break-word;
        margin-top: .5rem;
    }
    .territory-name {
        white-space: nowrap;
    }
    #showroom_blocks-wrap-v {
        padding: 0 17px;
        margin-left: 225px;
    }

    .showroom-rep-region {
        font-size: 1.1em;
        font-family: 'Karla', sans-serif;
        padding: .25em 0 .5em 0;
    }

</style>
<div class="row mt-3 mb-5">
    <div style="margin-bottom:32px;" class='col-12 filter-dropdown-container float-left'>
    </div>
    <div class="col-sm-12 col-md-6">
        <div id="showroom-blocks-wrap-v"class="d-flex flex-wrap flex-column" style="margin-left: 225px; padding: 0 17px;">
		    <?php
                // array of international territories
                $internl_terrs = [ 'Caribbean / Puerto Rico','Canada / Toronto', 'Hong Kong'];
                sort($internl_terrs);
			    
                foreach($internl_terrs as $i_terr){
                    echo '<div class="showroom-rep-region oz-color">'.$i_terr.'</div>';
                    foreach($showrooms_data as $sh_data){
                        if(!empty($sh_data['territory_INT']) && $sh_data['territory_INT'] == $i_terr){
				            $id = $sh_data['id'];
				            $name = $sh_data['name'];
                            $contact = (!empty($sh_data['contact'])) ? '<span class=\'showroom-contact\'><p>'.$sh_data['contact'].'</span> <br>': '';
				            $territory = (!is_null($sh_data['territory_display']) ? $sh_data['territory_display'] : !is_null($sh_data['territory_INT']) ) ? $sh_data['territory_INT'] : '';
				            $territory_type = !is_null($sh_data['territory_type']) ? $sh_data['terrritory_type']: '';
				            $address_street = !is_null($sh_data['address_street_1']) ? $sh_data['address_street_1'] . (strlen($sh_data['address_street_2']) > 0 ? "<br>".$sh_data['address_street_2'] : "") . "<br>" : "";
				            $address_more = !is_null($sh_data['address_street_1']) ? $sh_data['address_city'] . ', ' . $sh_data['address_state'] . ' ' . $sh_data['address_zipcode'] . "<br>" : "";
				            $phone_1 = !is_null($sh_data['phone_1']) ? "tel <a class='oz-color' href='tel:+1-".$sh_data['phone_1']."'>".str_replace('-', ' ', $sh_data['phone_1'])."</a><br>" : '';
				            $phone_2 = !is_null($sh_data['phone_2']) ? "tel <a class='oz-color' href='tel:+1-".$sh_data['phone_2']."'>".str_replace('-', ' ', $sh_data['phone_2'])."</a><br>" : '';
				            $email = !is_null($sh_data['email']) ? "email <a class='oz-color' href='mailto:".$sh_data['email']."'>".$sh_data['email']."</a><br>" : '';
				            $website = !is_null($sh_data['website']) ? "web <a class='oz-color' target='_blank' href='https://".$sh_data['website']."'>".$sh_data['website']."</a><br>" : '';
				            //			<span class='showroom-territory'>$territory</span> <br>
				        
				            echo "
                            <div id='$id' class='showroom-block d-flex flex-column'>
                               <!-- <div class='showroom-rep-region oz-color'>$ territory</div>  -->
                               <div class='showroom-name'><p>${name}</p></div>  
                                <div style=''>
                                    $contact
                                    $address_street
                                    $address_more
                                    $phone_1 $phone_2
                                    $email $website
                                </div>
                                <!-- <div class='showroom-territory'>$territory</div>  -->
                                <div class=''>$territory_type</div>
                            </div>
                            ";
                        } //if is international terr match
			        } // foreach showroom
                } //for each international terr  
		    ?>
        </div>
    </div>
    <div class="col-6" style="">
        <img class="d-md-block d-none float-right showroom-img" style="max-width:450px;" src="<?=asset_url()."images/showroom-main.jpg"?>" />
    </div>
<!--    <div id="showroom-blocks-wrap-h" style="padding: 65px 0px 17px 0px;" class="col-12 d-flex flex-wrap flex-row justify-content-around">-->
<!--    </div>-->
</div>

<div class="my-5 row">
    <div class="col text-center font-Karla" style="color:white;">
        If your area isn’t listed, please contact us directly<br>by phone <a class="phone-link" href="tel:+01-323-549-3489">+1 (323) 549-3489</a> or email <a class="email-link" href="mailto:info@opuzen.com">info@opuzen.com</a>
    </div>
</div>

<script>
    //var showrooms_data = JSON.parse('<?//=json_encode($showrooms_data)?>//');
    //
    //$(document).ready(function(){
    //    console.log(showrooms_data);
    //})
</script>