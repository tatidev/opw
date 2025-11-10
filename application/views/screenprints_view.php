
<style>
  .product-name {
    margin: 10px 0;
    font-size: 15px!important;
    font-weight: 600!important;
    text-transform: uppercase;
  }
  
  .product-desc {
    margin: 5px 0 20px 0;
    font-size: 13px!important;
    line-height: 14px;
  }
  
  #imgbig {
    width: 600px;
  }
  
  @media (max-width: 736px) {
    .listflex {
      height: 1200px!important;
    }
    #product-name {
      font-size: 21px!important;
    }
  }
</style>

<div class='row fixrow py-4'>

<?
  $firstElem = $printsAll[0];
  $firstElemHref = image_src_path('screenprints').$firstElem['id'].'.jpg';
?>

    <div class='col-12 col-md-4'>
      <div class='specbox'>
        <div class='row fixrow'>
          <p id='product-name' class="lead product-name text-justify w-100">
            <?=$firstElem['name']?>
          </p>
          <p id='product-desc' class="product-desc ">
            <?=$firstElem['comment']?>
          </p>
        </div>

        <dl id='spec-container' class='row fixrow' style='font-size: 13px;'>
          <dt class='col-6 text-uppercase p-0'>Pattern Width:</dt>
          <dd class='col-6 p-0'>
            <?=$firstElem['width']?> "</dd>
          <dt class='col-6 text-uppercase p-0'>Pattern Height:</dt>
          <dd class='col-6 p-0'>
            <?=$firstElem['height']?> "</dd>
          <dt class='col-6 text-uppercase p-0'>Vertical Repeat:</dt>
          <dd class='col-6 p-0'>
            <?=$firstElem['vrepeat']?> "</dd>
          <dt class='col-6 text-uppercase p-0'>Horizontal Repeat:</dt>
          <dd class='col-6 p-0'>
            <?=$firstElem['hrepeat']?> "</dd>
        </dl>

      </div>
      <div class='col-12 product-desc p-0' style='margin-top:50px;'>
        Click on the image to view full repeat
      </div>
    </div>

    <div class='col-12 col-md-8'>
      <img id='imgbig' src='<?=$firstElemHref?>' data-id='<?=$firstElem['id']?>' class='img-fluid'>
      <div class=' row fixrow d-flex flex-row justify-content-between hidden-sm-up pt-4' style='background: white;color:#bfac02;'>
        <i id='' class="fa fa-chevron-left prev" style='font-size: 30px;cursor:pointer;' aria-hidden="true" ></i>
        <p id='product-name2' class='hidden-sm-up' style='color:black;font-weight:bold;'><?=$firstElem['name']?></p>
        <i id='' class="fa fa-chevron-right next" style='font-size: 30px;cursor:pointer;' aria-hidden="true" ></i>
      </div>
    </div>
    <div class='col-12'>
      <div class='row fixrow d-flex flex-row justify-content-between hidden-sm-down pt-4' style='background: white;color:#bfac02;'>
        <i id='' class="fa fa-chevron-left prev" style='font-size: 30px;cursor:pointer;' aria-hidden="true" ></i>
        <i id='' class="fa fa-chevron-right next" style='font-size: 30px;cursor:pointer;' aria-hidden="true" ></i>
      </div>
    </div>


</div>

<style>
  .listflex {
    height: 460px;
  }
  
  .listname {
    color: #fff;
    font-size: 13px;
  }
  
  .listname:hover {
    cursor: pointer;
    color: #bfac02;
  }
  
  .listname.listname-active {
    color: #bfac02;
  }
</style>

<div class='listflex row fixrow d-flex flex-column pt-4 pb-3 px-2' style='background: black;'>
  <?
  foreach($printsAll as $p){
    $href = image_src_path('screenprints').$p['id'].'.jpg';
?>
    <div class='w-25'>
      <p class='listname' data-id='<?=$p['id']?>' data-href='<?=$href?>'>
        <?=$p['name']?>
      </p>
    </div>
    <?
  }
?>
</div>

