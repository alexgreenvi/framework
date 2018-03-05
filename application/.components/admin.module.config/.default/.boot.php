<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */

// Кнопка и статус отправки
$ajaxFormButton = null;
if(isset($_POST['ajaxFormButton'])){
    $ajaxFormButton = $_POST['ajaxFormButton'];
}else{
    $ajaxFormButton = false;
}
// Перемменная для ошибок
$error = false;
// Выбираем все поля
$arField = $this->app->module_get_field();



// Создаем поля field с их свойствами
$arInputIsset = ['status','name'];
foreach ($arField as $name => $array) {
    foreach ($arInputIsset as $inputIsset) {
        if(!isset($arParam['module']['field'][$name][$inputIsset])){
            $arParam['module']['field'][$name][$inputIsset] = '';
        }
    }
    // * Проверка Дополнительных полей
    if(isset($arParam['post']['field-'.$name])) {
        //$arParam['module']['field'][$name]['error'] = check_field($name, $arParam['post']['field-'.$name], $ajaxFormButton);
        // Если хоть одно поле есть с ошибкой
        if (!empty($arParam['module']['field'][$name]['error']['text'])) {
            $error = true;
        }
    }

    // * Если отправили
    if($ajaxFormButton == 'push') {
        // * Проверяем checkbox
        if (isset($arParam['post']['field-' . $name . '-checkbox']) AND $arParam['post']['field-' . $name . '-checkbox'] == 'true') {
            $arParam['module']['field'][$name]['status'] = 'true';
        } else {
            $arParam['module']['field'][$name]['status'] = 'false';
        }

        // * Проверяем name
        if (isset($arParam['post']['field-' . $name])) {
            $arParam['module']['field'][$name]['name'] = get_clean($arParam['post']['field-' . $name]);
        }
    }
}

$arModule = $arParam['module'];
$arParam['name_error'] = [
    'type' => '',
    'text' => ''
];
$arParam['code_error'] = [
    'type' => '',
    'text' => ''
];
$arParam['module_old'] = $this->db->query("SELECT * FROM module WHERE code='".$arParam['module']['code']."'")->row_array();
$arModule['id'] = $arParam['module_old']['id'];

if($ajaxFormButton == 'push'){

    // * Проверяем таблицу module
    // * Выбираем поля из модуля
    // * name , code , description

    $arFieldsModule = $this->db->list_fields('module');

    foreach ($arFieldsModule as $name) {
        if(isset($arParam['post'][$name]) AND !empty($arParam['post'][$name]) OR $name == 'description') { // Если существует такое поле как в таблице
            $arParam['module'][$name] = get_clean($arParam['post'][$name]);
            $arModule[$name] = get_clean($arParam['post'][$name]);
        }
    }

    // * Проверяем code
    if(!empty($arParam['post']['code'])) {
        // * чтобы не было повторений
        if($this->db->query("SELECT code FROM module WHERE code='".$arParam['post']['code']."'")->row_array() AND !$arParam['module']['code'] == $arParam['module_old']['code']) {
            $error = true;
            $arParam['code_error']['type'] = 'core__form__input_warning';
            $arParam['code_error']['text'] = 'Такой ключ уже используется';
        }
        // * Только английские символы
        if(!preg_match("/^[A-Z_a-z0-9]+$/",$arParam['post']['code'])){
            $error = true;
            $arParam['code_error']['type'] = 'core__form__input_warning';
            $arParam['code_error']['text'] = 'Вы ввели неправильные символы';
        }
    }else{
        $error = true;
        $arParam['code_error']['type'] = 'core__form__input_warning';
        $arParam['code_error']['text'] = 'Вы не заполнили поле';
    }

    // Проверяем name чтобы не было пустым
    if(empty($arParam['post']['name'])) {
        $error = true;
        $arParam['name_error']['type'] = 'core__form__input_warning';
        $arParam['name_error']['text'] = 'Вы не заполнили поле';
    }


    // * Чистим
    foreach ($arField as $name => $array) {
        unset($arModule['field'][$name]['error']);
    }
    // Сохраняем файл
    if($error == false) {

        $arBase['code'] = $arModule['code'];
        $arBase['name'] = $arModule['name'];
        $arBase['description'] = $arModule['description'];
        $this->db->where('id',$arModule['id'])->update('module',$arBase);

        file_put_contents('local/.modules/' . $arParam['module']['code'] . '/.config.php', '<?php $arModule = ' . var_export($arModule, true) . ';');
    }
}