function loading(){
  $('.products-container').addClass('loading');
}

function no_loading(){
  $('.products-container').removeClass('loading');
}

$(document).ready(function(){
  
  var thisFilterer = new filter(); // filter() declared at the bottom
  
  if(typeof thisController !== 'undefined'){
    console.log('thisController: ' + thisController);
  }

  if(typeof thisPage !== 'undefined' && thisPage !== 'product_list_slayman'){
    console.log('thisPage: ' + thisPage);
    console.log("calling jQuery.filters::update_list() ");
    update_list();
  }

  initiate_dropdowns('select.search-box')

  $('select.search-box').on('change', function(){
    update_list();
    //$(this).parent().removeClass('open'); // Close dropdown
  });

  function update_list(){
    $.ajax({
      type: 'POST',
      url: thisController, /* var thisController = '<?=base_url("search/get_filtered_search")?>'; */
      dataType: 'json',
      data: {
        'level': $("input#search_level").val(),
        'specials': $('#fl-specials').val(),
        'category': $('#fl-category').val(),
        'collectionIds': $('#fl-col').val(),
        'weaveIds': $('#fl-wea').val(),
        'abrasionIds': $('#fl-abr').val(),
        'stockIds': $('#fl-sto').val(),
        'firecodeIds': $('#fl-fir').val(),
        'contentIds': $('#fl-con').val(),
        'pattern2Ids': $('#fl-pat').val(),
        'colorwaysIds': $('#fl-colorways').val()
      },
      beforeSend: function(){
        loading();
        window.stop();
      },
      success: function(data){
        thisFilterer.update();
        processReturnedData(data);
        // updateActiveMenu();
        $("img").unveil(); // Lazy load the new images
        no_loading();
      },
      error: function( jqXHR, textStatus, errorThrown ){
        console.log(errorThrown);
      }
    });
  }
  
  function updateActiveMenu(){
    return;
    var s = [$('#fl-specials').val(), $('#fl-category').val()];
    //console.log(s);
    // $('.menu-item-active').removeClass('menu-item-active');
    
    if( $.inArray('new', s) !== -1 && $.inArray('30under', s) !== -1 ) {
      $('.menu-item-active').removeClass('menu-item-active');
      $("a.menu-item[name='hospitality']").addClass('menu-item-active');
    } else if ( $.inArray('new', s) !== -1 ) {
      $('.menu-item-active').removeClass('menu-item-active');
      $("a.menu-item[name='newarrivals']").addClass('menu-item-active');
    } else if ( $.inArray('30under', s) !== -1 ) {
      $('.menu-item-active').removeClass('menu-item-active');
      $("a.menu-item[name='hospitality']").addClass('menu-item-active');
    } else if ( $.inArray('sc_grounds', s) !== -1 ) {
      $('.menu-item-active').removeClass('menu-item-active');
      $("a.menu-item[name='screenprints']").addClass('menu-item-active');
    } else if ( $.inArray('digital_grounds', s) !== -1 ) {
      $('.menu-item-active').removeClass('menu-item-active');
      $("a.menu-item[name='digital']").addClass('menu-item-active');
    } else {
      // $("a.menu-item[name='fabrics']").addClass('menu-item-active');
    }
    
  }

  function processReturnedData(data){
    clean_items();
    if(data.length > 0){
      const search_level = $("input#search_level").val();
      const category = $('#fl-category').val();
      // console.log(search_level);
      // console.log(data);
      $('.products-container-no-results').addClass('hide');
      if(search_level == 'It') {
        for(var i = 0; i < data.length; i++){
          add_item( data[i], '.products-container' );
        }
      }
      else if(category == "digital_grounds"){
        for(var i = 0; i < data.length; i++){
          add_item( data[i], '.products-container' );
        }
      }
      else if(search_level == 'Pr'){
        for(var i = 0; i < data.length; i++){
          add_product(data[i], '.products-container' );
        }
      }
    } else {
      $('.products-container-no-results').removeClass('hide');
    }
  }

  function clean_items(){
    $('.products-container').html('');
  }

    function add_product(data, destination){
      let name = data.name;
      let cant_items = data.cant_items;
      let img = data.img;
      let is_new = data.is_new != null;

      name = name.length > 30 ? name.substring(0, 29)+'..' : name ;
      let isDigital = img.includes('data-category=\"digital_grounds\"');
      let aux = "";
      if(isDigital){
        aux = `
        <div class='product-wrap mr-2 my-1' style='float:left; position:relative;'>
            ${img}
            <span class="${(is_new ? "":"hide")}">
                <img src="${data.is_new}" style="position:absolute;right:0;margin:10px;width:40px;height:auto;">
            </span>
            <div class='text-preview'>
                <div class='pull-left'>
                    ${name}
                </div>
                <div class='pull-right'>
                    ${cant_items}
                </div>
            </div>
        </div>
        `;
      }
      else {
        aux = `
        <div class='product-wrap mr-2 my-1' style='float:left; position:relative;'>
            ${img}
            <span class="${(is_new ? "":"hide")}">
                <img src="${data.is_new}" style="position:absolute;right:0;margin:10px;width:40px;height:auto;">
            </span>
            <div class='text-preview'>
                <div class='pull-left'>
                    ${name}
                </div>
                <div class='pull-right'>
                    ${cant_items}
                </div>
            </div>
        </div>
        `;
      }
      $(destination).append(aux);
    }

    function add_item(data, destination){
      let name = data.product_name;
      let yards = '';
      if('code' in data && data.code.length > 0) {
        name = [data.code, data.product_name].join("<br>");
        if(data.yardsAvailable){
          yards = `<br><span class='closeout-color'><b>Available ${Math.floor(data.yardsAvailable)} yds</b></span>`;
        }
      } else {
        if('yardsAvailable' in data && data.yardsAvailable){
          yards = `<br><span class='closeout-color'><b>Available ${Math.floor(data.yardsAvailable)} yds</b></span>`;
        }
      }

      let data_category, data_item_id, data_code, data_name, data_color, data_pic_hd, style, cls, img_cls, onclick, extra_attrs;

      if($('#fl-category').val() == "digital_grounds"){
        data_category = "digital_grounds";
        data_item_id = data.id;
        data_code = "";
        data_name = data.name.split("/")[0].trim();
        data_color = data.name.split("/")[1].trim();
        data_pic_hd = "";
        style = "float:left; position:relative;";
        cls = "";
        img_cls = "image-preview";
        onclick = "";
        extra_attrs = " data-id='"+data.id+"' ";
      } else {
        data_category = "fabrics_items";
        data_item_id = data.item_id;
        data_code = data.code;
        data_name = data.product_name;
        data_color = data.color;
        data_pic_hd = data.pic_hd_url;
        style = "";
        cls = "flex-item";
        img_cls = "";
        onclick = 'onclick="on_figure_img_click(this)"';
        extra_attrs = "";
      }

      var aux = `<div class='${cls}' style='${style}'>
                  <figure>
                      <img data-src='${data.pic_big_url}'
                           class='mythumb img-fluid mx-auto ${img_cls}'
                           data-item-id='${data_item_id}'
                           data-category='${data_category}'
                          data-code="${data_code}" 
                          data-name="${data_name}" 
                          data-color="${data_color}" 
                          data-hd="${data_pic_hd}" 
                          data-url-title="${data.url_title}" 
                          ${onclick}
                          ${extra_attrs}
                           >
                      <figcaption class='text-preview-item'>
                          ${data_name}
                          <br>
                          ${data_color}
                          ${yards}
                      </figcaption>
                  </figure>
              </div>
              `;
      $(destination).append(aux);
    }


  //
  // FILTERING VIEW 
  //   (OBJECT)
  //
  function filter(){
    // Local variables
    this.filterViewWrapper = $('#filter-list-wrap')
    this.filterViewContainer = $('#filter-list');
    this.counter;
    
    // Check current selections and update my list and view
    this.update = function(){
      var me = this;
      var name, id, filter_assoc, f;
      this.emptyView();
      for(f = 0; f < $('select.search-box').length; f++){
        var current_filter = $('select.search-box')[f];
        filter_assoc = $(current_filter).attr('id');
        $(current_filter).find('option:selected').each( function(){
          id = $(this).attr('value');
          name = $(this).attr('name');
          if(filter_assoc != 'fl-specials'){
            me.add_filter_view(id, name, filter_assoc);
          }
        });
      }
      if(this.counter > 0){
        this.filterViewWrapper.removeClass('hide');
      } else {
        this.filterViewWrapper.addClass('hide');
      }
    };
    // Empty view, get ready to update
    this.emptyView = function(){
      this.filterViewContainer.html(''); // Empty list
      this.counter = 0;
    };
    // Add filter to the view
    this.add_filter_view = function(id, name, filter_assoc){
      var aux = "<p class='ozBadge text-center px-2 py-1 mr-1' data-id='"+id+"' data-filter-assoc='"+filter_assoc+"'><a href='#' class='close close-filter' data-dismiss='badge' aria-label='close'>&times;</a>"+name+"</p>";
      $('#filter-list').append(aux);
      this.counter++;
    };
  }
  // By clicking the X on the filter, deselects the option assoc
  $(document).on('click', '.close.close-filter', function(){
    var filter_assoc = $(this).parent().attr('data-filter-assoc');
    var member_id = $(this).parent().attr('data-id');
    $('#'+filter_assoc).multiselect('deselect', member_id);
    update_list();
  });
  
});