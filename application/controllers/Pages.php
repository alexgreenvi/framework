<?php
defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Pages extends CI_Controller {
    public function index() {
        $arConfig = get_config();
        $this->app->page();
    }
    public function page($CODE) {
        $this->app->page($CODE);
    }
}
