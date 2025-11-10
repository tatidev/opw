<div style="color:white;">
	<!--	    --><?//=var_dump($options_states)?>
	<!--		<pre style="color:white;">--><?// var_dump($showrooms_data); ?><!--</pre>-->
</div>

<style>
    .showroom-block {
        padding: 0 15px 0 0;
        width: 25%;
        margin: 25px 0;
        color: white;
        font-size: 11px;
    }
    .showroom-name {
        font-size: 12px;
        font-weight: bold;
    }
    .showroom-territory {
        font-weight: bold;
        word-wrap: break-word;
    }
    .territory-name {
        white-space: nowrap;
    }
    .btnback {
        
    }
</style>
<div class="row">
	
	<div class='col-3 filter-dropdown-container mt-3'>
		<select id='fl-state' placeholder='State' class="search-box">
			<?
				$i = 1;
				foreach($options_states as $st){
					?>
					<option class="" value="<?=$i?>" name='<?=$st?>' > <?=$st?></option>
					<?
					$i += 1;
				}
			?>
			<option class="hide" value="-1" name='' selected ></option>
		</select>
	</div>
	<div class="col-3" style="width: 450px; margin: -32px;">
		<img style="width:50%;" src="<?=asset_url()."images/showroom-main.jpg"?>" />
	</div>
	
	<div class="col-6 d-flex flex-wrap flex-row-reverse" style="/*margin: 45px 0 60px 0;*/">
		<?php
			foreach($showrooms_data as $sh_data){
				$id = $sh_data['id'];
				$name = $sh_data['name'];
				$territory = !is_null($sh_data['territory_display']) ? $sh_data['territory_display'] : (!is_null($sh_data['territory_states_US']) ? $sh_data['territory_states_US'] : '');
				$territory = explode(',', $territory);
				$territory_name_cls = "territory-name";
				$territory = "<span class='$territory_name_cls'>" . implode("</span> /  <span class='$territory_name_cls'>", $territory) . "</span>";
				
				$territory_type = !is_null($sh_data['territory_type']) ? $sh_data['territory_type']: '';
				$address_street = !is_null($sh_data['address_street_1']) ? $sh_data['address_street_1'] . (strlen($sh_data['address_street_2']) > 0 ? "<br>".$sh_data['address_street_2'] : "") . "<br>" : "";
				$address_more = !is_null($sh_data['address_street_1']) ? $sh_data['address_city'] . ', ' . $sh_data['address_state'] . ' ' . $sh_data['address_zipcode'] . "<br>" : "";
				$phone_1 = !is_null($sh_data['phone_1']) ? "tel <a class='oz-color' href='tel:+1-".$sh_data['phone_1']."'>".$sh_data['phone_1']."</a><br>" : '';
				$phone_2 = !is_null($sh_data['phone_2']) ? "tel <a class='oz-color' href='tel:+1-".$sh_data['phone_2']."'>".$sh_data['phone_2']."</a><br>" : '';
				$email = !is_null($sh_data['email']) ? "email <a class='oz-color' href='mailto:".$sh_data['email']."'>".$sh_data['email']."</a><br>" : '';
				$website = !is_null($sh_data['website']) ? "web <a class='oz-color' target='_blank' href='https://".$sh_data['website']."'>".$sh_data['website']."</a><br>" : '';
				//			<span class='showroom-territory'>$territory</span> <br>
				
				echo "
                        <div id='$id' class='showroom-block hide d-flex flex-column'>
                            <div class='showroom-territory'>$territory</div>
                            <div class=''>$territory_type</div>
                            <div style='margin-top: 13px;'>
                                <span class='showroom-name'>$name</span> <br>
                                $address_street
                                $address_more
                                $phone_1 $phone_2
                                $email $website
                            </div>
        
                        </div>
                    ";
			}
		?>
	</div>
</div>
<div class="mt-3">
	<br>
</div>

<script>
    var showrooms_data_json = '<?=json_encode($showrooms_data)?>';
    var showrooms_data = JSON.parse(showrooms_data_json);

    $(document).ready(function(){
        console.log(showrooms_data);
        initiate_dropdowns('.search-box', state_selection_callback);
    })

    function state_selection_callback(i){
        $('.showroom-block').addClass('hide');
        // Run when a new state is chosen
        // We need to gather the state name and filter from $showrooms_data
        const selected_state_names = $("select#fl-state").find("option:selected").map((i, o) => $(o).attr('name')).toArray();
        console.log("States:", selected_state_names);

        let showroom_ids_to_show = [];
        for(let i = 0; i < showrooms_data.length; ++i){
            const sh_data = showrooms_data[i];
            console.log(sh_data);
            if(sh_data.territory_states_US == null) continue;
            for(let j = 0; j < selected_state_names.length; ++j){
                if(sh_data.territory_states_US.includes(selected_state_names[j])){
                    console.log("ID:", sh_data.id, 'found for the states');
                    showroom_ids_to_show.push(sh_data.id);
                }
            }
        }
        console.log("showroom_ids_to_show", showroom_ids_to_show)
        const multi_id_selector = showroom_ids_to_show.map((i, value) => ".showroom-block[id='"+i+"']");

        console.log(multi_id_selector.join(','))
        $(multi_id_selector.join(',')).removeClass('hide');
    }
</script>