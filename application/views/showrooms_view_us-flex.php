<div style="color:white;">
<!--	    --><?//=var_dump($options_states)?>
<!--		<pre style="color:white;">--><?// var_dump($showrooms_data); ?><!--</pre>-->
</div>

<style>

    .rep-state-chosen-title {
        font-size: 22px;
        margin-left: 225px;
        /* margin-bottom: 2em; */
        padding: 0 2px;
        color: #fff;
        font-family: 'Karla', sans-serif;
    }

    .showroom-rep-type {
        /* font-family: Verdana, Geneva, sans-serif; */
        font-size: 1em;
        padding: 0;
        color: #fff;
        font-weight: 600;
        margin-top: .5em;
    }

    .showroom-rep-region {
        font-size: 1.1em;
        font-family: 'Karla', sans-serif;
        padding: 1em 0 .5em 0;
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
    




    .showroom-territory {
        /*font-weight: bold;*/
        word-wrap: break-word;
        margin-top: .5rem;
    }
    .territory-name {
        white-space: nowrap;
    }
</style>
<div class="row mt-3 mb-5">
    
    <div class='col-12 filter-dropdown-container float-left'>
        <select id='fl-state' placeholder='State' class="search-box">
            <?
                $states_arr = [];
                foreach($options_states as $st){
                    $state_parts = explode("::", $st);
                    $state = $state_parts[0];
                    $states_arr[] = $state;
                }
                // Remove duplicates
                $uniqueStates = array_unique($states_arr);
                $i = 1;
                foreach($uniqueStates as $st){
                    ?>
                    <option class="" value="<?=$i?>" name='<?php echo $st; ?>' > <?php echo str_replace("_", " ", $st); ?></option>
                    <?
                    $i += 1;
                }
            ?>
            <option class="hide" value="-1" name='' selected ></option>
        </select>
    </div>
    <div class="col-sm-12 col-md-6">
        <h2 id="selected-state" class="rep-state-chosen-title"> </h2>
        <div id="showroom-blocks-wrap-v" class="d-flex flex-wrap flex-column" style="margin-left: 225px; padding: 0 2px;"></div>
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
	let showrooms_data_json = '<?=json_encode($showrooms_data)?>';
    let showrooms_data = JSON.parse(showrooms_data_json);

    $(document).ready(function(){
        console.log('showrooms_data:' , showrooms_data);
        initiate_dropdowns('.search-box', state_selection_callback);
    })

    function state_selection_callback(i){
        // Clear contents
        // $('.showroom-block').addClass('hide');
        const repsByStateRegions = [];
        const showroomData = [];
        const stateRegions = [];
        $("#showroom-blocks-wrap-v, #showroom-blocks-wrap-h").html("");
        $("#selected-state").text(" "+$("select#fl-state").find("option:selected").text().replace("_", " ").toUpperCase());
        
        // Run when a new state is chosen
        // We need to gather the state name and filter from $showrooms_data
        // const selected_state_obj = $("select#fl-state").find("option:selected").map((i, o) => $(o).attr('name')).toArray();
        selectedState = $("select#fl-state").find("option:selected").map((i, o) => $(o).attr('name')).toArray();
        console.log("-->Selected State:", selectedState);
        
        let showrooms_data_to_show = [];
        for(let i = 0; i < showrooms_data.length; ++i){
            const sh_data = showrooms_data[i];

            console.log('Line 37: sh_data:', sh_data);
            if(sh_data.territory_states_US == null) continue;
            // Build an array of Objects organized by state areas
            
            for(let j = 0; j < selectedState.length; ++j){
                if(sh_data.territory_states_US.includes(selectedState[j])){
                    console.log("INSIDE IF STATEMENT...");
                    repObj = {"state": selectedState[j]};
                    console.log(" repObj: ", repObj);
                    console.log("===================================");
                    //console.log("Selected State:", selectedState[j]);
                    const state_repType_Str = findStateEntry(sh_data.territory_states_US, selectedState[j]);
                    //console.log("state_repType_Str", state_repType_Str);
                    if(state_repType_Str && state_repType_Str.length > 0) {
                      console.log("state_repType_Str", state_repType_Str);
                      const state_repType_parts = state_repType_Str.split("::");
                      const selectedState = state_repType_parts[0];
                      const selectedSateArea = state_repType_parts[1];
                      const selectedRepType = state_repType_parts[2];
                      repObj["id"] = sh_data.id;
                      repObj["name"] = sh_data.name;
                      repObj["contact"] = sh_data.contact;
                      repObj["phone_1"] = sh_data.phone_1;
                      repObj["address_street_1"] = sh_data.address_street_1;
                      repObj["address_street_2"] = sh_data.address_street_2;
                      repObj["address_city"] = sh_data.address_city;
                      repObj["state"] = selectedState;
                      repObj["email"] = sh_data.email;
                      repObj["website"] = sh_data.website;
                      repObj["rep_type"] = selectedRepType;
                      repObj["region"] = (selectedSateArea && selectedSateArea.length > 0) ? selectedSateArea : "";
                      repObj["address_state"] = sh_data.address_state;
                      if(!stateRegions.includes(repObj.rep_area)){
                        stateRegions.push(repObj["region"]);
                      }
                      showroomData.push(repObj);
                      //showrooms_data_to_show.push(repObj);
                      console.log(" repObj: ", repObj);
                    }
                    //console.log('showrooms_data_to_show:', showrooms_data_to_show);
                    console.log("  ~~~  ");
                    console.log(" repObj: ", repObj);
                    console.log(" === showroomData: ", showroomData,  " === ");
                }
            }
            // showroomData.sort((a, b) => a.region.localeCompare(b.region));
        }
        
        let tgt_el = $("#showroom-blocks-wrap-v");
        // if(showrooms_data_to_show.length > 1){
        //     tgt_el = $("#showroom-blocks-wrap-h");
        // } else {
        //     tgt_el = $("#showroom-blocks-wrap-v");
        // }

        const groupedDataObjects = groupByRegionAsObjects(showroomData);
        console.log("  ~~~    ~~~    ~~~    ~~~ ");
        console.log(" SORTED groupedDataObjects: ",groupedDataObjects);
        console.log("  ~~~    ~~~    ~~~    ~~~ ");

        groupedDataObjects.forEach((region) => {
            tgt_el.append(`<div class='showroom-rep-region oz-color'>${ toTitleCase(region.region)}</div>`);
            region.items.forEach((repData) => {
                tgt_el.append(htmlShowroomRepInfo(repData));
            });
        });

        /*
        for(const repData of showroomData){
            console.log(" -=-=-=-  showroomData  -=-=-=- ", showroomData);
            console.log("=-=-=-=");
            console.log(" Line 190:  ", repData);
            console.log("=-=-=-=");
            tgt_el.append(htmlShowroomRepInfo(repData));
        }  */


        // for(const d of showrooms_data_to_show){
        //     tgt_el.append(html_showroom_info(d));
        // }
        
        // console.log("showroom_ids_to_show", showroom_ids_to_show)
        // const multi_id_selector = showroom_ids_to_show.map((i, value) => ".showroom-block[id='"+i+"']");
        // console.log(multi_id_selector.join(','))
        // $(multi_id_selector.join(',')).removeClass('hide');
    }

    function groupByRegionAsObjects(data) {
        const grouped = {};
    
        data.forEach(item => {
            if (!grouped[item.region]) {
                grouped[item.region] = [];
            }
            grouped[item.region].push(item);
        });
    
        return Object.keys(grouped).map(region => ({ region, items: grouped[region] }));
    }

    const findStateEntry = (stateString, stateName) => {
      const statesArray = (stateString.length > 1 )? stateString.split(",") : [];
      if (!Array.isArray(statesArray)) {
       console.log("findStateEntry::statesArray is NOT an array:", statesArray);
       return null; // Return null if not an array
      }
      const foundVals = [];
      statesArray.forEach((val, i) => {
        parts = val.split("::");
        preppedStateVal =parts[0].toLowerCase();
        //console.log("findStateEntry::stateName", stateName.toLowerCase());
        //console.log("findStateEntry::preppedStateVal", preppedStateVal);
        foundVal =  preppedStateVal === stateName.toLowerCase() ? val : null;
        if(foundVal !== null) {foundVals.push(foundVal)};
      });
      //console.log("findStateEntry::outsideMap:statesArray", foundVals);
      // return one value
      return foundVals.length > 0 ? foundVals[0] : null;
    };

    const not_null = (x) => x !== null;
    
    function htmlShowroomRepInfo(repObj){
        console.log("............................................");
        console.log(" htmlShowroomRepInfo(repObj) ", repObj);
        console.log("............................................");
        const id = repObj.id;
        const name = repObj.name;
        const region = repObj.region;
        const contact = not_null(repObj.contact) ? repObj.contact + "<br>" : '';
        const address_street = not_null(repObj.address_street_1) ? repObj.address_street_1 + (not_null(repObj.address_street_2) ? "<br>" + repObj.address_street_2 : "") + "<br>" : "";
        const address_more = not_null(repObj.address_street_1) ? repObj.address_city + ', ' +  repObj.address_state + ' ' + "<br>" : "";
        const phone_1 = (repObj.phone_1 !== undefined && repObj.phone_1 !== null ) ? "tel <a class='oz-color' href='tel:+1-" + repObj.phone_1 +"'>" + repObj.phone_1.replaceAll('-', ' ')+"</a><br>" : '';
        const phone_2 = (repObj.phone_2 !== undefined && repObj.phone_1 !== null ) ? "tel <a class='oz-color' href='tel:+1-" + repObj.phone_2 +"'>" + repObj.phone_1.replaceAll('-', ' ')+"</a><br>" : '';
        const email = not_null(repObj.email) ? "email <a class='oz-color' href='mailto:"+repObj.email+"'>" + repObj.email + "</a><br>" : '';
        const website = not_null(repObj.website) ? "web <a class='oz-color' target='_blank' href='https://"+repObj.website+"'>"+repObj.website+"</a><br>" : '';
        const rep_type = (repObj.rep_type !== undefined && repObj.rep_type !== null ) ? repObj.rep_type : '' ;
        
        return `<div id='${id}' class='showroom-block d-flex flex-column'>
                   <!-- <div class='showroom-rep-region oz-color'>${ toTitleCase(region)}</div> <br> -->
                   <div class='showroom-rep-type'>${rep_type.toUpperCase()}</div> <br>
                   <div style=''>
                       <div class='showroom-name'><p>${name}</p></div>  
                       ${contact} ${address_street} ${address_more} ${phone_1} ${phone_2} ${email} ${website}
                   </div>
                   <!-- <div class='showroom-territory'>$ {territory}</div> -->
                   <!-- <div class=''>territory_type $ {territory_type}</div> -->
               </div>`
    }

    function toTitleCase(str) {
        return str.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
    }

    /*function html_showroom_info(sh_data){
        // console.log("HTML For", sh_data);
        const id = sh_data['id'];
        const name = sh_data['name'];
        const territory_name_cls = "territory-name";
        let territory = not_null(sh_data['territory_display']) ? sh_data['territory_display'] : (not_null(sh_data['territory_states_US']) ? sh_data['territory_states_US'] : '');
        //console.log("html_showroom_info::territory", territory);    
        const territoryArr = territory.split(',');
        //console.log("html_showroom_info::territoryArr", territoryArr);
        territoryArr.forEach((terr, i) => {
            //console.log("html_showroom_info::terr", terr);
            const terrParts = terr.split("::");
            if(terrParts.length > 1){
                territoryArr[i] = "<span class='"+territory_name_cls+"'>"+ terrParts[0] + " </span>";
                if(terrParts[1] !== undefined){
                    territoryArr[i] += "<span> (" + terrParts[1] + ")</span>";
                } 
            }
        });
        //console.log("html_showroom_info::territoryArr", territoryArr);
        territory = territoryArr.join('<br />');
        //console.log("html_showroom_info::territory", territory);
        const contact = not_null(sh_data['contact']) ? sh_data['contact'] + "<br>" : '';
        const territory_type = not_null(sh_data['territory_type']) ? sh_data['territory_type']: '';
        const address_street = not_null(sh_data['address_street_1']) ? sh_data['address_street_1'] + (not_null(sh_data['address_street_2']) ? "<br>"+sh_data['address_street_2'] : "") + "<br>" : "";
        const address_more = not_null(sh_data['address_street_1']) ? sh_data['address_city'] + ', ' + sh_data['address_state'] + ' ' + sh_data['address_zipcode'] + "<br>" : "";
        const phone_1 = not_null(sh_data['phone_1']) ? "tel <a class='oz-color' href='tel:+1-"+sh_data['phone_1']+"'>"+sh_data['phone_1'].replaceAll('-', ' ')+"</a><br>" : '';
        const phone_2 = not_null(sh_data['phone_2']) ? "tel <a class='oz-color' href='tel:+1-"+sh_data['phone_2']+"'>"+sh_data['phone_2'].replaceAll('-', ' ')+"</a><br>" : '';
        const email = not_null(sh_data['email']) ? "email <a class='oz-color' href='mailto:"+sh_data['email']+"'>"+sh_data['email']+"</a><br>" : '';
        const website = not_null(sh_data['website']) ? "web <a class='oz-color' target='_blank' href='https://"+sh_data['website']+"'>"+sh_data['website']+"</a><br>" : '';
        const rep_type = (sh_data['rep_type'] !== undefined && sh_data['rep_type'] !== null ) ? sh_data['rep_type'] : '';
        
        return `<div id='${id}' class='showroom-block d-flex flex-column'>
                   <div class='showroom-rep-type'>${rep_type.toUpperCase()}</div> <br>
                   <div style=''>
                       <div class='showroom-name'><p>${name}</p></div>  
                       ${contact} ${address_street} ${address_more} ${phone_1} ${phone_2} ${email} ${website}
                   </div>
                   <!-- <div class='showroom-territory'>$ {territory}</div> -->
                   <!-- <div class=''>territory_type $ {territory_type}</div> -->
                   
               </div>`
    } */



    
</script>