<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 *
 */
?>
<form action="" method="post" enctype="multipart/form-data">
<div class="admin__edit">
    <input name="id" type="hidden" value="<?=$arParam['post']['id'];?>">
    <input name="module_id" type="hidden" value="<?=$arParam['post']['ajaxFormModuleId']?>">
    <div class="admin__edit__row">
        <div class="admin__edit__name">
            <span><?=$arParam['module']['field']['code']['name']?></span>
        </div>
        <div class="admin__edit__input">
            <div class="core__form__input">
                <input name="code" class="core__form__input__control" value="<?=$arParam['post']['code'];?>">
                <?if(!empty($arParam['module']['field']['code']['error']['text'])):?>
                    <div class="core__form__input__log"><?=$arParam['module']['field']['code']['error']['text']?></div>
                    <div class="core__form__input__log__icon">
                        <i class="core__icon core__icon_channel-info"></i>
                    </div>
                <?endif;?>
            </div>
        </div>
    </div>
    <?foreach ($arParam['module']['field'] as $name => $inf):?>
        <?
        // * cat - Категория
        ?>
        <?if($name === 'module_category_id'):?>
            <div class="admin__edit__row">
                <div class="admin__edit__name">
                    <span><?=$inf['name']?></span>
                </div>
                <div class="admin__edit__input">
                    <div class="core__form__input <?=$inf['error']['type']?>">
                        <select name="<?=$name?>" class="core__form__select__control">
                            <?if(!sizeof($arParam['module_category'])):?>
                                <optgroup label="Категорий нет"></optgroup>
                            <?else:?>
                                <option value="0">Без категории</option>
                                <?foreach ($arParam['module_category'] as $item):?>
                                    <?
                                    $select = 'selected="selected"';
                                    if($item['id'] != $arParam['post']['module_category_id']) $select = null;
                                    ?>
                                    <option value="<?=$item['id']?>" <?=$select?>><?=$item['name']?></option>
                                <?endforeach;?>
                            <?endif;?>
                        </select>
                        <?if(!empty($inf['error']['text'])):?>
                            <div class="core__form__input__log"><?=$inf['error']['text']?></div>
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
                    <span><?=$inf['name']?></span>
                </div>
                <div class="admin__edit__input">
                    <div class="core__form__input core__form__input_big">
                        <input name="<?=$name?>" class="core__form__input__control" value="<?=$arParam['post'][$name]?>">
                        <?if(!empty($inf['error']['text'])):?>
                            <div class="core__form__input__log"><?=$inf['error']['text']?></div>
                            <div class="core__form__input__log__icon">
                                <i class="core__icon core__icon_channel-info"></i>
                            </div>
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
                    <span><?=$inf['name']?></span>
                </div>
                <div class="core__form__text <?=$inf['error']['type']?>">
                    <textarea name="<?=$name?>" class="core__form__text__control"><?=$arParam['post'][$name]?></textarea>
                    <?if(!empty($inf['error']['text'])):?>
                        <div class="core__form__input__log"><?=$inf['error']['text']?></div>
                    <?endif;?>
                </div>
            </div>
        <?endif;?>
        <?
        // * img_preview - Название
        ?>
        <?if($name === 'img_preview' OR $name === 'img_detail'):?>
            <div class="admin__edit__row admin__edit__row_img">
                <div class="admin__edit__row__left">
                    <div class="core__form__file">
                        <?
                            if(!empty($arParam['old'][$name]) AND !file_exists($_SERVER['DOCUMENT_ROOT'].$arParam['post'][$name])){
                                $file_url = '';
                                $file_status = 'load';
                            }else{
                                $file_url = $arParam['old'][$name];
                                $file_status = '';
                            }
                        ?>
                        <label style="background-image: url('<?=$file_url?>');">
                            <?if($file_status == 'load'):?>
                                <i class="core__form__file__icon core__icon core__icon_your-files"></i>
                                <span class="core__form__file__text">Идет загрузка файла</span>
                            <?else:?>
                                <i class="core__form__file__icon core__icon core__icon_arrow-circle-o-up"></i>
                                <span class="core__form__file__text"><?=$inf['name']?></span>
                            <?endif;?>
                            <input type="file" name="<?=$name?>" value="<?=$arParam['post'][$name]?>">
                        </label>
                    </div>
                </div>
                <div class="admin__edit__row__right">
                    <div class="admin__edit__name">
                        <span><?=$inf['name']?></span>
                    </div>
                    <div class="admin__edit__description">
                    <span>
                        Форматы GIF, JPEG, PNG.<br>
                        Каждой картинке соответствует код $IMAGE1$, $IMAGE2$, $IMAGE3$ и т.д. Для выравнивания используйте $IMAGE1-left$
                    </span>
                    </div>
                </div>
            </div>
        <?endif;?>
        <?
        // Дополнительные поля
        // * img_preview - Название
        ?>
        <?for ($i = 1; $i < 10; $i++){?>
            <?if($name === 'addition_img_'.$i):?>
                <div class="admin__edit__row admin__edit__row_img">
                    <div class="col-6">
                        <div class="core__form__file">
                            <label style="background-image: url('<?=$arParam['post'][$name]?>');">
                                <i class="core__form__file__icon core__icon core__icon_arrow-circle-o-up"></i>
                                <span class="core__form__file__text"><?=$inf['name']?></span>
                                <input type="file" name="<?=$name?>" value="<?=$arParam['post'][$name]?>">
                            </label>
                        </div>
                    </div>
                </div>
            <?endif;?>
        <?}?>
    <?endforeach;?>
        <a href="<?=$arParam['link']?>" title="" class="core__btn core__btn_default"><span>Отменить</span></a>
    <?if($arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit'):?>
        <a href="<?=$arParam['link']?>delete/<?=$arParam['post']['ajaxFormModuleElementId']?>" title="" class="core__btn core__btn_danger"><span>Удалить</span></a>
    <?endif;?>
    <button class="core__btn" name="push">
        <span>
            <?if($arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit') echo 'Изменить'?>
            <?if($arParam['type'] == 'add' OR $arParam['type'] == 'category_add')  echo 'Добавить'?>
        </span>
    </button>
</div>
</form>