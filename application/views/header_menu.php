<style>
  .menu-item-active {
    background: #bfac02!important;
    color: white!important;
  }

</style>

<nav role='navigation' class='hidden-sm-down'>
<!-- Menu -->
          <ul id="main-menu" class="sm sm-blue sm-mytheme d-flex justify-content-between bkgr-black">

            <?  
              foreach($menu as $mitem){
            ?>
                  <li>
                    <a name='<?=str_replace_for_view($mitem['name'])?>' class='menu-item <?=( isset($activeMenu) && $activeMenu == $mitem['name'] ? 'menu-item-active' : '')?>' href="<?=$mitem['url']?>" ><?=$mitem['name']?></a>
            <?
                  if( !empty($mitem['sub']) ){
            ?>
                    <ul>
            <?
                      foreach ($mitem['sub'] as $subitem) {
                      if( !isset($subitem['mobileOnly']) || $subitem['mobileOnly'] == false ){
            ?>
                      <li><a class='menu-item-sub' href="<?=$subitem['url'];?>" <?=(isset($subitem['target'])?"target='_blank'":"")?> ><?=$subitem['name'];?></a>
                      <? if( !empty($subitem['sub-sub']) ) { ?>
                        <ul>
                          <? foreach($subitem['sub-sub'] as $subsubitem) {?> 
                            <li>
                              <a class='menu-item-sub redir' href="#"data-id='<?=$subsubitem['id']?>' data-category='<?=$subsubitem['category']?>' data-name='<?=url_title( str_replace('/', ' ', $subsubitem['name']), '-', true)?>' data-contr='<?=$subsubitem['contr']?>'>
                                <span class='hidden-md-up'>- </span><?=$subsubitem['name'];?>
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
          
          <script>
            $(function() {
              $('#main-menu').smartmenus({
                showFunction: null,
                showDuration: 0,
                keepHighlighted: true,
                markCurrentTree: true,
                keepInViewport: true,
                subIndicators: true,
                subIndicatorsPos: 'append',
                subIndicatorsText: '  '
              });
            });
            
          </script>
</nav>