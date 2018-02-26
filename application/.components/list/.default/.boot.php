<?php
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 */

// Выборка
$this->db->select($arParam['select']);
$this->db->from($arParam['from']);

$arResult = $this->db->get();
$arResult = $arResult->result_array();
// =====
// Обработка

foreach ($arResult as $key => $arItem){
    // Категория
    if(isset($arItem['category_id'])){
        $arResult[$key]['category'] = $this->db->query("SELECT * FROM category WHERE id = '".$arItem['category_id']."'")->row_array();
    }
}