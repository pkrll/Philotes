<?php
use hyperion\core\Controller;

class TwitterController extends Controller {

    protected function main() {
        $this->view()->render("shared/header.tpl");
        $this->view()->render("twitter/main.tpl");
        $this->view()->render("shared/footer.tpl");
    }

    protected function posts() {

    }

}
