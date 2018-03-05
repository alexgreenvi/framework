<?
    $arModule['count'] = $this->db->count_all('module'); // Количество материалов в модуле
    $arModule['field'] = [
        'name' => [
            'name' => 'Название',
            'description' => ''
        ],
        'module_category_id' => [
            'name' => 'Категория',
            'description' => ''
        ],
        'img_preview' => [
            'name' => 'Превью картинка',
            'description' => ''
        ],
        'description' => [
            'name' => 'Полный текст материала',
            'description' => ''
        ],
        'img_detail' => [
            'name' => 'Детальная картинка',
            'description' => ''
        ],
        'addition_img_1' => [
            'name' => 'Дополнительная картинка',
            'description' => ''
        ],
    ];
