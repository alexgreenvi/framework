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

        <!-- <li>
            <a title="О салоне" href="about-us-1.html">О салоне</a>
        </li>
        <li>
            <a title="Портфолио" href="portfolio-3col-artists-filters.html">Портфолио</a>
        </li>
        <li>
            <a title="Журнал" href="journal.html">Журнал</a>
            <ul>
                <li><a title="Блог" href="blog.html">Блог</a></li>
                <li><a title="События" href="events.html">События</a></li>
            </ul>
        </li>
        <li><a title="Faqs &amp; Disclaimers Page" href="faq.html">Faqs</a></li>
        <li><a title="Контакты" href="contacts.html">Контакты</a></li>
        <li><a title="Записаться" href="appointment.html"><i class="fa fa-thumb-tack"></i>Хочу тату!</a></li>
    </ul>
</nav> -->