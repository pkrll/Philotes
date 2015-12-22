<?php
use Twarpy\Twarpy;
use saturn\session\session;

class TwitterModel extends ServiceModel {

    protected function credentials() {
        return array(
            "consumer_key"      => kTwitterConsumerKey,
            "consumer_secret"   => kTwitterConsumerSecret,
            "access_token"      => $this->getAccessToken(),
            "token_secret"      => $this->getAccessToken(true)
        );
    }

    private function getAccessToken($secret = false) {
        if ($secret) {
            return Session::get("tokenSecret", false);
        }

        return Session::get("accessToken", false);
    }

    public function authenticate() {
        if ($this->credentials() == NULL) {
            return array(
                "error" => array(
                    "message" => "Credentials not set."
                )
            );
        }

        try {
            $Twarpy = new Twarpy($this->credentials(), THREE_LEGGED);
            $result = $Twarpy->getAccessToken();

            if (isset($result["error"])) {
                throw new Exception("Authorization failed: " . $result["error"]["message"]);
            } else if (empty($result["access_token"])) {
                throw new Exception("Authorization failed: Could not retrieve access token.");
            }

            $result = $this->storeAccessTokenInDatabase($result);

            if (isset($result["error"])) {
                throw new Exception("Authorization failed: " . $result["error"]["message"]);
            }
        } catch (Exception $error) {
            return array(
                "error" => array(
                    "message" => $error->getMessage()
                )
            );
        }
    }

    public function fetchListsFromDatabase() {

    }

    public function fetchListsFromTwitter() {
        $params = array("screen_name" => kTwitterScreenName);
        $twarpy = new Twarpy($this->credentials(), THREE_LEGGED);
        $result = $twarpy->request("lists/ownerships", "GET", $params);
        // Check for error before proceeding.
        if (isset($result["errors"])) {
            return $result;
        }
        // Loop through the list and retrieve just the information needed.
        $lists = array();
        foreach($result["lists"] as $key => $list) {
            $lists[$key]["id"] = $list["id"];
            $lists[$key]["name"] = $list["name"];
            $lists[$key]["slug"] = $list["slug"];
            $lists[$key]["description"] = $list["description"];
            $lists[$key]["memberCount"] = $list["member_count"];
            $lists[$key]["lastUpdated"] = time();
        }
        // Add or update the database
        $tableName = "TwitterLists";
        $allColumns = array("id", "slug", "name", "description", "memberCount", "lastUpdated");
        $dupColumns = array("slug", "name", "description", "memberCount", "lastUpdated");

        $response = $this->insertIntoTable($tableName, $allColumns, $lists, $dupColumns);

        if ($response !== true) {
            return $response;
        }

        return $lists;
    }



    public function fetchAccounts() {
    }

}
