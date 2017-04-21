<?php

/**
 * Database - uses pdo to connect to databse
 *
 * @author Mario Costa <mario@computech-it.co.uk>
 */
class Database {

    protected $stmt;

    /**
     * Makes the connection with the database
     * 
     * @return PDO instance
     */
    public function __construct() {

        include_once dirname(__FILE__) . '/../config.php';

        try {
            $this->pdo = new PDO('mysql:host=' . host . ';dbname=' . database . ';charset=UTF8', user, password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            $results['status'] = 'Error';
            $results['results'] = $e->getMessage();

            return $results;
        }
    }

    /**
     * Prepare query
     * @param string $query
     * @param array $fields
     * @param array $values
     * @param boolean $bind
     * @param boolean $fetch
     * @return array
     */
    public function prepareQuery($query, $fields = null, $values = null, $bind = false, $fetch = true) {

        $this->stmt = $this->pdo->prepare($query);

        if ($bind) {

            $fields = explode(',', $fields);

            for ($i = 0; $i < count($fields); $i++) {
                $this->bindParams($fields[$i], $values[$i]);
            }
        }
        return $this->executeQuery($fetch);
    }

    /**
     * Bind parameters
     * @param array $field
     * @param array $value
     */
    protected function bindParams($field, $value) {
       return $this->stmt->bindParam(':' . $field, $value);
    }

    /**
     * Execute query
     * @param boolean $fetch
     * @return array
     */
    protected function executeQuery($fetch) {
        try {
            $results = $this->stmt->execute();
        } catch (PDOException $e) {
            return($e->getMessage());
        }

        if ($fetch) {
            return ($this->fetchQuery());
        }
    }

    /**
     * Fetch data
     * @return array
     */
    protected function fetchQuery() {
        $results = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    /**
     * Get last inserted id
     * @return array
     */
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

}
