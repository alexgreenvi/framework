<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Ajax extends CI_Controller {

    public function module($type) {
        // Редактирование материалов
        foreach ($_POST AS $key => $val) {
            if(!empty($val)){
                $value[$key] = trim($val);
            }
        }
        if($type == 'edit' OR $type == 'add') {
            $this->app->component('admin.module.edit', '', '', [
                'table' => $_POST['ajaxFormTable'],
                'code' =>  $_POST['ajaxFormCode'],
                'value' => $value, // Все данный POST
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
                    'category_id' => [
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
        if($type == 'category_edit' OR $type == 'category_add') {
            $this->app->component('admin.module.edit', '', '', [
                'table' => $_POST['ajaxFormTable'],
                'code' =>  $_POST['ajaxFormCode'],
                'id'   =>  $_POST['ajaxFormId'],
                'value' => $value, // Все данный POST
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
                'type' => $type
            ]);
        }
//            if($type == 'category_edit'){
//                $this->app->component('admin','edit','', [
//                    'table' => $_POST['ajaxFormTable'],
//                    'code'  => $_POST['ajaxFormCode'],
//                    'val'   => $val, // Все данный POST
//                    'input' => [
//                        'id' => [
//                            'name' => '',
//                            'type' => 'hidden'
//                        ],
//                        'table_name' => [
//                            'name' => '',
//                            'type' => 'hidden'
//                        ],
//                        'name' => [
//                            'name' => 'Название',
//                            'description' => ''
//                        ],
//                        'code' => [
//                            'name' => 'Человекопонятный URL (ЧПУ)',
//                            'description' => ''
//                        ],
//                        'description' => [
//                            'name' => 'Полный текст материала',
//                            'description' => ''
//                        ]
//                    ],
//                    'type' => 'edit'
//                ]);
//            }
    }
}
