<?
    function drop($var){
        ?><pre><?
        print_r($var);
        ?></pre><?
    }
    function val($name){
        if(!empty($name)) echo $name;
    }


    function check_field($name = null , $value = null){
        $arResult = [
            'type' => '',
            'text' => ''
        ];
        if($name == 'name') {
            if(empty($value)){
                $arResult['type'] = 'core__form__input_warning';
                $arResult['text'] = 'Вы не заполние поле';
            }
        }
        if($name == 'code') {
            if(empty($value)){
                $arResult['type'] = 'core__form__input_warning';
                $arResult['text'] = 'Вы не заполние поле';
            }
            if(!preg_match("/^[A-Z_a-z0-9]+$/",$value)){
                $arResult['type'] = 'core__form__input_warning';
                $arResult['text'] = 'Вы ввели неправильные символы';
            }
        }
        if($name == 'description') {
            if(empty($value)){
                $arResult['type'] = 'core__form__input_warning';
                $arResult['text'] = 'Вы не заполние поле';
            }
        }
        return $arResult;
    }
    function get_clean($value = null){
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
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
    }