<?
    $arParam['title'] = 'Новости сайта'; // Название
    $arParam['table'] = 'news';          // Таблица

    $arParam['count'] = $this->db->count_all($arParam['table']); // Количество материалов в модуле
    $arParam['menu']  = [                // Меню модуля
        'Материалы' => '',
        'Категории' => 'category',
        'Настройки' => 'config'
    ];