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
    $arParam['input'][$name]['error'] = '';
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
if($ajaxFormButton == false && $_POST['ajaxForm'] == 'edit' OR $_POST['ajaxForm'] == 'category_edit'){
    $arParam['old'] = $this->db->query("SELECT * FROM ".$_POST['ajaxFormTable']." WHERE id = '".$_POST['ajaxFormId']."'")->row_array();

    foreach ($fields as $field) {
        if(!empty($arParam['old'][$field]) AND !isset($arParam['value'][$field])) { // Если существует такое поле как в таблице
            $arParam['value'][$field] = $arParam['old'][$field];
        }else{
            $arParam['value'][$field] = null;
        }
    }
}
// Категория
$arParam['category'] = $this->db->query("SELECT * FROM category WHERE table_name = '".$_POST['ajaxFormTable']."'")->result_array();


$arBase = array();
// Добавляем все в массив для добавления
foreach ($fields as $field) {
    if(isset($arParam['value'][$field])) {
        $arBase[$field] = get_clean($arParam['value'][$field]);
    }else{
        $arParam['value'][$field] = '';
        $arBase[$field] = '';
    }
}

// * Проверка полей
// * Создаем все поля
$error = false;
foreach ($arParam['input'] as $name => $array) {
    $arParam['input'][$name]['error'] = check_field($name, $arParam['value'][$name]);

    // Если хоть одно поле есть с ошибкой
    if (!empty($arParam['input'][$name]['error']['text'])) {
        $error = true;
    }
}

// Проверяем code чтобы не было повторений
if(!empty($arParam['value']['code']) AND $arParam['type'] == 'add' OR $arParam['type'] == 'category_add') {
    if($this->db->query("SELECT code FROM ".$arParam['table']." WHERE code='".$arParam['value']['code']."'")->row_array()) {
        $error = true;
        $arParam['input']['code']['error']['type'] = 'core__form__input_warning';
        $arParam['input']['code']['error']['text'] = 'Такой ключ уже используется';
    }
} elseif (!empty($arParam['value']['code']) AND $arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit') {
    if($this->db->query("SELECT code FROM ".$arParam['table']." WHERE id !='".$arParam['value']['id']."' AND code='".$arParam['value']['code']."'")->row_array()) {
        $error = true;
        $arParam['input']['code']['error']['type'] = 'core__form__input_warning';
        $arParam['input']['code']['error']['text'] = 'Такой ключ уже используется';
    }
}
// * Описание

if(isset($arParam['value']['date'])){
    $arBase['date'] = date("Y-m-d H:i:s");
}

// Обновляем данные
if($ajaxFormButton == 'push' AND $error == false) {

    if($arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit') {
        // Редактируем
        $this->db->where('id',$arBase['id'])->update($_POST['ajaxFormTable'],$arBase);
    } elseif ($arParam['type'] == 'add' OR $arParam['type'] == 'category_add') {
        // Добавляем
        unset($arBase['id']);
        foreach ($arParam['value'] as $key => $val) {
            $arParam['value'][$key] = '';
        }

        $this->db->insert($_POST['ajaxFormTable'],$arBase);
    }
}



