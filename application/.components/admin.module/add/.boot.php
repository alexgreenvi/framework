<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */
// Какой статус отправки
$ajaxFormButton = null;
if(isset($_POST['ajaxFormButton'])){
    $ajaxFormButton = $_POST['ajaxFormButton'];
}else{
    $ajaxFormButton = false;
}

// * Выбираем все поля
unset($arParam['module']['field']);
$arParam['module']['field'] = [
    'name' => [
        'status' => 'true',
        'name' => 'Название'
    ],
    'code' => [
        'status' => 'true',
        'name' => 'Код'
    ],
    'description' => [
        'status' => 'true',
        'name' => 'Описание'
    ]
];

// Выбираем все поля из тамблицы
$fields = $this->db->list_fields('module');

// * Создаем массив записи
// * И добавляем все значения в него
$arBase = array();
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
    $arParam['module']['field'][$name]['error'] = check_field($name, $arParam['post'][$name], $ajaxFormButton);
    // * Если хоть одно поле есть с ошибкой
    if (!empty($arParam['module']['field'][$name]['error']['text'])) {
        $error = true;
    }
}

// * Проверяем CODE,  чтобы не было повторений
if($this->db->query("SELECT code FROM module WHERE id !='".$arParam['post']['id']."' AND code='".$arParam['post']['code']."'")->row_array()) {
    $error = true;
    $arParam['module']['field']['code']['error']['text'] = 'Такой ключ уже используется';
}

// *
// * Обновляем данные
// *

if($ajaxFormButton == 'push' AND $error == false) {
    // * Добавляем
    $this->db->insert('module',$arBase);
    $id = $this->db->insert_id();

    // * Чистим поля, для нового добавления
    foreach ($fields as $field) {
        $arParam['post'][$field] = "";
    }
}
// * После работы удаляем базу $arBase
// * Что бы не было перезапии

unset($arBase);