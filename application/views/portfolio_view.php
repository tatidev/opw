<style>
  
  .image-preview-166 {
    width: 166px;
    height: 188px;
    border: 1px solid #dcdae0;
    cursor: pointer;
    margin: 7px;
  }
  
  @media (max-width: 736px){
    .image-preview-166 {
      max-width: 179px!important;
      height:auto!important;
    }
  }
  
</style>

<div id='portfolio' class='products-container'>

<?
    foreach($imagesCollection as $img){
?>
    <div class='m-1' style='float:left; '>
<?
        $cimg = array('src'=>image_src_path('portfolio_thumb').$img['id'].'.jpg', 'alt'=>$img['alt'], 'class'=>'img-fluid image-preview-166', 'data-id'=>$img['id']);
        $img = img($cimg);        
        echo $img;
?>
    </div>
<?
    }
?>
      <div style='clear:both;'></div>
</div>

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
  function openPhotoSwipe(images, idSelected = 0) {
    var pswpElement = document.querySelectorAll('.pswp')[0];
    var items = [];
    var counter = 0;
    images.forEach(function(element) {
      if (idSelected === element.id) {
        indexSelected = counter;
      }
      counter++;
      var aux = {};
      aux.src = element.src;
      aux.w = element.w;
      aux.h = element.h; // Must get the height of the image
      items.push(aux);
    });
    // define options (if needed)
    var options = {
      index: indexSelected
    };

    // Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
  }

  var imagesCollection = <?=json_encode($imagesCollection)?>; // json_encoded
  $('.image-preview-166').on('click', function() {
    var idSelected = $(this).attr('data-id');
    openPhotoSwipe(imagesCollection, idSelected);
    /*$.ajax({
        type:'POST',
        url:'<?//=base_url("portfolio/get_images_ajax")?>',
        dataType: 'json',
        data:{},
        success: function(data){
          openPhotoSwipe(data, idSelected);
        },
        error: function(a,b,c){
          console.log(a+b+c);
        }
    });*/
  })
</script>