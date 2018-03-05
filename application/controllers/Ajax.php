<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Ajax extends CI_Controller {
    public function module($type) {
        if($type == 'edit' OR $type == 'add') {
            $arModule = $this->app->get_module_config($_POST['ajaxFormModuleCode']);
            $this->app->component('admin.module.edit', '', '', [
                'post' => $_POST, // Все данный POST
                'files' => $_FILES, // Все данный FILES
                'module' => $arModule,
                'type' => $type
            ]);
        }
        if($type == 'category_edit' OR $type == 'category_add') {
            $arModule = $this->app->get_module_config($_POST['ajaxFormModuleCode']);
            $this->app->component('admin.module.edit', '', '', [
                'post' => $_POST, // Все данный POST
                'files' => $_FILES, // Все данный FILES
                'module' => $arModule,
                'type' => $type
            ]);
        }
        if($type == 'config'){
            $arModule = $this->app->get_module_config($_POST['ajaxFormModuleCode']);
            $this->app->component('admin.module.config', '', '', [
                'post' => $_POST, // Все данный POST
                'module' => $arModule,
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
