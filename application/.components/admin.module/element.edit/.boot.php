<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */
// * Какой статус отправки
$ajaxFormButton = null;
if(isset($_POST['ajaxFormButton'])) $ajaxFormButton = $_POST['ajaxFormButton']; else $ajaxFormButton = false;

// * КАТЕГОРИИ
// * Выбираем все категории
$arParam['module_category'] = $this->db->query("SELECT * FROM module_category WHERE module_id = '".$arParam['post']['ajaxFormModuleId']."'")->result_array();

// * Выбираем поля из тамблицы
$fields = $this->db->list_fields('module_element');

// * Cоздаем поля
$arField = $this->app->module_get_field();

// * Перебираем все поля
// * Сравниваем с настройками модуля
foreach ($arField as $name => $array) {
    if(empty($arParam['module']['field'][$name]['name'])){
        $arParam['module']['field'][$name]['name'] = $array['name'];
    }
    // * Создаем поля для ошибок
    $arParam['module']['field'][$name]['error'] = '';
}
// * Создаем не достоющие POST поля
foreach ($fields as $field) {
    if(isset($arParam['post'][$field])) {
        $arBase[$field] = get_clean($arParam['post'][$field]);
    }else{
        $arParam['post'][$field] = '';
    }
}

// * Для РЕДАКТИРОВАНИЯ
// * Быбираем старые данные
// * Если есть отправка, то берем то что в отправленно
// * Иначе то что уже было в базе
if($_POST['ajaxForm'] == 'element_edit'){
    $arParam['old'] = $this->db->query("SELECT * FROM module_element WHERE id = '".$arParam['post']['ajaxFormModuleElementId']."'")->row_array();

    foreach ($fields as $field) {
        if(!isset($arParam['post'][$field])) { // Если существует такое поле как в таблице
            $arParam['post'][$field] = $arParam['old'][$field];
        }
    }
}

// * Если ключ (CODE) не указан, и материал добавляют, то выставить из названия
if(empty($arParam['post']['code']) AND $ajaxFormButton == 'push' AND $arParam['type'] == 'element_add') {
    $arParam['post']['code'] = get_url_code($arParam['post']['name']);
}

// * Проверка полей
// * Создаем все поля
$error = false;
foreach ($arParam['module']['field'] as $name => $array) {
    $arParam['module']['field'][$name]['error'] = check_field($name, $arParam['post'][$name], $ajaxFormButton);
    // * Если хоть одно поле есть с ошибкой
    if (!empty($arParam['module']['field'][$name]['error']['text'])) {
        $error = true;
    }
}

// * Проверяем CODE, чтобы не было повторений
if($this->db->query("SELECT code FROM module_element WHERE id !='".$arParam['post']['id']."' AND code='".$arParam['post']['code']."'")->row_array()) {    
    //  * Если это добавление то просто привавлять по +1 к коду повтора
    if($ajaxFormButton == 'push' AND $arParam['type'] == 'element_add') {

        // * Проверяем и добавляем заного новую цифру
        $i = 1;
        while ($this->db->query("SELECT code FROM module_element WHERE id !='".$arParam['post']['id']."' AND code='".$arParam['post']['code']."_".$i."'")->row_array()) {
           $i ++;
        }
        $arParam['post']['code'] = $arParam['post']['code']."_".$i; 
        
    }else{
        $error = true;
        $arParam['module']['field']['code']['error']['text'] = 'Такой ключ уже используется';
    }
}

// * Создаем массив записи
// * И добавляем все значения в него
$arBase = array();
foreach ($fields as $field) {
    if(!empty($arParam['post'][$field])) {
        $arBase[$field] = get_clean($arParam['post'][$field]);
    }else{
        $arBase[$field] = '';
    }
}

// * Остальные данные
// * Что нужно подправить при добавлении
if(isset($arParam['post']['date'])){
    $arBase['date'] = date("Y-m-d H:i:s");
}

// * Удаляем поля с картинками
// * Чтобы в поля не записывалось значение VALUE
unset($arBase['img_preview']);
unset($arBase['img_detail']);
for ($i = 1; $i <= 10; $i++) {
    unset($arBase['addition_img_'.$i]);
}

// *
// * Обновляем данные
// *
$id = null;

if($ajaxFormButton == 'push' AND $error == false) {
    if($arParam['type'] == 'element_edit')
    {
        // * Редактируем
        $this->db->where('id',$arBase['id'])->update('module_element',$arBase);
        $id = $arBase['id'];
    }
    elseif ($arParam['type'] == 'element_add')
    {
        // * Добавляем
        $this->db->insert('module_element',$arBase);
        $id = $this->db->insert_id();

        // * Чистим поля, для нового добавления
        foreach ($fields as $field) {
            $arParam['post'][$field] = "";
        }
    }
}
// * После работы удаляем базу $arBase
// * Что бы не было перезапии

unset($arBase);

// *
// * Работа с картинками
// *

$config['allowed_types'] = 'gif|jpg|png'; // Форматы
$config['overwrite'] = true;              // Перезапись
$config['max_size'] = '10000';            // Размер
$this->load->library('upload', $config);

if(!empty($arParam['files']) AND !empty($id)) {
    foreach ($arParam['files'] as $key => $arItem){
        // *
        // * Удаляем старый файл
        if(isset($arParam['old'][$key])){
            $src_img_old = $_SERVER['DOCUMENT_ROOT'].$arParam['old'][$key];
            if(file_exists($src_img_old)){
                unlink($src_img_old);
            }
        }

        // * Путь для загрузки
        $src_img_dir = '/local/uploads/'.$arParam['module']['code'].'/images/';

        // Создаем папку для модуля, если ее нет
        if (!is_dir($_SERVER['DOCUMENT_ROOT'].$src_img_dir)){
            mkdir($_SERVER['DOCUMENT_ROOT'].$src_img_dir, 0777, true);
        }

        // * Сохраняем
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$src_img_dir;
        $config['file_name'] = $id.'-'.$key;
        $this->upload->initialize($config);
        $this->upload->do_upload($key);
        // *
        // * Обновляем данные в базе данных
        $arBase[$key] = $src_img_dir.$this->upload->data('file_name');
        $this->db->where('id', $id)->update('module_element',$arBase);
    }
}