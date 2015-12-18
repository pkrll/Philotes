<?php
/**
 * The base Model class holds the database connection
 * and methods along with a standard method for error
 * message creation.
 *
 * @author Ardalan Samimi
 * @version 1.0.2
 */
namespace hyperion\core;
use hyperion\library\Database;
use \PDO;

class Model {

    /**
     * The database object is private and should be accessed
     * by the database connection methods by all children.
     *
     * @var Database
     * @access private
     **/
    private $database;

    /**
     * Creates the database connection.
     *
     **/
    public function __construct() {
        if (!empty(HOSTNAME) && !empty(DATABASE) && !empty(USERNAME) && !empty(PASSWORD))
            $this->database = new Database(HOSTNAME, DATABASE, USERNAME, PASSWORD);
        else
            $this->database = NULL;
    }

    /**
     * Executes an SQL query string.
     *
     * @param   string  Optional. The SQL query to execute.
     * @param   array   Optional. Additional parameters to
     *                  supply to the query.
     * @return  array | bool
     */
    private function execute($query = NULL, $params = NULL) {
        if ($this->database === NULL)
            return $this->errorMessage("No database connection found.");
        if ($query !== NULL)
            $this->database->prepare($query);
        // Execute the query, but brace for errors.
        $error = $this->database->execute($params);
        if ($error !== NULL)
            return $this->errorMessage($error);
        return TRUE;
    }

    /**
     * Prepare an SQL statement for execution.
     *
     * @param   string  The SQL statement to prepare.
     */
    final protected function prepare($query) {
        if ($this->database === NULL)
            return $this->errorMessage("No database connection found.");
        $this->database->prepare($query);
    }

    /**
     * Bind a value to a named or question mark placeholder
     * in the prepared SQL statement.
     *
     * @param   mixed   The parameter identifier. For named
     *                  placeholder, this value must be a
     *                  string (:name). For a question mark
     *                  placeholder, the value must be the
     *                  1-indexed position of the parameter.
     * @param   mixed   The value to bind to the parameter.
     * @param   int     Data type for the parameter, using
     *                  the predefined PDO constants:
     *                  http://php.net/manual/en/pdo.constants.php
     * @return  bool
     */
    final protected function bindValue($param, $value, $dataType = PDO::PARAM_STR) {
        if ($this->database === NULL)
            return $this->errorMessage("No database connection found.");
        return $this->database->bindvalue($param, $value, $dataType);
    }

    /**
     * Bind a referenced variable to a named or question mark
     * placeholder in the prepared SQL statement.
     *
     * @param   mixed   The parameter identifier. For named
     *                  placeholder, this value must be a
     *                  string (:name). For a question mark
     *                  placeholder, the value must be the
     *                  1-indexed position of the parameter.
     * @param   mixed   Variable to bind to the parameter.
     * @param   int     Data type for the parameter, using
     *                  the predefined PDO constants:
     *                  http://php.net/manual/en/pdo.constants.php
     * @return  bool
     */
    final protected function bindParam($param, &$value, $dataType = PDO::PARAM_STR) {
        if ($this->database === NULL)
            return $this->errorMessage("No database connection found.");
        return $this->database->bindParam($param, $value, $dataType);
    }

    /**
     * Run the supplied query. Only for fetching rows from
     * the database.
     *
     * @param   string  Optional. The SQL query to execute.
     * @param   array   Optional. Additional parameters to
     *                  supply to the query.
     * @param   bool    If true, fetches all matching rows.
     *                  Defaults to TRUE.
     * @return  array
     **/
    final protected function read($query = NULL, $params = NULL, $fetchAll = TRUE) {
        $execution = $this->execute($query, $params);
        if ($execution !== TRUE)
            return $execution;
        if ($fetchAll)
            return $this->database->fetchAll();
        return $this->database->fetch();
    }

    /**
     * Run the supplied query. Only for adding rows to the
     * the database.
     *
     * @param   string  Optional. The SQL query to execute.
     * @param   array   Optional. Additional parameters to
     *                  supply to the query.
     * @return  array
     **/
    final protected function write($query = NULL, $params = NULL) {
        $execution = $this->execute($query, $params);
        if ($execution !== TRUE)
            return $execution;
        return $this->database->lastInsertId();
    }

    /**
     * Return the number of rows affected by the last SQL
     * statement performed.
     *
     * @return  int
     */
    final protected function rowCount() {
        if ($this->database === NULL)
            return $this->errorMessage("No database connection found.");
        return $this->database->rowCount();
    }

    /**
     * Create an error message.
     *
     * @param   string  The error message.
     * @return  array
     */
    final protected function errorMessage($message) {
        return array(
            "error" => array("message" => $message)
        );
    }

}
