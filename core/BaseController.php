<?php

require_once __DIR__ . '/BaseView.php';
class BaseController {
    protected $view;

    public function __construct() {
        $this->view = new BaseView();
    }
}

?>