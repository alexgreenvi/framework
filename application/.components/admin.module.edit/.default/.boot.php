<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */
// Проверяем для в какую базу мы домавляем
// И меням поля ввода
if($arParam['type'] == 'category_add' OR $arParam['type'] == 'category_edit'){
    $table = 'module_category';
    $arParam['module']['field'] = [
        'name' => [
            'name' => 'Название',
            'description' => ''
        ],
        'code' => [
            'name' => 'Человекопонятный URL (ЧПУ)',
            'description' => ''
        ],
        'description' => [
            'name' => 'Описание',
            'description' => ''
        ],
    ];
}else {
    $table = 'module_element';
}


// Создаем подя (Ошибки)
$arInputIsset = ['name','type','description'];
foreach ($arParam['module']['field'] as $name => $array) {
    foreach ($arInputIsset as $inputIsset) {
        if(!isset($arParam['module']['field'][$name][$inputIsset])){
            $arParam['module']['field'][$name][$inputIsset] = '';
        }
    }
    $arParam['module']['field'][$name]['error'] = '';
}

// Выбираем все поля из тамблицы
$fields = $this->db->list_fields($table);
$ajaxFormButton = null;

// Какой статус отправки
if(isset($_POST['ajaxFormButton'])){
    $ajaxFormButton = $_POST['ajaxFormButton'];
}else{
    $ajaxFormButton = false;
}
// Быбираем сам материал
// * Если есть отправка то берем то что в отправленно, иначе то что уже было в базе
if($_POST['ajaxForm'] == 'edit' OR $_POST['ajaxForm'] == 'category_edit'){
    $arParam['old'] = $this->db->query("SELECT * FROM $table WHERE id = '".$arParam['post']['ajaxFormModuleElementId']."'")->row_array();

    foreach ($fields as $field) {
        if(!isset($arParam['post'][$field])) { // Если существует такое поле как в таблице
            $arParam['post'][$field] = $arParam['old'][$field];
        }
    }
}
// Категория
$arParam['module_category'] = $this->db->query("SELECT * FROM module_category WHERE module_id = '".$arParam['post']['ajaxFormModuleId']."'")->result_array();


$arBase = array();
// Добавляем все в массив для добавления
foreach ($fields as $field) {
    if(isset($arParam['post'][$field])) {
        $arBase[$field] = get_clean($arParam['post'][$field]);
    }else{
        $arParam['post'][$field] = '';
        $arBase[$field] = '';
    }
}

// * Проверка полей
// * Создаем все поля
$error = false;
foreach ($arParam['module']['field'] as $name => $array) {
    $arParam['module']['field'][$name]['error'] = check_field($name, $arParam['post'][$name]);

    // Если хоть одно поле есть с ошибкой
    if (!empty($arParam['module']['field'][$name]['error']['text'])) {
        $error = true;
    }
}

// Проверяем code чтобы не было повторений
if(!empty($arParam['post']['code']) AND $arParam['type'] == 'add' OR $arParam['type'] == 'category_add') {
    if($this->db->query("SELECT code FROM $table WHERE code='".$arParam['post']['code']."'")->row_array()) {
        $error = true;
        $arParam['module']['field']['code']['error']['type'] = 'core__form__input_warning';
        $arParam['module']['field']['code']['error']['text'] = 'Такой ключ уже используется';
    }
} elseif (!empty($arParam['post']['code']) AND $arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit') {
    if($this->db->query("SELECT code FROM $table WHERE id !='".$arParam['post']['id']."' AND code='".$arParam['post']['code']."'")->row_array()) {
        $error = true;
        $arParam['module']['field']['code']['error']['type'] = 'core__form__input_warning';
        $arParam['module']['field']['code']['error']['text'] = 'Такой ключ уже используется';
    }
}
// * Описание

if(isset($arParam['post']['date'])){
    $arBase['date'] = date("Y-m-d H:i:s");
}

// Ссылки для переходов
$arParam['link'] = null;
if($this->uri->segment(3) == 'category_edit' OR $this->uri->segment(3) == 'category_add') {
    $arParam['link'] = '/admin/'.$arParam['post']['ajaxFormModuleCode'].'/category/';
}else{
    $arParam['link'] = '/admin/'.$arParam['post']['ajaxFormModuleCode'].'/';
}
// Удаляем поля с картинками
unset($arBase['img_preview']);
unset($arBase['img_detail']);
for ($i = 1; $i < 10; $i++){
    unset($arBase['addition_img_'.$i]);
    unset($arBase['addition_'.$i]);
}

// Обновляем данные
$id = $arBase['id'];

if($ajaxFormButton == 'push' AND $error == false) {
    if($arParam['type'] == 'edit' OR $arParam['type'] == 'category_edit') {
        // Редактируем
        $this->db->where('id',$arBase['id'])->update($table,$arBase);
    } elseif ($arParam['type'] == 'add' OR $arParam['type'] == 'category_add') {
        // Добавляем
        unset($arBase['id']);
        foreach ($arParam['post'] as $key => $val) {
            $arParam['post'][$key] = '';
        }
        $this->db->insert($table,$arBase);
        $id = $this->db->insert_id();
    }
}
// Файлы
$config['allowed_types'] = 'gif|jpg|png';
$config['overwrite'] = true; // Перезапись
$config['max_size'] = '10000';

if(!empty($arParam['files']) AND !empty($id)) {
    foreach ($arParam['files'] as $key => $arItem){
        // Превью картинка
        $config['upload_path'] = './uploads/'.$arParam['post']['ajaxFormModuleCode'].'/';
        $config['file_name'] = $id.'-'.$key;
        $this->load->library('upload', $config);
        $this->upload->do_upload($key);
        // Обновляем данные
        $arBase[$key] = '/uploads/'.$arParam['post']['ajaxFormModuleCode'].'/'.$this->upload->data('file_name');;
        $this->db->where('id',$arBase['id'])->update($table,$arBase);
    }
}