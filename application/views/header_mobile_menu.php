<style>
  .dl-menu {
    box-shadow: 0px 33px 70px 10px black;
  }
</style>       

<div id="dl-menu" class="dl-menuwrapper hidden-md-up">
          <button class="dl-trigger hide">Open Menu</button>
          
          <ul class="dl-menu">
            <?  
              foreach($menu as $mitem){
            ?>
                  <li>
                    <a class='' href="<?=$mitem['url']?>" ><?=$mitem['name']?></a>
            <?
                  if( !empty($mitem['sub']) ){
            ?>
                    <ul class='dl-submenu'>
            <?
                      foreach ($mitem['sub'] as $subitem) {
                      if( !isset($subitem['desktopOnly']) || $subitem['desktopOnly'] == false ){
            ?>
                      <li><a class='' href="<?=$subitem['url'];?>" ><?=$subitem['name'];?></a>
                      <? if( !empty($subitem['sub-sub']) ) { ?>
                        <ul class='dl-submenu'>
                          <? foreach($subitem['sub-sub'] as $subsubitem) {?> 
                            <li>
                              <a class=' redir' href="#"data-id='<?=$subsubitem['id']?>' data-category='<?=$subsubitem['category']?>' data-name='<?=url_title( str_replace('/', ' ', $subsubitem['name']), '-', true)?>' data-contr='<?=$subsubitem['contr']?>'>
                                <?=$subsubitem['name'];?>
                              </a>
                            </li>
                          <? } ?>
                        </ul>
                      </li>
            <?
                        }
                      }
                      }
                      ?> </ul> <?

                }
            ?>
                  </li>        
            <?
              }
            ?>  
          </ul>
          
          
        </div><!-- /dl-menuwrapper -->


            <script>
              $('.dl-trigger-copy').on('click', function(){
                $('.dl-trigger').click();
              });
              $( '#dl-menu' ).dlmenu({
                //animationClasses : { classin : 'animation-class-name', classout : 'animation-class-name' }
              });
            </script>