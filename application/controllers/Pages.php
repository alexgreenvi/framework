<?php
defined('BASEPATH') OR exit('Нет прямого доступа к скрипту');

class Pages extends CI_Controller {

    public function index() {
        $this->app->template_header();
        $this->app->page();
        $this->app->template_footer();
    }
    public function page($CODE) {
        $this->app->page($CODE);
    }
}
