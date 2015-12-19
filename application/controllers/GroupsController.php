<?php
use hyperion\core\Controller;

class GroupsController extends Controller {

    protected function main() {
        $groups = $this->model()->fetchGroups();

        $this->view()->render("shared/header.tpl");
        $this->view()->assign("groups", $groups);
        $this->view()->render("groups/main.tpl");
        $this->view()->render("shared/footer.tpl");
    }

    protected function add() {
        $this->view()->render("shared/header.tpl");
        $this->view()->render("groups/add.tpl");
        $this->view()->render("shared/footer.tpl");
    }

}
