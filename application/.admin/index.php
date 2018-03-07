<div class="container-fluid">
    <div class="container">
        <aside class="container-aside">
            <div class="aside">
                <div class="aside__menu">
                    <div class="aside__menu__title">
                        <span>Модули</span>
                        <div class="aside__menu__title__add">
                            <a href="#popup_module_add" data-fancybox="" class="core__icon core__icon_plus"></a>
                        </div>

<!--                        <div class="popup" id="popup_module_add">-->
<!--                            <div class="sh-form">-->
<!--                                <div class="sh-form__field">-->
<!--                                    <div class="sh-form__field__name">-->
<!--                                        <span>Название</span>-->
<!--                                    </div>-->
<!--                                    <div class="sh-input">-->
<!--                                        <input class="sh-input__control"/>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="sh-form__field">-->
<!--                                    <div class="sh-form__field__name">-->
<!--                                        <span>code</span>-->
<!--                                    </div>-->
<!--                                    <div class="sh-input">-->
<!--                                        <input class="sh-input__control"/>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="sh-form__field">-->
<!--                                    <button class="sh-btn">Добавить</button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                    <ul class="aside__menu__list">
                        <?
                        $arModuleList = $this->db->from('module')->get()->result_array();
                        ?>
                        <?foreach ($arModuleList as $arItem):?>
                            <li>
                                <a href="/admin/module/<?=$arItem['code']?>/" title="">
                                    <i class="core__icon core__icon_archive"></i>
                                    <span><?=$arItem['name']?></span>
                                </a>
                            </li>
                        <?endforeach;?>
                    </ul>
                    <div class="aside__menu__title">
                        <span>Расширения</span>
                    </div>
                    <ul class="aside__menu__list">
                        <li>
                            <a href="" title="">
                                <i class="core__icon core__icon_facebook-messenger"></i>
                                Почтовые формы
                            </a>
                        </li>
                    </ul>
                    <div class="aside__menu__title">
                        <span>Страницы</span>
                    </div>
                    <ul class="aside__menu__list">
                        <li>
                            <a href="" title="">
                                <i class="core__icon core__icon_new-window"></i>
                                Главная страница
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="container-main">
            <div class="admin">

            </div>
        </div>
    </div>
</div>