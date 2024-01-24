<?php
namespace Config;

class SqlBuilder
{
    private $query;

    public function select($columns, $table)
    {
        $this->query = "SELECT $columns FROM $table ";
        return $this;
    }



    public function where($condition)
    {
        $this->query .= " WHERE $condition";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->query .= " ORDER BY $column $direction";
        return $this;
    }

    public function delete($table)
    {
        $this->query = "DELETE FROM $table";
        return $this;
    }

    public function update($table, $data)
    {
        $values = $this->set($data);
        $this->query = "UPDATE $table $values ";
        return $this;
    }

    private function set($values)
    {
        $setClause = implode(', ', array_map(
            function ($key, $value) {
                return "$key = '$value'";
            },
            array_keys($values),
            array_values($values)
        )
        );

        return " SET $setClause";
    }

    public function insert($table, $data)
    {
        $values = $this->values($data);
        $this->query = "INSERT INTO $table $values";
        return $this;
    }

    private function values($values)
    {
        $columns = implode(', ', array_keys($values));
        $data = implode(', ', array_map(
            function ($value) {
                return "'$value'";
            },
            array_values($values)
        )
        );

        return " ($columns) VALUES ($data)";

    }

    public function append($data){
        $this->query .= " $data ";
        return $this;
    }

    public function innerJoin($table, $condition)
    {
        $this->query .= " INNER JOIN $table ON $condition";
        return $this;
    }

    public function leftJoin($table, $condition)
    {
        $this->query .= " LEFT JOIN $table ON $condition";
        return $this;
    }

    public function rightJoin($table, $condition)
    {
        $this->query .= " RIGHT JOIN $table ON $condition";
        return $this;
    }

    public function build()
    {
        return $this->query;
    }
}