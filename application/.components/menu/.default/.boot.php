<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */
$arResult = array();
$url      = $_SERVER['DOCUMENT_ROOT'].'/local/pages/';
$url_name = '.arMenu.'.$arParam['name'].'.php';

if(file_exists($url.$url_name)){
    include ($url.$url_name);
    $arResult = $arMenu;

    $i = 1;

    foreach($arResult as $key => $arItem){

        $page = $this->uri->segment_array();  // Массив с сигментами

        $arResult[$i]['name'] = $key;
        $arResult[$i]['url']  = trim($arItem, '/');
        $arResult[$i]['active']  = null;


        // * 2 Уровень
        // * Проверяем есть ли папки с файлами
        $url_name = $arResult[$i]['url'].'/.arMenu.'.$arParam['name'].'.php';

        if(file_exists($url.$url_name) AND $arResult[$i]['url'] !== ''){
            include ($url.$url_name);

            $arResult[$i]['menu'] = $arMenu;

            $i2 = 1 ;
            foreach($arResult[$i]['menu'] as $key2 => $arItem2){
                $arResult[$i]['menu'][$i2]['name'] = $key2;
                $arResult[$i]['menu'][$i2]['url']  = trim($arItem2, '/');
                $arResult[$i]['menu'][$i2]['active']  = null;
                
                // * Активный или нет

                if(isset($page['3']) AND $page['3'] == $arResult[$i]['menu'][$i2]['url']) {
                    $arResult[$i]['menu'][$i2]['active'] = 'active';}
                elseif(!isset($page['3']) AND isset($page['2']) AND $page['2'] == $arResult[$i]['menu'][$i2]['url']) {
                    $arResult[$i]['menu'][$i2]['active'] = 'active';}
                

                if(!empty($arResult[$i]['menu'][$i2]['url'])){
                    $arResult[$i]['menu'][$i2]['url'] = '/'.$arResult[$i]['url'].'/'.$arResult[$i]['menu'][$i2]['url'].'/';
                }else{
                    $arResult[$i]['menu'][$i2]['url'] = '/'.$arResult[$i]['url'].'/';
                }
               
                unset($arResult[$i]['menu'][$key2]);
                $i2++;
            }
        }

        // * Активный или нет

        if(!isset($page['2']) AND isset($page['1']) AND $page['1'] == $arResult[$i]['url']) {
            $arResult[$i]['active'] = 'active';}
        elseif(!isset($page['1']) AND $arResult[$i]['url'] == ''){
            $arResult[$i]['active'] = 'active';
        }
        
        // * Если есть добавочный класс
        if(isset($arResult[$i]['class'])) {
            // * В работе
            echo '';
        }

        if(!empty($arResult[$i]['url'])){
            $arResult[$i]['url'] = '/'.$arResult[$i]['url'].'/';
        }else{
            $arResult[$i]['url'] = '/';
        }
        
        unset($arResult[$key]);
        $i++;
    }
}else{
    echo $url;
    echo '<br><p style="text-align: center; color: #5d5f63;">Меню не найдено</p>';
}
