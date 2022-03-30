<?php

namespace Database;
use mysqli;


class Database
{

    private $servername ='localhost';
    private $username = "root";
    private $password = "";
    private $dbname = "microtech";

   function __construct()
    {
        $conn = new mysqli($this->servername , $this->username, $this->password, $this->dbname);
        $conn->set_charset("utf8");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }


    function read($conn, $table)
    {
        $sql = "SELECT * FROM " . $table;
        return $result = $conn->query($sql);
    }

    function readPart($conn, $table, $columns, $values)
    {
        $sql = "SELECT * FROM " . $table . " WHERE ";
        for ($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . "='" . $values[$i] . "' AND ";
        }
        $sql = substr($sql, 0, strlen($sql) - 5);
        $sql .= ";";
        $result = $conn->query($sql);
        //echo $sql;
        return $result;
    }
}