<?php
defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Pages extends CI_Controller {

    public function index() {
        $this->load->view('index');
    }
}
