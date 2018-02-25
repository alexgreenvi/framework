<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 *
 */
?>
<div class="admin__edit">
    <?foreach ($arParam['input'] as $name => $array):?>
        <?
        // * id - Уникальный индекс
        ?>
        <?if($name === 'id'):?>
            <input name="<?=$name?>" type="<?=$array['type']?>" value="<?=$arParam['val'][$name];?>">
        <?endif;?>
        <?
        // * table_name - Таблица
        ?>
        <?if($name === 'table_name'):?>
            <input name="<?=$name?>" type="<?=$array['type']?>" value="<?=$arParam['val']['ajaxFormTableTo']?>">
        <?endif;?>
        <?
        // * code - Уникальный код, для обращения
        ?>
        <?if($name === 'code'):?>
            <div class="admin__edit__row">
                <div class="admin__edit__name">
                    <span><?=$array['name']?></span>
                </div>
                <div class="admin__edit__input">
                    <div class="core__form__input <?=$arParam['error'][$name]['type']?>">
                        <input name="<?=$name?>" class="core__form__input__control" value="<?=$arParam['val'][$name];?>">
                        <?if(!empty($arParam['error'][$name]['text'])):?>
                            <div class="core__form__input__log"><?=$arParam['error'][$name]['text']?></div>
                        <?endif;?>
                    </div>
                </div>
            </div>
        <?endif;?>
        <?
        // * cat - Категория
        ?>
        <?if($name === 'cat_id'):?>
            <div class="admin__edit__row">
                <div class="admin__edit__name">
                    <span><?=$array['name']?></span>
                </div>
                <div class="admin__edit__input">
                    <div class="core__form__input <?=$arParam['error'][$name]['type']?>">
                        <select name="<?=$name?>" class="core__form__select__control">
                            <?if(!sizeof($arParam['cat'])):?>
                                <optgroup label="Категорий нет"></optgroup>
                            <?else:?>
                                <option value="0">Без категории</option>
                                <?foreach ($arParam['cat'] as $item):?>
                                    <?
                                    $select = 'selected="selected"';
                                    if($item['id'] != $arParam['val']['cat_id']) $select = null;
                                    ?>
                                    <option value="<?=$item['id']?>" <?=$select?>><?=$item['name']?></option>
                                <?endforeach;?>
                            <?endif;?>
                        </select>
                        <?if(!empty($arParam['error'][$name]['text'])):?>
                            <div class="core__form__input__log"><?=$arParam['error'][$name]['text']?></div>
                        <?endif;?>
                    </div>
                </div>
            </div>
        <?endif;?>
        <?
        // * name - Название
        ?>
        <?if($name === 'name'):?>
            <div class="admin__edit__row">
                <div class="admin__edit__name">
                    <span><?=$array['name']?></span>
                </div>
                <div class="admin__edit__input">
                    <div class="core__form__input <?=$arParam['error'][$name]['type']?>">
                        <input name="<?=$name?>" class="core__form__input__control" value="<?=$arParam['val'][$name]?>">
                        <?if(!empty($arParam['error'][$name]['text'])):?>
                            <div class="core__form__input__log"><?=$arParam['error'][$name]['text']?></div>
                        <?endif;?>
                    </div>
                </div>
            </div>
        <?endif;?>
        <?
        // * description - Детальная описание
        ?>
        <?if($name === 'description'):?>
            <div class="admin__edit__row">
                <div class="admin__edit__name">
                    <span><?=$array['name']?></span>
                </div>
                <div class="core__form__text <?=$arParam['error'][$name]['type']?>">
                    <textarea name="<?=$name?>" class="core__form__text__control"><?=$arParam['val'][$name]?></textarea>
                    <?if(!empty($arParam['error'][$name]['text'])):?>
                        <div class="core__form__input__log"><?=$arParam['error'][$name]['text']?></div>
                    <?endif;?>
                </div>
            </div>
        <?endif;?>
    <?endforeach;?>
    <a href="/admin/<?=$arParam['table']?>/" title="" class="core__btn core__btn_default"><span>Отменить</span></a>
    <?if($arParam['type'] == 'edit'):?>
        <a href="/admin/<?=$arParam['table']?>/delete/<?=$arParam['code']?>" title="" class="core__btn core__btn_danger"><span>Удалить</span></a>
    <?endif;?>
    <button class="core__btn">
        <span>
            <?if($arParam['type'] == 'edit') echo 'Изменить'?>
            <?if($arParam['type'] == 'add')  echo 'Добавить'?>
        </span>
    </button>
</div>
