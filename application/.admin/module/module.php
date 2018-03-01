<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="container">
        <aside class="container-aside">
            <div class="aside">
                <div class="aside__menu">
                    <ul class="aside__menu__list">
                        <li>
                            <a href="/admin/" title="Назад">
                                <i class="core__icon core__icon_arrow-large-left"></i>
                                Назад
                            </a>
                        </li>
                    </ul>
                    <div class="aside__menu__title">
                        <span><?=$arParam['module']['name']?></span>
                    </div>
                    <ul class="aside__menu__list">
                        <?$menu = [
                                'Материалы' => '',
                                'Категории' => 'categories',
                                'Настройки' => 'config'
                        ]?>
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
                <?include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/module/.template/'.$arParam['page']['name'].'.php');?>
            </div>
        </div>
    </div>
</div>