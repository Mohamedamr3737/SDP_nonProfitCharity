<?php
class BaseView {
    public function render($template, $data = []) {
        extract($data);
        include("views/{$template}.php");
    }
}

?>