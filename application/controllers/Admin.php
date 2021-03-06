<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // * Делаем в самом начале
        $segment = $this->uri->segment(3);
        // * Проверяем вошел ли пользователь или нет
        if($segment !== 'login' AND $segment !== 'registration' AND !$this->app->user_check('admin')){
            redirect(base_url().'admin/user/login', 'refresh');
        }
    }

    public function index() {
        $this->app->template_header('admin',[]);
        $this->app->page_admin();
        $this->app->template_footer('admin',[]);
    }
    public function page() {
        $this->app->template_header('admin',[]);
        $this->app->page_admin();
        $this->app->template_footer('admin',[]);
    }

    // Главная страница Админки
//    public function index() {
//        $this->app->template_header('admin',[]);
//        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/index.php');
//        $this->app->template_footer('admin',[]);
//    }
    // Модули
    public function module() {
        $MODULE_CODE = $this->uri->segment(2);
        $arParam = $this->app->module_get_config($MODULE_CODE);

        $this->app->template_header('admin',[]);
        $this->app->admin_get_page('', '', $arParam);
        $this->app->template_footer('admin',[]);
    }
    public function module_element_edit($ID = false) {
        $MODULE_CODE = $this->uri->segment(2);
        $arParam = $this->app->module_get_config($MODULE_CODE);
        $arResult = $this->app->detail($ID);

        $this->app->template_header('admin',[]);
        $this->app->admin_get_page('element_edit', $ID, $arParam , $arResult);
        $this->app->template_footer('admin',[]);
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
    public function module_config () {
        $module_code = $this->uri->segment(2);
        $arModule = $this->app->get_module_config($module_code);
        $this->app->get_admin_module_page([
            'module' => $arModule,
            'page' => [
                'name' => 'config',
                'detail' => false,
            ]
        ]);
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
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/.templates/header.php'); // Header
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/user/login.php');
        include ($_SERVER['DOCUMENT_ROOT'].'/application/.admin/.templates/footer.php'); // Footer
    }
    public function user_login() {
        // * Проверяем вошел ли пользователь
        if($this->app->user_check('admin')){
            redirect(base_url().'admin/', 'refresh');
        }
        $this->app->template_header('admin',[]);
        $this->app->admin_get_page('login', '');
        $this->app->template_footer('admin',[]);
    }
    public function user_exit(){
        $this->app->user_exit();
        redirect(base_url(), 'refresh');
    }
}
