<?php

require_once __DIR__.'/../config.php';

class Database {

    private $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $database = DB_NAME;
    private $connection;

    // Constructor to create database connection
    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();die;
        }
    }

    // Destructor to close connection
    public function __destruct() {
        $this->connection = null;
    }

    // Method to insert data into a table
    public function insert($table, $data) {
        $keys = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array_values($data));
        return $stmt->rowCount();
    }

    // Method to update data in a table
    public function update($table, $data, $condition) {
        $set = [];
        foreach($data as $key => $value) {
            $set[] = "$key = ?";
        }
        $set = implode(',', $set);
        $sql = "UPDATE $table SET $set WHERE $condition";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array_values($data));
        return $stmt->rowCount();
    }

    // Method to delete data from a table
    public function delete($table, $condition) {
        $sql = "DELETE FROM $table WHERE $condition";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // Method to select data from a table
    public function select($table, $condition, $columns = "*") {
        $sql = "SELECT $columns FROM $table WHERE $condition";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to select all data from a table
    public function all($table, $columns = "*") {
        $sql = "SELECT $columns FROM $table";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}