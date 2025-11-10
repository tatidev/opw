<?=(isset($terms)?$terms:'')?>

<style>
  .breadcrumb {
    padding-left: 14px;
      background:inherit;
      margin-bottom: 0;
  }
  .breadcrumb-item {
    font-size: 13px;
    color: white;
    float: none;
  }
   .sticky-offset-breadcrumb {
       top: 125px;
   }
</style>

<?php
    if(isset($btnBack)){
        echo $btnBack;
    }
?>

<?
if(isset($preTitle)){
    ?>

    <div class="row mt-3">
        <div class="col text-center sections-subtitles-h2" style="color:white;">
            <?=$preTitle?>
        </div>
    </div>
    <?
}
?>

<?
  if(count($navigation) > 0){
      $padding_top = "45px;";
      if(isset($preTitle)){
            $padding_top = "8px;";
      }
      $breadcrumb_style="style='padding-top:$padding_top;'";
?>
  <nav class='breadcrumb sticky-top sticky-offset-breadcrumb py-2 px-0 bkgr-black w-100 ' <?=$breadcrumb_style;?>>
<!--  <nav class='breadcrumb py-2 px-0'>-->
    <?
      $breadcrumbs = count($navigation); $lastCls = '';
      for($i=0; $i<$breadcrumbs;$i++){
        $t = $navigation[$i];
        //if($i==$breadcrumbs-1) $lastCls = 'h4';
        echo "<span class='$lastCls breadcrumb-item align-middle'>".strtoupper($t)."</span>";
      }
?>
  </nav>
<?
}
?>