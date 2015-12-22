<?php
use hyperion\core\Model;

class ExtendedModel extends Model {

    public function insertIntoTable($tableName = NULL, $columns = array(), $values = NULL, $onDuplicateColumns = NULL) {
        if ($tableName == NULL || $columns == array(NULL) || $values == NULL) {
            return false;
        }
        // Check if the array is a multidimensional one (which means multiple values want to be inserted into the database), that requires a bit of an effort to insert its shit into the database
        if (is_array($values[0])) {
            // Create the query with the columns
            $query = "INSERT INTO {$tableName} (" . implode(", ", $columns) . ") VALUES ";
            // Fill the VALUES clause with as many placeholders as needed, based on size of $values array and join the array to create the query 'INSERT INTO X (Col1, Col2, Col3 ...) VALUES (?,?,? ...), (?,?,? ...)'
            $value = array_fill(0, count($values), $this->createMarkers(count($values[0])));
            $query = $query . implode(",", $value);
            // Create the ON DUPLICATE clause if the duplicate parameter is set.
            if ($onDuplicateColumns !== NULL) {
                $query = $query . " ON DUPLICATE KEY UPDATE ";
                // The onDuplicateColumns can also be an array. It's crazy!
                if (is_array($onDuplicateColumns)) {
                    foreach($onDuplicateColumns as $key => $column) {
                        $query = $query . "{$column} = VALUES({$column})";

                        if ($key < count($onDuplicateColumns) - 1) {
                            $query = $query . ", ";
                        }
                    }
                } else {
                    $query = $query . "{$onDuplicateColumns} = VALUES({$onDuplicateColumns})";
                }
            }
            // Prepare the query and replace the placeholders created above with the actual values.
            $this->prepare($query);
            $this->bindParameters($columns, $values);
        } else {

        }

        // Let's do this! But, let's also be aware of problems, like responsible adults.
        $error = $this->write();
        return (isset($error["error"])) ? $error : true;
    }
    /**
     *  Returns a string containing N number of unnamed placeholders: (?,?, ...).
     *
     *  @param   integer    $count
     *  @param   bool       $withBrackets
     *  @return  string
     **/
    public function createMarkers($count = 0, $withBrackets = true) {
        $markers = array_fill(0, $count, "?");
        $markers = ($withBrackets) ? "(" . implode(",", $markers) . ")" : implode(", ", $markers);
        return $markers;
    }
    /**
     *  Binds the parameters in the SQL statement. Uses columns array to match the values.
     *
     *  @param   array      $columns
     *  @param   array      $values
     **/
    public function bindParameters($columns, $values) {
        // Position always starts at 1
        $position = 1;
        foreach($values as $key => $value) {
            // Matching the valyes by keynames from the column array makes sure that the right value always fills the right column.
            foreach($columns as $key => $column) {
                $this->bindValue($position++, $value[$column]);
            }
        }
    }

}
