<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class App extends CI_Model {
    function component($component , $name , $template , $arParam){
        if(!isset($arParam)) $arParam  = array();
        $arResult = array();


        $url = $_SERVER['DOCUMENT_ROOT'].'/application/.components/';


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

        // template
        if(empty($template)) $template = '.template';
        if(file_exists($url.$url_name.$template.'.php')) include ($url.$url_name.$template.'.php');

        // epilog
        if(file_exists($url.'.epilog.php')){
            include ($url.'.epilog.php');
        }
        elseif(file_exists($url.'.default/.epilog.php')){
            include ($url.'.default/.epilog.php');
        };
    }
    function detail($CODE) {
        // Выборка
        $arResult = $this->db->query("SELECT * FROM module_element WHERE id ='".$CODE."' OR code='".$CODE."'")->row_array();
        return $arResult;
    }
    function ajax($name , $url , $arParam){
        $data = '';
        // Перебираем все параменты передачи
        foreach ($arParam AS $key => $value) {
            if(!empty($value)){
                $data .= ' data-'.$key.'="'.$value.'"';
            }
            else {
                $data .= ' data-'.$key.'= "false"';
            }
        }

        echo '<div data-ajax-form="'.$name.'" data-ajax-form-url="'.$url.'"'.$data.'>';
        echo '</div>';
    }

    // MODULES
    function get_module_config($CODE){
        $arModule = array();
        $arModule['code'] = $CODE; // CODE модуля
        // Выбираем нужный модуль
        $arModule = $this->db->query("SELECT * FROM module WHERE code = '".$arModule['code']."'")->row_array();
        // Загружаем все параметры
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/module/'.$arModule['code'].'/.config.php'); // config
        return $arModule;
    }
    function get_admin_module_page($arParam){
        if($arParam['page']['detail'] == true){
            $arResult = array();
            $arResult = $this->app->detail($arParam['page']['id']);
        }
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/app/header.php'); // Header
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/module/module.php'); // module
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/app/footer.php'); // Footer
    }
}
