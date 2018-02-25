<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class App extends CI_Model {
    function component($component , $name , $template , $arParam){
        if(!isset($arParam)) $arParam  = array();
        $arResult = array();


        $url = $_SERVER['DOCUMENT_ROOT'].'/application/components/';


        if(!empty($component)) $url .= $component.'/';
        if(!empty($name)) $url_name = $name.'/'; else $url_name = '.default/';


        // prolog
        if(file_exists($url.$url_name.'.prolog.php')){
            include ($url.$url_name.'.prolog.php');
        }
        elseif (file_exists($url.'.default/.prolog.php')){
            include ($url.'.default/.prolog.php');
        };

        // boot
        if(file_exists($url.$url_name.'.boot.php')){
            include ($url.$url_name.'.boot.php');
        }
        elseif (file_exists($url.'.default/.boot.php')){
            include ($url.'.default/.boot.php');
        };

        // epilog
        if(file_exists($url.'.epilog.php')){
            include ($url.'.epilog.php');
        }
        elseif(file_exists($url.'.default/.epilog.php')){
            include ($url.'.default/.epilog.php');
        };

        // template
        if(empty($template)) $template = '.template';

        if(file_exists($url.$url_name.$template.'.php')) include ($url.$url_name.$template.'.php');
    }
    function detail($table, $CODE) {
        // Выборка
        $arResult = $this->db->query("SELECT * FROM ".$table." WHERE code='".$CODE."'")->row_array();
        return $arResult;
    }
    function ajax($name , $url , $arParam){
        $data = '';
        foreach ($arParam AS $key => $value) {
            if(!empty($value)){
                $data .= ' data-'.$key.'="'.$value.'"';
            }
        }

        echo '<div data-ajax-form="'.$name.'" data-ajax-form-url="'.$url.'"'.$data.'>';
        echo '</div>';
    }
}
