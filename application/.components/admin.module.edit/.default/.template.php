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
            <input name="<?=$name?>" type="<?=$array['type']?>" value="<?=$arParam['value'][$name];?>">
        <?endif;?>
        <?
        // * table_name - Таблица
        ?>
        <?if($name === 'table_name'):?>
            <input name="<?=$name?>" type="<?=$array['type']?>" value="<?=$arParam['value']['ajaxFormTableTo']?>">
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
                    <div class="core__form__input <?=$arParam['input'][$name]['error']['type']?>">
                        <input name="<?=$name?>" class="core__form__input__control" value="<?=$arParam['value'][$name];?>">
                        <?if(!empty($arParam['input'][$name]['error']['text'])):?>
                            <div class="core__form__input__log"><?=$arParam['input'][$name]['error']['text']?></div>
                        <?endif;?>
                    </div>
                </div>
            </div>
        <?endif;?>
        <?
        // * cat - Категория
        ?>
        <?if($name === 'category_id'):?>
            <div class="admin__edit__row">
                <div class="admin__edit__name">
                    <span><?=$array['name']?></span>
                </div>
                <div class="admin__edit__input">
                    <div class="core__form__input <?=$arParam['input'][$name]['error']['type']?>">
                        <select name="<?=$name?>" class="core__form__select__control">
                            <?if(!sizeof($arParam['category'])):?>
                                <optgroup label="Категорий нет"></optgroup>
                            <?else:?>
                                <option value="0">Без категории</option>
                                <?foreach ($arParam['category'] as $item):?>
                                    <?
                                    $select = 'selected="selected"';
                                    if($item['id'] != $arParam['value']['category_id']) $select = null;
                                    ?>
                                    <option value="<?=$item['id']?>" <?=$select?>><?=$item['name']?></option>
                                <?endforeach;?>
                            <?endif;?>
                        </select>
                        <?if(!empty($arParam['input'][$name]['error']['text'])):?>
                            <div class="core__form__input__log"><?=$arParam['input'][$name]['error']['text']?></div>
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
                    <div class="core__form__input <?=$arParam['input'][$name]['error']['type']?>">
                        <input name="<?=$name?>" class="core__form__input__control" value="<?=$arParam['value'][$name]?>">
                        <?if(!empty($arParam['input'][$name]['error']['text'])):?>
                            <div class="core__form__input__log"><?=$arParam['input'][$name]['error']['text']?></div>
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
                <div class="core__form__text <?=$arParam['input'][$name]['error']['type']?>">
                    <textarea name="<?=$name?>" class="core__form__text__control"><?=$arParam['value'][$name]?></textarea>
                    <?if(!empty($arParam['input'][$name]['error']['text'])):?>
                        <div class="core__form__input__log"><?=$arParam['input'][$name]['error']['text']?></div>
                    <?endif;?>
                </div>
            </div>
        <?endif;?>
    <?endforeach;?>
    <a href="/admin/<?=$arParam['table']?>/" title="" class="core__btn core__btn_default"><span>Отменить</span></a>
    <?if($arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit'):?>
        <a href="/admin/<?=$arParam['table']?>/delete/<?=$arParam['value']['ajaxFormId']?>" title="" class="core__btn core__btn_danger"><span>Удалить</span></a>
    <?endif;?>
    <button class="core__btn">
        <span>
            <?if($arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit') echo 'Изменить'?>
            <?if($arParam['type'] == 'add' OR $arParam['type'] == 'category_add')  echo 'Добавить'?>
        </span>
    </button>
</div>
