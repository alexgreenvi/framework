<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="container">
        <aside class="container-aside">
            <div class="aside">
                <div class="aside__menu">
                    <ul class="aside__menu__list">
                        <li>
                            <a href="/admin/<?=$this->uri->segment(2)?>/" title="Назад">
                                <i class="core__icon core__icon_arrow-large-left"></i>
                                Назад
                            </a>
                        </li>
                    </ul>
                    <div class="aside__menu__title">
                        <span><?=$arParam['title']?></span>
                    </div>
                    <ul class="aside__menu__list">
                        <?foreach ($arParam['menu'] as $key => $item):?>
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
                    <div class="admin__top__title">
                        <h1><?=$arParam['title']?></h1>
                    </div>
                    <div class="admin__top__text">
                        <?if($arParam['type'] == 'edit'):?>
                            Адрес материала - <a href="<?=$arParam['count']?>" title=""><?=$arParam['link']?><?=$arResult['code']?>/</a>
                        <?elseif ($arParam['type'] == 'add' || $arParam['type'] == 'index'):?>
                            Количесво материалов : <?=$arParam['count']?>
                        <?elseif($arParam['type'] == 'cat'):?>
                            <h2>Управление категориями</h2>
                        <?endif;?>
                    </div>
                </div>
                <?if($arParam['type'] == 'index'):?>
                    <?$this->app->component('list' , 'admin' , '', [
                        'from' => 'news',
                        'type' => '',
                        'table' => [
                            'name' => [
                                'name'=> 'Название',
                                'cat' => true
                            ],
                            'date'=> [
                                'name'=> 'Дата и время',
                            ],
                            'id'=> [
                                'name'=> 'ID',
                            ]
                        ]
                    ])?>
                <?elseif ($arParam['type'] == 'edit' || $arParam['type'] == 'add'):?>
                    <?$this->app->ajax('module_edit', '/ajax/module/'.$arParam['type'].'/', [
                                'ajax-form-table' => $arParam['table'],
                                'ajax-form-Code' => $arResult['code']
                        ])?>
                <?elseif ($arParam['type'] == 'cat'):?>
                    <?$this->app->component('list' , 'admin' , '', [
                        'from' => 'cat',
                        'type' => 'cat',
                        'table' => [
                            'name' => [
                                'name'=> 'Название',
                                'cat' => false
                            ],
                            'count'=> [
                                'name'=> 'Материалы',
                            ],
                            'id'=> [
                                'name'=> 'ID',
                            ]
                        ],
                    ])?>
                <?elseif ($arParam['type'] == 'cat_edit' || $arParam['type'] == 'cat_add'):?>
                    <?$this->app->ajax('module_edit', '/ajax/module/'.$arParam['type'].'/', [
                        'ajax-form-table' => $arParam['table'],
                        'ajax-form-Code' => $arResult['code'],
                        'ajax-form-table-to' => $this->uri->segment(2)
                    ])?>
                <?endif;?>
            </div>
        </div>
    </div>
</div>