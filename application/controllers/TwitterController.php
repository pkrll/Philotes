<?php
use hyperion\core\Controller;

class TwitterController extends Controller {

    protected function main() {
        $this->view()->render("shared/header.tpl");
        $this->view()->render("twitter/main.tpl");
        $this->view()->render("shared/footer.tpl");
    }

    protected function manage() {
        $selection = $this->arguments[0];

        if ($selection == "new") {
            // Add Twitter account
        } else if ($selection == "update") {

        } else {
            // Manage Twitter accounts
            $accounts = $this->model()->fetchAccounts();
            $this->view()->render("shared/header.tpl");
            $this->view()->assign("accounts", $accounts);
            $this->view()->render("twitter/manage.tpl");
            $this->view()->render("shared/footer.tpl");
        }
    }

}
