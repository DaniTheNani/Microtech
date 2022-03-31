<?php

namespace App;

use PDO;

use PDOException;

include(__DIR__ . "/../config.php");
class Database
{

    private $dbhost = 'localhost';
    private $dbuser = "root";
    private $dbpassword = "";
    private $dbname = "microtech";
    private $dbc;

    function __construct()
    {
        try {
            $dsn = "mysql:host=" . $this->dbhost . ";port=3306" . ";dbname=" . $this->dbname;
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            $this->dbc = new PDO($dsn, $this->dbuser, $this->dbpassword, $options);
        } catch (PDOException $exc) {
            echo "Hiba: " . $exc->getMessage();
        }
    }


    public function read($table)
    {
        $sql = "SELECT * FROM " . $table;
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $data;
    }

    public function readOne($table, $id)
    {
        $sql = "SELECT * FROM  . $table. WHERE id =.$id.";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $data;
    }

    public function readFilter($table, $columns, $values)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        for ($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . "='" . $values[$i] . "' AND ";
        }
        $sql = substr($sql, 0, strlen($sql) - 5);
        $sql .= ";";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $data;
    }
    public function getItemByValue(string $table, string $column, string $value)
    {

        $sql = "SELECT * FROM " .  $table  . " WHERE " . $column . " =  '" . $value . "'";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $data;
    }
}
