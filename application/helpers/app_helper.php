<?

function drop($var){
    ?><pre><?
    print_r($var);
    ?></pre><?
}
function val($name){
    if(!empty($name)) echo $name;
}


function check_field($name = null , $value = null , $button = false){
    $warning = 'core__form__input_warning';
    $danger  = 'core__form__input_danger';
    $arResult = [
        'type' => '',
        'text' => ''
    ];
    if($button != 'push') return $arResult;
    if($name == 'name') {
        if(empty($value)){
            $arResult['type'] = $warning;
            $arResult['text'] = 'Вы не заполние поле';
        }
    }
    if($name == 'code') {
        if(!preg_match("/^[A-Z_a-z0-9]+$/",$value)){
            $arResult['type'] = $warning;
            $arResult['text'] = 'Вы ввели неправильные символы';
        }
        if(empty($value)){
            $arResult['type'] = $warning;
            $arResult['text'] = 'Вы не заполние поле';
        }
    }
    return $arResult;
}
// Проверка данных
function check_email($data){
    if (preg_match("/^[a-z0-9_\-\.]+@[a-z0-9_^\.]+\.[a-z1-9]{1,6}$/ui",$data))
        return true;
    else
        return false;
}
function check_login($data){
    if (preg_match("/^[a-z0-9]+$/",$data))
        return true;
    else
        return false;
}
function check_password($data){
    if (preg_match("/^[a-z0-9]+$/", $data) AND strlen($data) >= 6)
        return true;
    else
        return false;
}
function get_password($data){
    return $data;
}
function get_clean($data = null){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
function get_date($date,$type){
    $month[0] = '';
    $month[1] = 'января';
    $month[2] = "февраля";
    $month[3] = "марта";
    $month[4] = "апреля";
    $month[5] = "мая";
    $month[6] = "июня";
    $month[7] = "июля";
    $month[8] = "августа";
    $month[9] = "сентября";
    $month[10] = "октября";
    $month[11] = "ноября";
    $month[12] = "декабря";

    $date_number = mb_substr($date, 8, -9);
    $date_month =  (int) mb_substr($date, 5, -12);
    $date_year = mb_substr($date, 0, -15);
    $date_time = "в ".mb_substr($date, 11, -3);


    if ($date_number == date('d') AND
        $date_month  == date('m') AND
        $date_year   == date('Y'))
    {
        $date_number = "Сегодня";
        $date_month = 0;
        $date_year = '';
    }

    if (
        $date_number     == date('d') - 1 AND
        $date_month      == date('m') AND
        $date_year       == date('Y'))
    {
        $date_number = "Вчера";
        $date_month = 0;
        $date_year = '';
    }

    if($type == ''){
        $date = "".$date_number." ".$month[$date_month]." ".$date_year." ".$date_time;
        return $date;
    }
    if($type == 'day-month'){
        $date = "".ltrim($date_number, '0')." ".$month[$date_month];
        return $date;
    }
    if($type == 'day-month-year'){
        $date = "".ltrim($date_number, '0')." ".$month[$date_month]." ".$date_year;
        return $date;
    }
};

function get_url_code($value){
    $value = mb_strtolower($value);
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        "." => "_",   " " => "_",   "?"=>"_","/"=>"_","\\"=>"_",
        "*"=>"_",":"=>"_","*"=>"_","\""=>"_","<"=>"_",
        ">"=>"_","|"=>"_", "-" => '_'
    );

    return trim(strtr($value, $converter), "_");
}
//
function get_config_app(){
    $arConfig = array();

    $url = $_SERVER['DOCUMENT_ROOT'].'/local/.config/app.config.php';
    if(file_exists($url)){
        include ($url);
    }else{
        // Создать файл .config;
    }
    return $arConfig;
}
function get_template_path(){
    $arConfig = get_config_app();
    return '/local/templates/'.$arConfig['template']['name'].'/';
}
function get_component_file_url($component = null, $com_name = null , $template = null, $name = ''){
    $component_url         = $_SERVER['DOCUMENT_ROOT'].'/local/.components/';
    $component_url_default = $_SERVER['DOCUMENT_ROOT'].'/application/.components/';
    $conponent_name        = null;
    $name                  = '.'.$name.'.php';
    $name_tempale          = '.'.$template.'.php';

    // * Название компонента
    if(!empty($component)) {
        $component_url         .= $component.'/';
        $component_url_default .= $component.'/';
    }

     // * Подставляем правильное название
    if(!empty($com_name)){
        $conponent_name = $com_name.'/';
    }else{
        $conponent_name = '.default/';
    }
    
    // * Для шаблонов 
    // * 
    if(file_exists($component_url.$conponent_name.$name_tempale) AND !empty($template) AND $name == 'template'){
        return $component_url.$conponent_name.$name_tempale;
    
    // * Ищем файл в local c название
    }elseif(file_exists($component_url.$conponent_name.$name)){
        return $component_url.$conponent_name.$name;

    // * Ищем файл в app c название
    }elseif(file_exists($component_url_default.$conponent_name.$name)){
        return $component_url_default.$conponent_name.$name;

    // * Иначе подключаем стандартный
    }elseif(file_exists($component_url_default.'.default/'.$name)){
        return $component_url_default.'.default/'.$name;
    
    // * Иначе ничего не нашел
    }else{
        return false;
    }
}