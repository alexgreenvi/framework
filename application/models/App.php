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


        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/local/.modules/'.$arModule['code'].'/.config.php')){
            // Локальный
            include ($_SERVER['DOCUMENT_ROOT'].'/local/.modules/'.$arModule['code'].'/.config.php');
        }
        elseif (file_exists($_SERVER['DOCUMENT_ROOT'].'/application/.admin/module/'.$arModule['code'].'/.config.php')){
            // Стандартный
            include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/module/'.$arModule['code'].'/.config.php');
        };

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
    // config
    function config_get(){}
    function config_save($module = false, $array){
    }
    function module_get_field() {
        // Получаем все поля
        $arParam = $this->db->list_fields('module_element');
        foreach ($arParam as $key => $name) {
            $arParam[$name]['status'] = '';

            switch ($name) {
                case 'module_category_id':
                    $arParam[$name]['name'] = 'Категория';
                    break;
                case 'code':
                    $arParam[$name]['name'] = 'Код';
                    break;
                case 'name':
                    $arParam[$name]['name'] = 'Название';
                    break;
                case 'img_preview':
                    $arParam[$name]['name'] = 'Превью картинка';
                    break;
                case 'description_preview':
                    $arParam[$name]['name'] = 'Превью описание';
                    break;
                case 'img_detail':
                    $arParam[$name]['name'] = 'Детальная картинка';
                    break;
                case 'description':
                    $arParam[$name]['name'] = 'Детальное описание';
                    break;
                case 'date':
                    $arParam[$name]['name'] = 'Дата';
                    break;
                case 'user_id':
                    $arParam[$name]['name'] = 'Пользователь';
                    break;
                // Дополнительные поля
                case 'addition_1':
                    $arParam[$name]['name'] = 'Дополнительное поле 1';
                    break;
                case 'addition_2':
                    $arParam[$name]['name'] = 'Дополнительное поле 2';
                    break;
                case 'addition_3':
                    $arParam[$name]['name'] = 'Дополнительное поле 3';
                    break;
                case 'addition_4':
                    $arParam[$name]['name'] = 'Дополнительное поле 4';
                    break;
                case 'addition_5':
                    $arParam[$name]['name'] = 'Дополнительное поле 5';
                    break;
                case 'addition_6':
                    $arParam[$name]['name'] = 'Дополнительное поле 6';
                    break;
                case 'addition_7':
                    $arParam[$name]['name'] = 'Дополнительное поле 7';
                    break;
                case 'addition_8':
                    $arParam[$name]['name'] = 'Дополнительное поле 8';
                    break;
                case 'addition_9':
                    $arParam[$name]['name'] = 'Дополнительное поле 9';
                    break;
                case 'addition_10':
                    $arParam[$name]['name'] = 'Дополнительное поле 10';
                    break;
                case 'addition_img_1':
                    $arParam[$name]['name'] = 'Дополнительная картинка 1';
                    break;
                case 'addition_img_2':
                    $arParam[$name]['name'] = 'Дополнительная картинка 2';
                    break;
                case 'addition_img_3':
                    $arParam[$name]['name'] = 'Дополнительная картинка 3';
                    break;
                case 'addition_img_4':
                    $arParam[$name]['name'] = 'Дополнительная картинка 4';
                    break;
                case 'addition_img_5':
                    $arParam[$name]['name'] = 'Дополнительная картинка 5';
                    break;
                case 'addition_img_6':
                    $arParam[$name]['name'] = 'Дополнительная картинка 6';
                    break;
                case 'addition_img_7':
                    $arParam[$name]['name'] = 'Дополнительная картинка 7';
                    break;
                case 'addition_img_8':
                    $arParam[$name]['name'] = 'Дополнительная картинка 8';
                    break;
                case 'addition_img_9':
                    $arParam[$name]['name'] = 'Дополнительная картинка 9';
                    break;
                case 'addition_img_10':
                    $arParam[$name]['name'] = 'Дополнительная картинка 10';
                    break;
                default;
                    $arParam[$name]['name'] = '???';
                break;
            }

            $arParam[$name]['description'] = '';
            unset($arParam[$key]);

            unset($arParam['id']);
            unset($arParam['module_id']);

        }
        return $arParam;
    }

    // USER
    function user_login($email,$password) {
        $arUser = $this->db->query("SELECT * FROM user WHERE email='".$email."' AND password = '".$password."'")->row_array();
        $data = array();
        foreach ($arUser as $key => $value){
            $data['user'][$key] = $value;
        }
        $this->session->set_userdata($data);
    }
    function user_check($group = null){
        if ($this->session->userdata('user')){
            if($group = 'admin') {
                if($this->session->userdata['user']['group_id'] == 5){
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }
        } else {
            return false;
        }
    }
    function user_get($data = null){
        if(!empty($data)){
            return $this->session->userdata['user'][$data];
        }else{
            return $this->session->userdata('user');
        }

    }
    function user_exit() {
        $this->session->unset_userdata('user');
    }
}
