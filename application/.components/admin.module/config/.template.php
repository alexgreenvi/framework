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
    <input name="id" type="hidden" value="<?=$arParam['module']['id'];?>">
    <div class="sh-form__field">
        <div class="sh-form__field__name">
            <span>Название</span>
        </div>
        <div class="sh-input">
            <input name="name" class="sh-input__control" value="<?=$arParam['module']['name'];?>">
            <?if(!empty($arParam['name_error']['text'])):?>
                <div class="sh-input__log">
                    <?=$arParam['name_error']['text']?>
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
                    <input name="code" class="sh-input__control" value="<?=$arParam['module']['code'];?>">
                    <?if(!empty($arParam['code_error']['text'])):?>
                        <div class="sh-input__log">
                            <?=$arParam['code_error']['text']?>
                        </div>
                        <div class="sh-input__icon">
                            <i class="core__icon core__icon_channel-info"></i>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="sh-form__field">
        <div class="sh-form__field__name">
            <span>Описание</span>
        </div>
        <div class="sh-textarea">
            <textarea name="description" class="sh-textarea__control"><?=$arParam['module']['description'];?></textarea>
        </div>
    </div>
    <div class="sh-form">
        <div class="sh-form__field">
            <div class="sh-form__field__name">
                <span>Поля</span>
            </div>
            <?foreach ($arField as $key => $value):?>
            <div class="sh-form__field__row">
                <div class="sh-form__field__row__left">
                    <div class="sh-checkbox">
                        <?
                            if($arParam['module']['field'][$key]['status'] == "true") {
                                $checked = 'checked';
                            }else{
                                $checked = '';
                            }
                        ?>
                        <input class="sh-checkbox__control" id="checkbox-field-<?=$key?>" type="checkbox" <?=$checked?> name="field-<?=$key?>-checkbox"/>
                        <label class="sh-checkbox__label" for="checkbox-field-<?=$key?>"></label>
                    </div>
                </div>
                <div class="sh-form__field__row__right">
                    <div class="sh-input sh-input_field">
                        <input name="field-<?=$key?>" class="sh-input__control" value="<?=$arParam['module']['field'][$key]['name']?>" placeholder="<?=$value['name']?>">
                    </div>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>

        <a href="/admin/<?=$arParam['module']['code']?>/" title="" class="core__btn core__btn_default"><span>Отменить</span></a>
    <?if($arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit'):?>
        <a href="<?=$arParam['module']['code']?>delete/<?=$arParam['module']['ajaxFormModuleElementId']?>" title="" class="core__btn core__btn_danger"><span>Удалить</span></a>
    <?endif;?>
    <button class="core__btn" name="push">
        <span>Изменить</span>
    </button>
</div>
</form>