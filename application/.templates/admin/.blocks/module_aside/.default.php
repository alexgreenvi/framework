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
                <span><?=$arParam['name']?></span>
            </div>
            <ul class="aside__menu__list">
                <?$menu = [
                    'Материалы' => '',
                    'Категории' => 'category',
                    'Настройки' => 'config'
                ]?>
                <?foreach ($menu as $key => $item):?>
                    <?
                        $class = null;
                        if($this->uri->segment(4) == $item) $class = 'active';

                        $url = '/admin/module/';
                        $url .= $this->uri->segment(3);
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