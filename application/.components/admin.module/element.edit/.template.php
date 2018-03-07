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
<div class="sh-admin__form">
    <input name="id" type="hidden" value="<?=$arParam['post']['id'];?>">
    <input name="module_id" type="hidden" value="<?=$arParam['post']['ajaxFormModuleId']?>">
    <div class="sh-form__field">
        <div class="sh-form__field__name">
            <span><?=$arParam['module']['field']['name']['name']?></span>
        </div>
        <div class="sh-input sh-input_big">
            <input name="name" class="sh-input__control" value="<?=$arParam['post']['name']?>">
            <?if(!empty($arParam['module']['field']['name']['error']['text'])):?>
                <div class="sh-input__log">
                    <?=$arParam['module']['field']['name']['error']['text']?>
                </div>
                <div class="sh-input__icon">
                    <i class="core__icon core__icon_channel-info"></i>
                </div>
            <?endif;?>
        </div>
    </div>
    <div class="sh-form__field">
        <div class="sh-form__field__row">
            <div class="sh-form__field__row__left">
                <div class="sh-form__field__name">
                    <span>Код</span>
                </div>
            </div>
            <div class="sh-form__field__row__right">
                <div class="sh-input sh-input_code">
                    <input name="code" class="sh-input__control" value="<?=$arParam['post']['code'];?>">
                    <?if(!empty($arParam['module']['field']['code']['error']['text'])):?>
                        <div class="sh-input__log">
                            <?=$arParam['module']['field']['code']['error']['text']?>
                        </div>
                        <div class="sh-input__icon">
                            <i class="core__icon core__icon_channel-info"></i>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>

    <?foreach ($arParam['module']['field'] as $name => $inf):?>
        <?if($inf['status'] == 'true'){?>
            <?if($name === 'module_category_id'):?>
                <div class="sh-form__field">
                    <div class="sh-form__field__name">
                        <span><?=$inf['name']?></span>
                    </div>
                    <div class="sh-select">
                        <select name="<?=$name?>" class="sh-select__control">
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
                    </div>
                </div>
            <?endif;?>
            <?if($name === 'description' OR $name == 'description_preview'):?>
                <div class="sh-form__field">
                    <div class="sh-form__field__name">
                        <span><?=$inf['name']?></span>
                    </div>
                    <div class="sh-textarea">
                        <textarea name="<?=$name?>" class="sh-textarea__control"><?=$arParam['post'][$name]?></textarea>
                        <?if(!empty($inf['error']['text'])):?>
                            <div class="sh-input__log">
                                <?=$inf['error']['text']?>
                            </div>
                        <?endif;?>
                    </div>
                </div>
            <?endif;?>
            <?if($name === 'img_preview' OR $name === 'img_detail'):?>
                <div class="sh-form__field">
                    <div class="sh-form__field__row">
                        <div class="sh-form__field__row__left">
                            <div class="sh-file">
                                <?
                                $file_url = '';
                                $file_status = '';

                                if(isset($arParam['old'][$name]) AND !empty($arParam['old'][$name]) AND !file_exists($_SERVER['DOCUMENT_ROOT'].$arParam['post'][$name])) {
                                    $file_url = '';
                                    $file_status = 'load';
                                } else {
                                    if(isset($arParam['old'][$name])){
                                        $file_url = $arParam['old'][$name];
                                    }
                                    $file_status = '';
                                }
                                ?>
                                <label style="background-image: url('<?=$file_url?>');">
                                    <?if($file_status == 'load'):?>
                                        <i class="sh-file__icon core__icon core__icon_your-files animated infinite pulse"></i>
                                    <?else:?>
                                        <i class="sh-file__icon core__icon core__icon_arrow-circle-o-up"></i>
                                    <?endif;?>
                                    <input type="file" name="<?=$name?>" value="<?=$arParam['post'][$name]?>">
                                </label>
                            </div>
                        </div>
                        <div class="sh-form__field__row__right">
                            <div class="sh-form__field__name">
                                <span><?=$inf['name']?></span>
                            </div>
                            <div class="sh-form__field__description">
                                <?if($file_status == 'load'):?>
                                    <span class="sh-color sh-color_info">Идет загрузка файта</span>
                                <?else:?>
                                    <span>Форматы GIF, JPEG, PNG.</span>
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            <?endif;?>
            <?for ($i = 1; $i <= 10; $i++){?>
                <?if($name === 'addition_img_'.$i):?>
                    <div class="sh-form__field">
                        <div class="sh-form__field__row">
                            <div class="sh-form__field__row__left">
                                <div class="sh-file">
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
                                            <i class="sh-file__icon core__icon core__icon_your-files animated infinite pulse"></i>
                                        <?else:?>
                                            <i class="sh-file__icon core__icon core__icon_arrow-circle-o-up"></i>
                                        <?endif;?>
                                        <input type="file" name="<?=$name?>" value="<?=$arParam['post'][$name]?>">
                                    </label>
                                </div>
                            </div>
                            <div class="sh-form__field__row__right">
                                <div class="sh-form__field__name">
                                    <span><?=$inf['name']?></span>
                                </div>
                                <div class="sh-form__field__description">
                                    <?if($file_status == 'load'):?>
                                        <span class="sh-color sh-color_info">Идет загрузка файта</span>
                                    <?else:?>
                                        <span>Форматы GIF, JPEG, PNG.</span>
                                    <?endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?endif;?>
                <?if($name === 'addition_'.$i):?>
                    <div class="sh-form__field">
                        <div class="sh-form__field__row sh-form__field__row_addition">
                            <div class="sh-form__field__row__left">
                                <div class="sh-form__field__name">
                                    <span><?=$inf['name']?></span>
                                </div>
                            </div>
                            <div class="sh-form__field__row__right">
                                <div class="sh-input">
                                    <input name="<?=$name?>" class="sh-input__control" value="<?=$arParam['post'][$name]?>">
                                </div>
                            </div>
                        </div>
                    </div>
                <?endif;?>
            <?}?>
        <?}?>
    <?endforeach;?>

    <a href="/admin/module/<?=$arParam['module']['code']?>/" title="" class="core__btn core__btn_default"><span>Отменить</span></a>
    <?if($arParam['type'] == 'element_edit'):?>
        <a href="/admin/module/<?=$arParam['module']['code']?>/delete/<?=$arParam['post']['ajaxFormModuleElementId']?>" title="" class="core__btn core__btn_danger"><span>Удалить</span></a>
    <?endif;?>
    <button class="core__btn" name="push">
        <span>
            <?if($arParam['type'] == 'element_edit') echo 'Изменить'?>
            <?if($arParam['type'] == 'element_add')  echo 'Добавить'?>
        </span>
    </button>
</div>
</form>