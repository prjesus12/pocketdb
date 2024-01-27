<?php

namespace Config;

use PDO;
use PDOException;

class SQlite
{
    private $db;
    private static $instance;

    private function __construct()
    {
        try {
            $this->db = new PDO('sqlite:' . $_ENV['DB_NAME']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error connecting to SQLite database: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public function createTable($tableName, $columns)
    {
        $query = "CREATE TABLE IF NOT EXISTS $tableName ($columns)";
        $this->db->exec($query);
    }

    public function dropTable($tableName)
    {
        $query = "DROP TABLE IF EXISTS $tableName ";
        $this->db->exec($query);
    }

    public function alterColumns($tableName, $alterations)
    {
        foreach ($alterations as $alteration) {
            $this->db->exec("ALTER TABLE $tableName $alteration");
        }
    }

    public function insert($tableName, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $query = "INSERT INTO $tableName ($keys) VALUES ($values)";
        $stmt = $this->db->prepare($query);

        $i = 1;
        foreach ($data as $key => $value) {
            $stmt->bindValue($i++, $value);
        }

        return $stmt->execute();
    }

    public function select($tableName, $condition = null)
    {
        $query = "SELECT * FROM $tableName";
        if ($condition) {
            $query .= " WHERE $condition";
        }

        $stmt = $this->db->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function raw($query)
    {
        $stmt = $this->db->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function update($tableName, $data, $condition)
    {
        $updates = [];
        foreach ($data as $key => $value) {
            $updates[] = "$key = ?";
        }
        $updates = implode(', ', $updates);

        $query = "UPDATE $tableName SET $updates WHERE $condition";
        $stmt = $this->db->prepare($query);

        $i = 1;
        foreach ($data as $value) {
            $stmt->bindValue($i++, $value);
        }

        $stmt->execute();
    }

    public function delete($tableName, $condition)
    {
        $query = "DELETE FROM $tableName WHERE $condition";
        $this->db->exec($query);
    }
}
