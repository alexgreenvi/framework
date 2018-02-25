<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?foreach($arResult as $item):?>
    <div class="admin__table__row">
        <div class="admin__table__cell">
            <input class="cm-marker" id="module-entries-check-2" type="checkbox">
            <label for="module-entries-check-2"><span></span></label>
        </div>
        <div class="admin__table__cell">
            <div class="table__item__name"><span><?=$item['name']?></span></div>
            <div class="table__item__cat"><span>Без категории </span></div>
        </div>
        <div class="admin__table__cell">
            <span><?=$item['date']?></span>
        </div>
        <div class="admin__table__cell">
            <span><?=$item['id']?></span>
        </div>
    </div>
<?endforeach;?>
