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
    <div class="sh-form__field">
        <div class="sh-form__field__name">
            <span>Описание</span>
        </div>
        <div class="sh-textarea">
            <textarea name="description" class="sh-textarea__control"><?=$arParam['post']['description'];?></textarea>
        </div>
    </div>

    <a href="/admin/module/<?=$arParam['module']['code']?>/" title="" class="core__btn core__btn_default"><span>Отменить</span></a>
    <?if($arParam['type'] == 'category_edit'):?>
        <a href="/admin/module/<?=$arParam['module']['code']?>/delete/<?=$arParam['post']['ajaxFormModuleElementId']?>" title="" class="core__btn core__btn_danger"><span>Удалить</span></a>
    <?endif;?>
    <button class="core__btn" name="push">
        <span>
            <?if($arParam['type'] == 'category_edit') echo 'Изменить'?>
            <?if($arParam['type'] == 'category_add')  echo 'Добавить'?>
        </span>
    </button>
</div>
</form>