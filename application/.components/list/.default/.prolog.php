<?
/**
 *
 * @arParam массив праметров компонента
 * @arResult массив результата
 * @arItem массив отдельного элемента
 *
 */
if (!isset($arParam['select'])) $arParam['select'] = '*';
if (!isset($arParam['from']))   $arParam['from'] = '';

if (!isset($arParam['where'])) $arParam['where'] = '';
if (!isset($arParam['count'])) $arParam['count'] = 0;
if (!isset($arParam['order'])) $arParam['order'] = '';