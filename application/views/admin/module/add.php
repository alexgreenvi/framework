<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="container">
        <aside class="container-aside">
            <div class="aside">
                <div class="aside__menu">
                    <div class="aside__menu__title">
                        <span>Модули</span>
                    </div>
                    <ul class="aside__menu__list">
                        <li>
                            <a href="" title="">
                                <i class="core__icon core__icon_archive"></i>
                                Новости сайта
                            </a>
                        </li>
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
                <div class="admin__top">
                    <div class="admin__top__btn">
                        <a href="/" title="" class="core__btn core__btn_default"><span>Отменить</span></a>
                        <a href="/" title="" class="core__btn core__btn_danger"><span>Удалить</span></a>
                        <a href="/" title="" class="core__btn"><span>Добавить</span></a>
                    </div>
                    <div class="admin__top__title">
                        <h1>Новости сайта</h1>
                    </div>
                    <div class="admin__top__title__mini">
                        <h2>Материалы: 2</h2>
                    </div>
                    <div class="admin__top__text">
                        Адрес модуля - <a href="/" title="">http://alexgreenvi.ucoz.net/news/</a>
                    </div>
                </div>
                <?$this->app->ajax('news_edit','/ajax/form/', $arResult)?>
            </div>
        </div>
    </div>
</div>