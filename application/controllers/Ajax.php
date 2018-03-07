<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Ajax extends CI_Controller {
    public function module($type) {
        if($type == 'element_edit' OR $type == 'element_add') {
            $arParam = $this->app->module_get_config($_POST['ajaxFormModuleCode']);
            $this->app->component('admin.module', 'element.edit', '', [
                'post' => $_POST, // Все данный POST
                'files' => $_FILES, // Все данный FILES
                'module' => $arParam,
                'type' => $type
            ]);
        }
        if($type == 'category_edit' OR $type == 'category_add') {
            $arParam = $this->app->module_get_config($_POST['ajaxFormModuleCode']);
            $this->app->component('admin.module', 'category.edit', '', [
                'post' => $_POST, // Все данный POST
                'files' => $_FILES, // Все данный FILES
                'module' => $arParam,
                'type' => $type
            ]);
        }
        if($type == 'config'){
            $arParam = $this->app->module_get_config($_POST['ajaxFormModuleCode']);
            $this->app->component('admin.module', 'config', '', [
                'post' => $_POST, // Все данный POST
                'module' => $arParam,
                'type' => $type
            ]);
        }
    }
    public function user($CODE){
        $this->app->component('user.'.$CODE , '', '', [
            'post' => $_POST, // Все данный POST
        ]);
    }
}
