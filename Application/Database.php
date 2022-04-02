<?php


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
        var_dump($data);
        var_dump($stmt);
        return $data;
    }

    public function getColumnName($table)
    {
        $sql = "SHOW COLUMNS FROM " . $table;
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $data;
    }

    public function getNoKeyColumnName($table)
    {
        $column = $this->getColumnName($table);
        $sql = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY';";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $column = array_diff($column, [$data[0]['Column_name']]);
        return $column;
    }

    public function insert($table, $data)
    {
        $colName = $this->getNoKeyColumnName($table);
        $sql = "INSERT INTO " . $table . " ( ";
        foreach ($colName as $col) {
            if ($col <> end($colName)) {
                $sql .= $col . ", ";
            } else {
                $sql .= $col . " ) ";
            }
        }
        $sql .= "VALUES ( ";
        foreach ($colName as $col) {
            if ($col <> end($colName)) {
                $sql .= "'" . $data["$col"] . "', ";
            } else {
                $sql .= "'" . $data["$col"] . "' ) ";
            }
        }
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
    }
}