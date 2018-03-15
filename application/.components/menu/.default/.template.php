<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 *
 */
?>
<a id="nav-toggle" href="#"><span></span></a>
<nav id="nav-menu">
    <ul>
        <?foreach($arResult as $key => $arItem):?>
            <li>
                <a title="<?=$arItem['name']?>" href="<?=$arItem['url']?>" class="<?=$arItem['active']?>"><?=$arItem['name']?></a>
                <?// * 2 Уровень?>
                <?if(isset($arItem['menu'])){?>
                    <ul>
                        <?foreach($arItem['menu'] as $key_2 => $arItem_2){?>
                            <li>
                                <a title="<?=$arItem_2['name']?>" href="<?=$arItem_2['url']?>" class="<?=$arItem_2['active']?>"><?=$arItem_2['name']?></a>
                            </li>
                        <?}?>
                    </ul>
                <?}?>
            </li>
        <?endforeach;?>
    </ul>
</nav>