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
        $arParam = $this->app->get_module_config();
        $this->app->get_admin_module_page([
            'page' => [
                'name' => 'index',
                'detail' => false,
                'id' => null
            ]
        ] + $arParam);
    }
    public function module_edit($ID = false) {
        $arParam = $this->app->get_module_config();
        $this->app->get_admin_module_page([
            'page' => [
                'name' => 'edit',
                'detail' => true,
                'id' => $ID
            ]
        ] + $arParam);
    }
    public function module_add() {
        $arParam = $this->app->get_module_config();
        $this->app->get_admin_module_page([
            'page' => [
                'name' => 'add',
                'detail' => false,
                'id' => null
            ]
        ] + $arParam);
    }
    public function module_delete ($ID = false) {
        $table = $this->uri->segment(2);
        $this->db->delete($table,['id' => $ID]);

        redirect(base_url().'admin/'.$table.'/', 'refresh');
    }
    public function module_category () {
        $arParam = $this->app->get_module_config();
        $this->app->get_admin_module_page([
                'page' => [
                    'name' => 'categories',
                    'detail' => false,
                    'id' => null
                ]
            ] + $arParam);
    }
    public function module_category_edit ($ID = false) {
        $arParam = $this->app->get_module_config();
        $this->app->get_admin_module_page([
                'table' => 'category',
                'tableTo' => $arParam['table'],
                'page'  => [
                    'name' => 'category_edit',
                    'detail' => true,
                    'id' => $ID
                ]
            ] + $arParam );
    }
    public function module_category_delete($ID = false) {
        $table = $this->uri->segment(3);
        $this->db->delete($table,['id' => $ID]);

        redirect(base_url().'admin/'.$table.'/category/', 'refresh');
    }
}
