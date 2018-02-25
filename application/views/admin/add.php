<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="container">
        <aside class="container-aside">
            <div class="aside">
                <div class="aside__menu">
                    <ul class="aside__menu__list">
                        <li>
                            <a href="/<?=$this->uri->segment(1)?>/" title="Назад">
                                <i class="core__icon core__icon_arrow-large-left"></i>
                                Назад
                            </a>
                        </li>
                    </ul>
                    <div class="aside__menu__title">
                        <span><?=$title?></span>
                    </div>
                    <ul class="aside__menu__list">
                        <?foreach ($menu as $key => $item):?>
                            <?
                            $class = null;
                            if($this->uri->segment(3) == $item) $class = 'active';

                            $url = '/admin/';
                            $url .= $this->uri->segment(2);
                            if(!empty($item)) $url .= '/'.$item.'/'
                            ?>
                            <li class="<?=$class?>">
                                <a href="<?=$url?>" title="<?=$key?>"><?=$key?></a>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="container-main">
            <div class="admin">
                <div class="admin__top">
                    <div class="admin__top__btn">
                        <a href="/" title="" class="core__btn"><span>Добавить</span></a>
                    </div>
                    <div class="admin__top__title">
                        <h1><?=$title?></h1>
                    </div>
                    <div class="admin__top__title__mini">
                        <h2>Материалов: <?=$count?></h2>
                    </div>
                    <div class="admin__top__text">
                        Адрес модуля - <a href="<?=$link?>" title=""><?=$link?></a>
                    </div>
                </div>
                <?$this->app->ajax('news_add','/ajax/form/')?>
            </div>
        </div>
    </div>
</div>