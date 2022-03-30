<?php

namespace App;

use mysqli;


class Database
{

    private $servername = 'localhost';
    private $username = "root";
    private $password = "";
    private $dbname = "microtech";

    function __construct()
    {
        global $conn;
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $conn->set_charset("utf8");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }


    public function read($conn, $table)
    {
        $sql = "SELECT * FROM " . $table;
        return $result = $conn->query($sql);
    }

    public function readOne($conn, $table, $id)
    {
        $sql = "SELECT * FROM  . $table. WHERE id =.$id.";
        return $result = $conn->query($sql);
    }

    public    function readFilter($conn, $table, $columns, $values)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        for ($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . "='" . $values[$i] . "' AND ";
        }
        $sql = substr($sql, 0, strlen($sql) - 5);
        $sql .= ";";
        $result = $conn->query($sql);
        return $result;
    }
    public function getItemByValue($conn,string $table, string $column, string $value)
    {

            $sql = "SELECT * FROM " .  $table  . " WHERE " . $column . " =  '" . $value . "'";
            return $result = $conn->query($sql);
         
            
      
    }
 
    
}
