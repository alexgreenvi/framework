<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */
// Создаем подя (Ошибки)
$arInputIsset = ['name','type','description'];
foreach ($arParam['input'] as $name => $array) {
    foreach ($arInputIsset as $inputIsset) {
        if(!isset($arParam['input'][$name][$inputIsset])){
            $arParam['input'][$name][$inputIsset] = '';
        }
    }
}

// Выбираем все поля из тамблицы
$fields = $this->db->list_fields($_POST['ajaxFormTable']);
$ajaxFormButton = null;

// Какой статус отправки
if(isset($_POST['ajaxFormButton'])){
    $ajaxFormButton = $_POST['ajaxFormButton'];
}else{
    $ajaxFormButton = false;
}

// Быбираем сам материал
// * Если есть отправка то берем то что в отправленно, иначе то что уже было в базе
if($ajaxFormButton == false){
    $arParam['old'] = $this->db->query("SELECT * FROM ".$_POST['ajaxFormTable']." WHERE code = '".$_POST['ajaxFormCode']."'")->row_array();

    foreach ($fields as $field) {
        if(!empty($arParam['old'][$field]) AND !isset($arParam['val'][$field])) { // Если существует такое поле как в таблице
            $arParam['val'][$field] = $arParam['old'][$field];
        }else{
            $arParam['val'][$field] = null;
        }
    }
}
// Категория
$arParam['cat'] = $this->db->query("SELECT * FROM cat WHERE table_name = '".$_POST['ajaxFormTable']."'")->result_array();


$arBase = array();
// Добавляем все в массив для добавления
foreach ($fields as $field) {
    if(isset($arParam['val'][$field])) {
        $arBase[$field] = get_clean($arParam['val'][$field]);
    }else{
        $arParam['val'][$field] = '';
        $arBase[$field] = '';
    }
}

// * Проверка полей
// * Создаем все поля
$error = false;
foreach ($arParam['input'] as $name => $ar) {
    $arParam['error'][$name] = check_field($name, $arParam['val'][$name]);
    if (!empty($arParam['error'][$name]['text'])) {
        $error = true;
    }
}

// Проверяем code чтобы не было повторений
if(!empty($arParam['val']['code']) AND $arParam['type'] == 'add') {
    if($this->db->query("SELECT code FROM ".$arParam['table']." WHERE code='".$arParam['val']['code']."'")->row_array()) {
        $error = true;
        $arParam['error']['code']['type'] = 'core__form__input_warning';
        $arParam['error']['code']['text'] = 'Такой ключ уже используется';
    }
} elseif (!empty($arParam['val']['code']) AND $arParam['type'] == 'edit') {
    if($this->db->query("SELECT code FROM ".$arParam['table']." WHERE id !='".$arParam['val']['id']."' AND code='".$arParam['val']['code']."'")->row_array()) {
        $error = true;
        $arParam['error']['code']['type'] = 'core__form__input_warning';
        $arParam['error']['code']['text'] = 'Такой ключ уже используется';
    }
}
// * Описание

//if(isset())
//$arBase['date'] = date("Y-m-d H:i:s");

// Обновляем данные
if($ajaxFormButton == 'push' AND $error == false) {

    if($arParam['type'] == 'edit') {
        // Редактируем
        $this->db->where('id',$arBase['id'])->update($_POST['ajaxFormTable'],$arBase);
    } elseif ($arParam['type'] == 'add') {
        // Добавляем
        unset($arBase['id']);
        unset($arParam['val']);
        $this->db->insert($_POST['ajaxFormTable'],$arBase);
    }
}



