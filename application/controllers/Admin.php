<?php defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //  Делаем в самом начале

        $this->load->view('admin/templates/app/header');

    }
    public function index() {
        $this->load->view('admin/index');
        $this->load->view('admin/templates/app/footer');
    }

    public function news() {
        // INDEX
        $arData['arParam']['title'] = 'Новости сайта';
        $arData['arParam']['table'] = 'news';
        $arData['arParam']['count'] = $this->db->count_all('news');
        $arData['arParam']['link']  = '/news/';
        $arData['arParam']['menu']  = [
            'Материалы' => '',
            'Категории' => 'cat',
            'Настройки' => 'config'
        ];
        $arData['arParam']['type'] = 'index';
        // =====

        $this->load->view('admin/module/module', $arData);
        $this->load->view('admin/templates/app/footer');
    }
    public function news_edit($CODE = false) {
        // DETAIL
        $arData['arResult'] = $this->app->detail('news',$CODE);
        //
        $arData['arParam']['title'] = 'Редактирование материала';
        $arData['arParam']['table'] = 'news';
        $arData['arParam']['count'] = $this->db->count_all('news');
        $arData['arParam']['link']  = '/news/';
        $arData['arParam']['menu']  = [
            'Материалы' => '',
            'Категории' => 'cat',
            'Настройки' => 'config'
        ];
        $arData['arParam']['type'] = 'edit';
        // =====
        $this->load->view('admin/module/module', $arData);
        // =======
        $this->load->view('admin/templates/app/footer');
    }
    public function news_add() {
        $arData['arParam']['title'] = 'Добавление материала';
        $arData['arParam']['table'] = 'news';
        $arData['arParam']['count'] = $this->db->count_all('news');
        $arData['arParam']['link']  = '/news/';
        $arData['arParam']['menu']  = [
            'Материалы' => '',
            'Категории' => 'cat',
            'Настройки' => 'config'
        ];
        $arData['arParam']['type'] = 'add';
        // =====
        $this->load->view('admin/module/module', $arData);
        // =======
        $this->load->view('admin/templates/app/footer');
    }
    public function news_delete($code) {
        $table = $this->uri->segment(2);
        $this->db->delete($table,['code' => $code]);

        redirect('/admin/'.$table.'/', 'refresh');
    }
    public function news_cat() {
        // CAT
        $arData['arParam']['title'] = 'Новости сайта';
        $arData['arParam']['table'] = 'news';
        $arData['arParam']['count'] = $this->db->count_all('news');
        $arData['arParam']['link']  = '/news/';
        $arData['arParam']['menu']  = [
            'Материалы' => '',
            'Категории' => 'cat',
            'Настройки' => 'config'
        ];
        // =====
        $arData['arParam']['type'] = 'cat';
        // =====
        $this->load->view('admin/module/module', $arData);
        $this->load->view('admin/templates/app/footer');
    }
    public function news_cat_edit($CODE = false) {
        // DETAIL
        $arData['arResult'] = $this->app->detail('cat',$CODE);
        //
        $arData['arParam']['title'] = 'Редактирование материала';
        $arData['arParam']['table'] = 'cat';
        $arData['arParam']['table_to'] = 'news';
        $arData['arParam']['count'] = $this->db->count_all('news');
        $arData['arParam']['link']  = '/cat/';
        $arData['arParam']['menu']  = [
            'Материалы' => '',
            'Категории' => 'cat',
            'Настройки' => 'config'
        ];
        $arData['arParam']['type'] = 'cat_edit';
        // =====
        $this->load->view('admin/module/module', $arData);
        // =======
        $this->load->view('admin/templates/app/footer');
    }
    public function news_cat_delete($code) {
        $table = $this->uri->segment(2);
        $this->db->delete($table,['code' => $code]);

        redirect('/admin/'.$table.'/', 'refresh');
    }
}
