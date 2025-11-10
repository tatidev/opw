<?    // Libraries loading
      // Common libraries are set up on Core/MY_Controller
      // Then invidivual libraries are set up by each controller
      foreach($library_foot as $lib){
        switch($lib['type']){
          case 'css':
?>
            <link type='text/css' rel="stylesheet" href="<?=$lib['url']?>"  />
<?          break;
          case 'js':
?>
            <script type='text/javascript' src='<?=$lib['url']?>'></script>
<?          break;
        }
      }
?>
<style>
    .pre-footer.social-footer > a {
        margin: 0px 15px;
    }
    .pre-footer-item {
        font-size: 11px;
        /*font-weight: bold;*/
        color: white;
    }
</style>
    </div>
    <!-- Footer -->
    <div class="pre-footer social-footer d-flex flex-justify-center bkgr-black">
        <a class="<?=($isHomePage?"":"")?>" href="https://www.facebook.com/opuzendesign" target="_blank">
            <i class="fa fa-facebook oz-color" style="font-size: 25px;"></i>
        </a>
        <a class="<?=($isHomePage?"":"")?>" href="https://www.instagram.com/opuzendesign/" target="_blank">
            <i class="fa fa-instagram oz-color" style="font-size: 25px;"></i>
        </a>
        <a class="<?=($isHomePage?"":"")?>" href="https://www.pinterest.com/opuzendesign/" target="_blank">
            <i class="fa fa-pinterest-p oz-color" style="font-size: 25px;"></i>
        </a>
    </div>
    <div class="pre-footer d-flex justify-content-center bkgr-black py-3">
<!--        <div><a href="--><?php //=site_url("terms")?><!--"><span class="pre-footer-item">TERMS AND CONDITIONS</span></a></div>-->
<!--        <div><a href="--><?php //=site_url("faq")?><!--"><span class="pre-footer-item">FAQ</span></a></div>-->
        <div><a href="<?=$documents['terms']?>" target="_blank"><span class="pre-footer-item">TERMS AND CONDITIONS</span></a></div>
        <div><a href="<?=site_url("faq")?>"><span class="pre-footer-item">FAQ</span></a></div>
    </div>
    <div class="footer text-center bkgr-green-op">
      <p class='py-0 m-0'>
        &copy; <?=date('Y'); ?> OPUZEN ALL RIGHTS RESERVED
      </p>
    </div>

  </div>
  </body>
</html>