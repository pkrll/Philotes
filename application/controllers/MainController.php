<?php
use hyperion\core\Controller;

class MainController extends Controller {

    protected function main() {
        $this->view()->render("shared/header.tpl");
        $this->view()->render("main/main.tpl");
        $this->view()->render("shared/footer.tpl");
    }

}
