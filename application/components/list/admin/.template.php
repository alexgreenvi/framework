<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 *
 */
?>
<div class="admin__list">
    <div class="item">
        <div class="item__cell">
            <div class="item__cell__wrap">
                <input class="cm-marker" id="module-entries-check-2" type="checkbox">
                <label for="module-entries-check-2"><span></span></label>
            </div>
        </div>
        <?foreach ($arParam['table'] as $name => $ar){?>
            <div class="item__cell">
                <div class="item__cell__wrap">
                    <div class="item__name"><?=$ar['name']?></div>
                </div>
            </div>
        <?}?>
    </div>
    <?foreach($arResult as $arItem):?>
        <div class="item">
            <div class="item__cell">
                <div class="item__cell__wrap">
                    <input class="cm-marker" id="module-entries-check-2" type="checkbox">
                    <label for="module-entries-check-2"><span></span></label>
                </div>
            </div>
            <?foreach ($arParam['table'] as $name => $ar){?>
                <?if($name == 'name'):?>
                    <div class="item__cell">
                        <div class="item__cell__wrap">
                            <div class="item__name">
                                <?
                                    $link_cat = null;
                                    if($arParam['type'] == 'cat') {
                                       $link_cat = $arParam['type'].'/';
                                    }?>
                                <a href="/admin/<?=$this->uri->segment(2)?>/<?=$link_cat?><?=$arItem['code']?>" title="Подробнее">
                                    <?=$arItem['name']?>
                                </a>
                            </div>
                            <?if($ar['cat'] == true):?>
                                <div class="item__cat"><span>Без категории</span></div>
                            <?endif;?>
                        </div>
                    </div>
                <?endif;?>
                <?if($name == 'count'):?>
                    <div class="item__cell">
                        <div class="item__cell__wrap">
                            <span><?=$arItem['count']?></span>
                        </div>
                    </div>
                <?endif;?>
                <?if($name == 'date'):?>
                    <div class="item__cell">
                        <div class="item__cell__wrap">
                            <span><?=get_date($arItem['date'],'')?></span>
                        </div>
                    </div>
                <?endif;?>
                <?if($name == 'id'):?>
                    <div class="item__cell">
                        <div class="item__cell__wrap">
                            <span><?=$arItem['id']?></span>
                        </div>
                    </div>
                <?endif;?>
            <?}?>
        </div>
    <?endforeach;?>
</div>


