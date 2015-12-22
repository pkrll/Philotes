<?php
use hyperion\core\Controller;
use saturn\session\session;

class TwitterController extends Controller {

    protected function auth() {
        if (isset($this->arguments[0])) {
            $redirectURL = $this->arguments[0];
			Session::set("redirectURL", $redirectURL);


        }

        $response = $this->model()->authenticate();

        if (isset($response["error"])) {
            print_r($response["error"]);
        } else {
            $redirectURL = Session::get("redirectURL");
            Session::clear("redirectURL");
            header("Location: http://{$_SERVER[HTTP_HOST]}/twitter/{$redirectURL}");
        }
    }

    protected function main() {
        $this->view()->render("shared/header.tpl");
        $this->view()->render("twitter/main.tpl");
        $this->view()->render("shared/footer.tpl");
    }

    protected function manage() {
        $selection = $this->arguments[0];

        if ($selection == "import") {
            // Add Twitter account
            $lists = $this->model()->fetchListsFromTwitter();
            if (isset($lists["error"])) {
                $this->view()->assign("error", $lists["error"]);
                unset($lists);
            }

            $this->view()->render("shared/header.tpl");
            $this->view()->assign("lists", $lists);
            $this->view()->render("twitter/import.tpl");
            $this->view()->render("shared/footer.tpl");
        } else if ($selection == "update") {
            $this->view()->render("shared/header.tpl");
            $this->view()->render("twitter/update.tpl");
            $this->view()->render("shared/footer.tpl");
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