<script>
  var thisController = '<?=site_url('screenprints/get_print')?>';
  $(document).ready(function(){
    $('.listname').first().addClass('listname-active');
  });
  
  $(document).on('click', '.listname', function() {
    var i = $(this).attr('data-id');
    var href = $(this).attr('data-href');
    $('.listname-active').removeClass('listname-active');
    $(this).addClass('listname-active');
    updateFrontView(i, href);
  });
  
  $('.next').on('click', function(){
    var active = $('.listname.listname-active');
    active.parent().next().children().click();
  })
  
  $('.prev').on('click', function(){
    var active = $('.listname.listname-active');
    active.parent().prev().children().click();
  })

  function updateFrontView(i, href) {
    
    $('#imgbig').attr('src', href).attr('data-id', i);
    
    $.ajax({
      type: 'POST',
      url: thisController,
      dataType: 'json',
      data: {
        'member_id': i
      },
      beforeSend: function() {
        window.stop();
      },
      success: function(data) {
        //console.log(data);
        processFrontViewReturnedData(data.print[0]);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
  }

  function processFrontViewReturnedData(d) {
    $('#product-name').html(d.name);
    $('#product-name2').html(d.name);
    $('#product-desc').html(d.comment);
    $('#spec-container').html('');
    if (d.width !== '') {
      addSpecDataToFrontView('Pattern Width', d.width);
    };
    if (d.height !== '') {
      addSpecDataToFrontView('Pattern Height', d.height);
    };
    if (d.vrepeat !== '') {
      addSpecDataToFrontView('Vertical Repeat', d.vrepeat);
    };
    if (d.hrepeat !== '') {
      addSpecDataToFrontView('Horizontal Repeat', d.hrepeat);
    };
  }

  function addSpecDataToFrontView(text, data) {
    var dt = "<dt class='col-6 text-uppercase p-0'>" + text + ":</dt>";
    var dd = "<dd class='col-6 p-0'>" + data + " \"</dd>";
    $('#spec-container').append(dt).append(dd);
  }
</script>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

  <!-- Background of PhotoSwipe. 
         It's a separate element as animating opacity is faster than rgba(). -->
  <div class="pswp__bg"></div>

  <!-- Slides wrapper with overflow:hidden. -->
  <div class="pswp__scroll-wrap">

    <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>

    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
    <div class="pswp__ui pswp__ui--hidden">

      <div class="pswp__top-bar">

        <!--  Controls are self-explanatory. Order can be changed. -->

        <div class="pswp__counter"></div>

        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

        <!--<button class="pswp__button pswp__button--share" title="Share"></button>-->

        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

        <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
        <!-- element will get class pswp__preloader--active when preloader is running -->
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>

      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>

    </div>

  </div>

</div>

<script>
  $(document).on('click', '#imgbig', function(){
    var i = $(this).attr('data-id');
    updateModalInfo(i);
  })

  function updateModalInfo(i) {
    $.ajax({
      type: 'POST',
      url: '<?=site_url('screenprints/get_print_detail')?>',
      dataType: 'json',
      data: {
        'member_id': i
      },
      beforeSend: function() {
        show_loader();
        window.stop();
      },
      success: function(data) {
        //console.log(data);
        //processPrintDetail(data);
        openPhotoSwipe(data.imgs);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    }).done(function(){
      hide_loader();
    });
    
    $('.modal').modal('show');
  }
  
  function openPhotoSwipe(images, idSelected = 0) {
    var pswpElement = document.querySelectorAll('.pswp')[0];
    var items = [];
    var counter = 0;
    images.forEach(function(element) {
      /*if (idSelected === element.id) {
        indexSelected = counter;
      }*/
      counter++;
      var aux = {};
      aux.src = element.src;
      aux.w = element.w;
      aux.h = element.h; // Must get the height of the image
      items.push(aux);
    });
    // define options (if needed)
    var options = {
      index: idSelected
    };

    // Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
  }
  
/*
  function processPrintDetail(d) {
    $('#modal-img-container').html('');
    $.each( d.imgs, function(key, value){
      addImgToModal( value );
    });
    
    $('#modal-spec-container').html('');
    if (d.print[0].width !== '') {
      addSpecDataToModal('Pattern Width', d.width);
    }
    if (d.print[0].height !== '') {
      addSpecDataToModal('Pattern Height', d.height);
    }
    if (d.print[0].vrepeat !== '') {
      addSpecDataToModal('Vertical Repeat', d.vrepeat);
    }
    if (d.print[0].hrepeat !== '') {
      addSpecDataToModal('Horizontal Repeat', d.hrepeat);
    }
  }

  function addSpecDataToModal(text, data) {
    var dt = "<dt class='col-6 text-uppercase p-0'>" + text + ":</dt>";
    var dd = "<dd class='col-6 p-0'>" + data + " \"</dd>";
    $('#modal-spec-container').append(dt).append(dd);
  }
  
  function addImgToModal(src) {
    var new_img = "<img class='img-fluid' src='"+src+"'>";
    $('#modal-img-container').append(new_img);
  }
  */
  
</script>