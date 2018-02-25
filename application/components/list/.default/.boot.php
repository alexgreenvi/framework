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





