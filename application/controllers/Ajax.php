<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Ajax extends CI_Controller {

    public function module($type) {
        // Редактирование материалов
        if($type == 'edit' OR $type == 'add' OR $type == 'cat_edit'){
            foreach ($_POST AS $key => $value) {
                if(!empty($value)){
                    $val[$key] = trim($value);
                }
            }
            if($type == 'edit' OR $type == 'add') {
                $this->app->component('admin', 'edit', '', [
                    'table' => $_POST['ajaxFormTable'],
                    'code' => $_POST['ajaxFormCode'],
                    'val' => $val, // Все данный POST
                    'input' => [
                        'id' => [
                            'name' => '',
                            'type' => 'hidden'
                        ],
                        'name' => [
                            'name' => 'Название',
                            'description' => ''
                        ],
                        'code' => [
                            'name' => 'Человекопонятный URL (ЧПУ)',
                            'description' => ''
                        ],
                        'cat_id' => [
                            'name' => 'Категория',
                            'description' => ''
                        ],
                        'description' => [
                            'name' => 'Полный текст материала',
                            'description' => ''
                        ]
                    ],
                    'type' => $type
                ]);
            }
            if($type == 'cat_edit'){
                $this->app->component('admin','edit','', [
                    'table' => $_POST['ajaxFormTable'],
                    'code'  => $_POST['ajaxFormCode'],
                    'val'   => $val, // Все данный POST
                    'input' => [
                        'id' => [
                            'name' => '',
                            'type' => 'hidden'
                        ],
                        'table_name' => [
                            'name' => '',
                            'type' => 'hidden'
                        ],
                        'name' => [
                            'name' => 'Название',
                            'description' => ''
                        ],
                        'code' => [
                            'name' => 'Человекопонятный URL (ЧПУ)',
                            'description' => ''
                        ],
                        'description' => [
                            'name' => 'Полный текст материала',
                            'description' => ''
                        ]
                    ],
                    'type' => 'edit'
                ]);
            }
        }
    }
}
