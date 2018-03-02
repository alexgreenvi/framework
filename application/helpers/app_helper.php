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
