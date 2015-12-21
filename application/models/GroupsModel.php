<?php
use hyperion\core\Model;

class GroupsModel extends Model {

    public function fetchGroups() {
        $query = "SELECT id, name FROM Groups";
        $items = $this->read($query);

        return $items;
    }

    public function createGroup($data = NULL) {
        if ($data === NULL) {
            return FALSE;
        }

        $name = $data["name"];
        $desc = $data["description"];

        $query = "INSERT INTO Groups (id, name, description) VALUES (:name, :description)";
        $param = array(
            "name" => $name,
            "description" => $desc
        );

        $response = $this->write($query, $param);
        return $response;
    }

    public function updateGroup($data = NULL) {
        if ($data === NULL) {
            return FALSE;
        }

        $query = "UPDATE Groups SET name = :name WHERE id = :id";
        $param = array(
            "name" => $data["name"],
            "id" => $data["id"]
        );

        $response = $this->write($query, $param);

        return $response;
    }

}
