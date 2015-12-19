<?php
use hyperion\core\Model;

class GroupsModel extends Model {

    public function fetchGroups() {
        $query = "SELECT id, name FROM Groups";
        $items = $this->read($query);

        return $items;
    }

}
