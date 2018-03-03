<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 *
 */
?>
<?if($login != true):?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="core__form">
        <div class="core__form__input">
            <input type="text" name="email" value="" placeholder="Email" class="core__form__input__control">
        </div>
        <div class="core__form__input">
            <input type="password" name="password" value="" placeholder="Пароль" class="core__form__input__control">
        </div>
        <div class="core__form__log core__color_danger">
            <?
                if(!empty($error_text)){
                    echo $error_text.'<br><br>';
                }
            ?>
        </div>
        <button class="core__btn" name="push">Вход</button>
    </div>
</form>
<?else:?>
    <div class="">Вы успешно вошли в систему <?$this->app->user_get('name')?></div>
    <a href="/admin/" class="core__btn">Перейти в панель</a>
<?endif;?>
