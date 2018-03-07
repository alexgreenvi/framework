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
$fields = $this->db->list_fields('module_category');


// * Для РЕДАКТИРОВАНИЯ
// * Быбираем старые данные
// * Если есть отправка, то берем то что в отправленно
// * Иначе то что уже было в базе
if($_POST['ajaxForm'] == 'category_edit'){
    $arParam['old'] = $this->db->query("SELECT * FROM module_category WHERE id = '".$arParam['post']['ajaxFormModuleElementId']."'")->row_array();

    foreach ($fields as $field) {
        if(!isset($arParam['post'][$field])) { // Если существует такое поле как в таблице
            $arParam['post'][$field] = $arParam['old'][$field];
        }
    }
}


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
if($this->db->query("SELECT code FROM module_category WHERE id !='".$arParam['post']['id']."' AND code='".$arParam['post']['code']."'")->row_array()) {
    $error = true;
    $arParam['module']['field']['code']['error']['text'] = 'Такой ключ уже используется';
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
    if($arParam['type'] == 'category_edit')
    {
        // * Редактируем
        $this->db->where('id',$arBase['id'])->update('module_category',$arBase);
        $id = $arBase['id'];
    }
    elseif ($arParam['type'] == 'category_add')
    {
        // * Добавляем
        $this->db->insert('module_category',$arBase);
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