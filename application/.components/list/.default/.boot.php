<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */

// Выбираем модуль
$this->db->from('module');
$this->db->where('code',$arParam['module']);

$arParam['module'] = $this->db->get()->row_array();
// Выбираем сам елемент
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
}
