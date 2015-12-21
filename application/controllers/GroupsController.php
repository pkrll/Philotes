<?php
use hyperion\core\Controller;

class GroupsController extends Controller {

    protected function main() {
        $groups = $this->model()->fetchGroups();
        if (isset($groups["error"])) {
            $error  = $groups["error"];
            $groups = array();
        }

        $this->view()->assign("error", $error);
        $this->view()->render("shared/header.tpl");
        $this->view()->assign("groups", $groups);
        $this->view()->render("groups/main.tpl");
        $this->view()->render("shared/footer.tpl");
    }

    protected function manage() {
        $selection = $this->arguments[0];

        if ($selection == "new") {
            // Add group
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $response = $this->model()->createGroup($_POST);
                // Check for errors
                if (isset($response["error"])) {
                    $error = $response["error"];
                    $this->view()->assign("error", $error);
                }
            }

            $this->view()->render("shared/header.tpl");
            $this->view()->render("groups/add.tpl");
            $this->view()->render("shared/footer.tpl");
        } else if ($selection == "edit") {
            // Edit group
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $response = $this->model()->updateGroup($_POST);
                echo json_encode($response);
            }
        } else {
            // Manage groups
            $groups = $this->model()->fetchGroups();
            $this->view()->render("shared/header.tpl");
            $this->view()->assign("groups", $groups);
            $this->view()->render("groups/manage.tpl");
            $this->view()->render("shared/footer.tpl");
        }
    }

}
