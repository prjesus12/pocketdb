<?php

namespace Config;

use SQLite3;

class SQlite
{
    private $db;
    private static $instance;

    function __construct()
    {
        $this->db = new SQLite3($_ENV['DB_NAME']);

        if (!$this->db) {
            die("Error connecting to SQLite database");
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function __destruct() {
        $this->db->close();
    }

    function createTable($tableName, $columns)
    {
        $query = "CREATE TABLE IF NOT EXISTS $tableName ($columns)";
        $this->db->exec($query);
    }

    function dropTable($tableName)
    {
        $query = "DROP TABLE IF EXISTS $tableName ";
        $this->db->exec($query);
    }

    function alterColumns($tableName, $alterations) {
        foreach ($alterations as $alteration) {
            $this->db->exec("ALTER TABLE $tableName $alteration");
        }
    }

    function insert($tableName, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO $tableName ($keys) VALUES ($values)";
        $this->db->exec($query);
    }

    function select($tableName, $condition = null)
    {
        $query = "SELECT * FROM $tableName";
        if ($condition) {
            $query .= " WHERE $condition";
        }
        $result = $this->db->query($query);
        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function raw($query) {
        $result = $this->db->query($query);
        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    function update($tableName, $data, $condition)
    {
        $updates = [];
        foreach ($data as $key => $value) {
            $updates[] = "$key = '$value'";
        }
        $updates = implode(', ', $updates);
        $query = "UPDATE $tableName SET $updates WHERE $condition";
        $this->db->exec($query);
    }

    function delete($tableName, $condition)
    {
        $query = "DELETE FROM $tableName WHERE $condition";
        $this->db->exec($query);
    }

}
