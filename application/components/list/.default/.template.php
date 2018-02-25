<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 *
 */
?>
<?foreach($arResult as $arItem):?>
    <div class="admin__table__row">
        <div class="admin__table__cell">
            <input class="cm-marker" id="module-entries-check-2" type="checkbox">
            <label for="module-entries-check-2"><span></span></label>
        </div>
        <div class="admin__table__cell">
            <div class="table__item__name"><span><?=$arItem['name']?></span></div>
            <div class="table__item__cat"><span>Без категории </span></div>
        </div>
        <div class="admin__table__cell">
            <span><?=$arItem['date']?></span>
        </div>
        <div class="admin__table__cell">
            <span><?=$arItem['id']?></span>
        </div>
    </div>
<?endforeach;?>

