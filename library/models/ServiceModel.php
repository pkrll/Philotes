<?php
use hyperion\core\Model;
use saturn\session\session;

class ServiceModel extends ExtendedModel {

    protected function credentials() {
        return NULL;
    }

    protected function name() {
        return str_replace("Model", "", get_class($this));
    }

    protected function isAuthenticated() {
        if (Session::get("accessToken") == NULL) {
            return false;
        }

        return true;
    }

    protected function storeAccessTokenInDatabase($accessToken) {
        $tokenSecret = (isset($accessToken["token_secret"])) ? $accessToken["token_secret"] : NULL;
        $accessToken = $accessToken["access_token"];

        $query = "INSERT INTO AccessToken (accessToken, tokenSecret, service) VALUES(:accessToken, :tokenSecret, :service) ON DUPLICATE KEY UPDATE accessToken = VALUES(accessToken), tokenSecret = VALUES(tokenSecret)";
        $param = array(
            "accessToken" => $accessToken,
            "tokenSecret" => $tokenSecret,
            "service" => $this->name()
        );

        Session::set("accessToken", $accessToken, false);
        Session::set("tokenSecret", $tokenSecret, false);

        return $this->write($query, $param);
    }

    protected function retrieveAccessTokenFromDatabase() {
        $query = "SELECT accessToken, tokenSecret, service FROM AccessToken WHERE service = :service LIMIT 1";
        $param = array("service" => $this->name());

        return $this->read($query, $param);
    }

}
