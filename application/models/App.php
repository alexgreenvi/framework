<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class App extends CI_Model {
    function component($component = null, $name = null , $template = null , $arParam = array()){
        $url = $_SERVER['DOCUMENT_ROOT'].'/application/.components/';
        $url_name = null;
        $arResult = array();

        if(!empty($component)) $url .= $component.'/';
        if(!empty($name)){
            $url_name = $name.'/';
        }else{
            $url_name = '.default/';
        }


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
    function detail($TYPE, $CODE , $table = 'module_element') {
        if($TYPE == 'CODE'){
            $where = "code='".$CODE."'";
        }elseif ($TYPE == 'ID') {
            $where = "id ='".$CODE."'";
        }
        // * Выборка
        $arResult = $this->db->query("SELECT * FROM ".$table." WHERE ".$where)->row_array();

        if(!empty($arResult)){
            return $arResult;
        }else{
            return false;
        }
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
    function module_get_config($CODE){
        $arModule = array();
        $arModule['code'] = $CODE; // CODE модуля
        // * Выбираем нужный модуль
        $arModule = $this->db->query("SELECT * FROM module WHERE code = '".$arModule['code']."'")->row_array();
        // * Загружаем все параметры

        $url = $_SERVER['DOCUMENT_ROOT'].'/local/.config/module/'.$arModule['code'].'.config.php';
        if(file_exists($url)){
            // * Локальный
            include ($url);
        }
        $arModule['count'] = $this->db->from('module_element')->where('code',$arModule['code'])->count_all_results(); // Количество материалов в модуле

        return $arModule;
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

    // Templates
    function template_header($template = '.default'){
        $url = $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.$template.'/header.php';
        $url_default = $_SERVER['DOCUMENT_ROOT'].'/application/.templates/'.$template.'/header.php';

        if(file_exists($url)){
            include ($url);
        }elseif (file_exists($url_default)){
            include ($url_default);
        }else{
            echo 'Шаблон не найден';
        }
    }
    function template_footer($template = '.default'){
        $url = $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.$template.'/footer.php';
        $url_default = $_SERVER['DOCUMENT_ROOT'].'/application/.templates/'.$template.'/footer.php';

        if(file_exists($url)){
            include ($url);
        }elseif (file_exists($url_default)){
            include ($url_default);
        }else{
            echo 'Шаблон не найден';
        }
    }
    function template($template = '.default', $name = null , $views = '.default', $arParam = array()){
        $url = $_SERVER['DOCUMENT_ROOT'].'/application/.templates/'.$template.'/.blocks/';

        if(!empty($name)){
            $url .= $name.'/';
        }

        if(!empty($views)){
            $url .= $views.'.php';
        }else{
            $url .= '.default.php';
        }


        // * Загружаем
        if(file_exists($url)){
            include ($url);
        }else{
            echo $url;;
        }
    }

    // * Работа со структурой файлов
    // * Как движку правильно работать с файлами
    function page($CODE = 'index'){
        $url = $_SERVER['DOCUMENT_ROOT'].'/local/pages/';
        $file_name     = 'index';
        $folder        = $this->uri->segment_array();

        if(!empty($folder['2'])){
            $arResult = $this->app->detail($CODE);
        }
        if(!empty($arResult)){
            $file_name = 'detail';
            $url .=  $folder['1'].'/';
        }else{
            foreach ($folder as $key =>$item){
                $url .= $item.'/';
            }
        }

        if(file_exists($url.$file_name.'.php')){
            include ($url.$file_name.'.php');
        }else{
            show_404();
        }
    }
    function page_admin($arParam = array()){
        $url = $_SERVER['DOCUMENT_ROOT'].'/application/.';
        $arResult = array(); // Выборка для детальных страницы
        $file_name     = 'index';
        $folder        = $this->uri->segment_array();  // Массив с сигментами
        $folder_number = $this->uri->total_segments(); // Количество сигментов


        // * Заменяем путь если нужно
        foreach ($folder as $key =>$item){
            if(isset($folder[2]) AND $folder[2] == 'module'){
                // * module
                // * Третий сигмент убираем чтобы, можно было менять назавание модуля
                // * Пятый сигмент убираем чтобы, можно было редактировать элемент
                if( $key != 3 AND $key != 5) {
                    $url .= $item.'/';
                }
            } else {
                $url .= $item.'/';
            }
        }

        // *
        // * MODULE
        // *
        if(isset($folder[2]) AND $folder[2] == 'module'){
            // * Вырорка конфигураций модуля
            if(!empty($folder[3])){
                $arParam = $this->app->module_get_config($folder[3]);
            }
            // * Выборка материала для детальной странице
           if (!empty($folder[5])){
               $table = 'module_element';

               // * Выборка для категорий
               if($folder[4] == 'category_edit') {
                   $table = 'module_category';
               }

               $arResult = $this->app->detail('ID', $folder[5], $table);
           }
        }
        // *********

        // * Если есть выборка элемента, то идем в детальную страницу
        if(!empty($arResult)){
            $file_name = 'detail';
        }
        // * Загружаем нужную станицу
        if(file_exists($url.$file_name.'.php')){
            include ($url.$file_name.'.php');
        }else{
            echo '<div style="margin-top: 30px;text-align: center;">'.$url.$file_name.'.php'.'<br><br>Что-то пошло не так !!!!</div>';
        }
    }
}
