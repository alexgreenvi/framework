<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //  Делаем в самом начале
    }
    // Главная страница Админки
    public function index() {
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/app/header.php'); // Header
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/index.php');
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/app/footer.php'); // Footer
    }
    // Модули
    public function module() {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);
        $this->app->get_admin_module_page([
            'module' => $arModule,
            'page' => [
                'name' => 'index',
                'detail' => false,
                'id' => null
            ],
        ]);
    }
    public function module_edit($ID = false) {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);
        $this->app->get_admin_module_page([
            'module' => $arModule,
            'page' => [
                'name' => 'edit',
                'detail' => true,
                'id' => $ID
            ]
        ]);
    }
    public function module_add() {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);
        $this->app->get_admin_module_page([
            'module' => $arModule,
            'page' => [
                'name' => 'add',
                'detail' => false,
                'id' => null
            ]
        ]);
    }
    public function module_delete ($ID = false) {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);

        $this->db->delete('module_element',['id' => $ID,'module_id' => $arModule['id']]);
        redirect(base_url().'admin/'.$arModule['code'].'/', 'refresh');
    }

    public function module_category () {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);
        $this->app->get_admin_module_page([
            'module' => $arModule,
            'page' => [
                'name' => 'category',
                'detail' => false,
                'id' => null
            ]
        ]);
    }
    public function module_category_edit ($ID = false) {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);
        $this->app->get_admin_module_page([
            'module' => $arModule,
            'category' => true,
            'page' => [
                'name' => 'category_edit',
                'detail' => true,
                'id' =>  $ID
            ]
        ]);
    }
    public function module_category_add() {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);
        $this->app->get_admin_module_page([
            'module' => $arModule,
            'category' => true,
            'page' => [
                'name' => 'category_add',
                'detail' => false,
                'id' => null
            ]
        ]);
    }
    public function module_category_delete($ID = false) {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);

        $this->db->delete('module_category',['id' => $ID,'module_id' => $arModule['id']]);
        redirect(base_url().'admin/'.$arModule['code'].'/', 'refresh');
    }

    // Пользователи
    public function user() {
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/app/header.php'); // Header
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/user/login.php');
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/app/footer.php'); // Footer
    }
    public function user_login() {
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/app/header.php'); // Header
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/user/login.php');
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/app/footer.php'); // Footer
    }
    public function user_exit(){

    }
}
