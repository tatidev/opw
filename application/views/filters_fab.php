<style>
    .sticky-offset-filters {
        top: 165px;
    }
</style>

<div class='filter-wrapper bkgr-black w-100 sticky-top sticky-offset-filters'>
<!--<div class='filter-wrapper'>-->

    <div id='filter-list-wrap' class='row fixrow'>
        <div class='col-12 p-0'>
            SELECTED FILTERS: <span id='filter-list' class='d-inline-flex flex-wrap flex-row'></span>
        </div>
    </div>

    <div class='d-flex flex-wrap'>

        <input id="search_level" type="hidden" value="<?= $level ?>"/>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-sto'] ?> '>
            <select id='fl-sto' multiple='multiple' placeholder="Stock" class="search-box">
			    <?
				    foreach ($allStocks as $aux){
					    ?>
                        <option class="" value="<?=$aux['id']?>" name="<?=$aux['name']?>"><?=$aux['label']?></option>
					    <?
				    }
			    ?>
            </select>
        </div>
        
        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-specials'] ?> '>
            <select id='fl-specials' multiple='multiple' placeholder='Specials' class="search-box">
				<?
					foreach ($allSpecials as $aux) {
						?>
                        <option class="" value="<?= $aux['id'] ?>"
                                name='<?= $aux['name'] ?>' <?= ($special_selected == $aux['id'] ? "selected='selected'" : '') ?> > <?= $aux['name'] ?></option>
						<?
					}
				?>
            </select>
        </div>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-category'] ?> '>
            <input id='fl-category' name='fl-category' type='text' value='<?= $purpose ?>' disabled>
        </div>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-col'] ?> '>
            <select id='fl-col' multiple='multiple' placeholder='Collections' class="search-box">
				<?
					foreach ($allCollections as $aux) {
						?>
                        <option class="" value="<?= $aux['id'] ?>"
                                name='<?= $aux['name'] ?>' <?= ($collection_selected == $aux['id'] ? "selected='selected'" : '') ?> > <?= $aux['name'] ?></option>
						<?
					}
				?>
            </select>
        </div>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-wea'] ?> '>
            <select id='fl-wea' multiple='multiple' placeholder="Weaves" class="search-box">
				<?
					foreach ($allWeaves as $aux) {
						?>
                        <option class="" value="<?= $aux['id'] ?>"
                                name='<?= $aux['name'] ?>' <?= ($weave_selected == $aux['id'] ? "selected='selected'" : '') ?> > <?= $aux['name'] ?></option>
						<?
					}
				?>
            </select>
        </div>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-colorways'] ?> '>
            <select id='fl-colorways' multiple='multiple' placeholder="Colorways" class="search-box">
				<?
					foreach ($allColorways as $aux) {
						?>
                        <option class="" value="<?= $aux['id'] ?>"
                                name='<?= $aux['name'] ?>' <?= ($colorway_selected == $aux['id'] ? "selected='selected'" : '') ?> ><?= $aux['name'] ?></option>
						<?
					}
				?>
            </select>
        </div>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-pat'] ?> '>
            <select id='fl-pat' multiple='multiple' placeholder="Patterns" class="search-box">
				<?
					foreach ($allPatterns2 as $aux) {
						?>
                        <option class="" value="<?= $aux['id'] ?>"
                                name='<?= $aux['name'] ?>' <?= ($pattern2_selected == $aux['id'] ? "selected='selected'" : '') ?> ><?= $aux['name'] ?></option>
						<?
					}
				?>
            </select>
        </div>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-con'] ?> '>
            <select id='fl-con' multiple="multiple" placeholder="Contents" class="search-box">
				<?
					foreach ($allWebContents as $aux) {
						?>
                        <option class="" value="<?= $aux['id'] ?>"
                                name='<?= $aux['name'] ?>' <?= ($content_selected == $aux['id'] ? "selected='selected'" : '') ?> ><?= $aux['name'] ?></option>
						<?
					}
				?>
            </select>
        </div>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-fir'] ?> '>
            <select id='fl-fir' multiple='multiple' placeholder="Firecodes" class="search-box">
				<?
					foreach ($allFirecodes as $aux) {
						?>
                        <option class="" value="<?= $aux['id'] ?>"
                                name='<?= $aux['name'] ?>' <?= ($firecode_selected == $aux['id'] ? "selected='selected'" : '') ?>><?= $aux['name'] ?></option>
<!--                                name='--><?//= $aux['name'] ?><!--'>--><?//= $aux['name'] ?><!--</option>-->
						<?
					}
				?>
            </select>
        </div>

        <div class='filter-dropdown-container <?= $filterColClass ?> <?= $visibleDropdown['fl-abr'] ?> '>
            <select id='fl-abr' multiple='multiple' placeholder="Abrasion" class="search-box">
                <?
                    foreach ($allAbrasions as $aux){
                        ?>
                        <option class="" value="<?=$aux['id']?>" name="<?=$aux['name']?>"><?=$aux['label']?></option>
                        <?
                    }
                ?>
            </select>
        </div>

    </div>

</div>
<!-- End filter-wrapper -->