<?php
/**
 * A wrapper class for the PDO class.
 * The database driver used: MySQL.
 *
 * @author Ardalan Samimi
 * @version 1.0.2
 */
namespace hyperion\library;
use \PDO;
use \PDOException;

class Database {

    /**
     * The PDO object.
     *
     * @var PDO
     * @access private
     **/
    private $connection;

    /**
     * The PDO statement.
     *
     * @var PDOStatement
     * @access private
     **/
    private $statement;

    /**
     * Create the PDO instance and set the defaults attributes
     * on the database handle.
     *
     * @param   string  Database hostname.
     * @param   string  Database name.
     * @param   string  Username.
     * @param   string  Password.
     */
    public function __construct($hostname, $database, $username, $password) {
        try {
            $this->connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Could not connect to database: " . $e->getMessage());
        }
    }

    /**
     * Return an array of error information about the last
     * performed operation.
     *
     * @param   bool    Value determines if the errorInfo should
     *                  be performed on the database handle or
     *                  the statement handle.
     * @return  array
     */
    public function error($connection = TRUE) {
        if ($connection)
            return $this->connection->errorInfo();
        return $this->statement->errorInfo();
    }

    /**
     * Execute the prepared SQL statement.
     *
     * @param   array  Optional. The input parameters.
     * @return  mixed
     */
    public function execute($params = NULL) {
        try {
            $this->statement->execute($params);
        } catch (PDOException $error) {
            return $error->getMessage();
        }
        return NULL;
    }

    /**
     * Fetch all the rows in the result set.
     *
     * @param   int     Optional. Value controls how the row
     *                  should be returned. The value must be
     *                  one of the FETCH_* constants. Defaults
     *                  to: FETCH_ASSOC.
     * @return  mixed
     */
    public function fetchAll($flags = PDO::FETCH_ASSOC) {
        return $this->statement->fetchAll($flags);
    }

    /**
     * Fetch the next row in the result set.
     *
     * @param   int     Optional. Value controls how the row
     *                  should be returned. The value must be
     *                  one of the FETCH_* constants. Defaults
     *                  to: FETCH_ASSOC.
     * @return  mixed
     */
    public function fetch($flags = PDO::FETCH_ASSOC) {
        return $this->statement->fetch($flags);
    }

    /**
     * Prepares a statement for execution.
     *
     * @param   string  The SQL string.
     * @return  bool
     */
    public function prepare($query) {
        $this->statement = $this->connection->prepare($query);
        if ($this->statement === FALSE)
            return $this->error();
        return TRUE;
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
    public function bindValue($param, $value, $dataType) {
		$response = $this->statement->bindValue($param, $value, $dataType);
		return $response;
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
    public function bindParam($param, &$variable, $dataType) {
		$response = $this->statement->bindParam($param, $variable, $dataType);
		return $response;
	}

    /**
     * Number of rows affected by last operation.
     *
     * @return  int
     */
    public function rowCount() {
        return $this->statement->rowCount();
    }

    /**
     * Return the id of last inserted row.
     *
     * @return  int
     */
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }

}
