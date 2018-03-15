<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */

// * Выбираем модуль
$this->db->from('module');
// * 2 Варианта выборки по коду или по id
if(isset($arParam['module_code'])) {
    $this->db->where('code',$arParam['module_code']);
}else {
    $this->db->where('id',$arParam['module_id']);
}

$arParam['module'] = $this->db->get()->row_array();


// * Выбираем из что выбирать категорию или элементы
if($arParam['type'] == 'category') {
    $this->db->from('module_category');
}else {
    $this->db->from('module_element');
}

$this->db->where('module_id', $arParam['module']['id']);

$arResult = $this->db->get()->result_array();
// =====
// Обработка

foreach ($arResult as $key => $arItem){
    // Модуль
    $arResult[$key]['module'] = $arParam['module'];
    // Категория
    if(!empty($arItem['module_category_id'])){
        $arResult[$key]['category'] = $this->db->query("SELECT * FROM module_category WHERE id = '".$arItem['module_category_id']."'")->row_array();
    }

    $arResult[$key]['url'] = '/'.$arResult[$key]['module']['code'].'/'.$arResult[$key]['code'].'/';
}
