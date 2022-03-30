<?php

namespace App;

use App\Database;

class Model
{
    protected string $table;

    protected $primaryKey = 'id';

    protected array $attributes;

    protected static Database $DB;

    function __construct($param = null)
    {
        if ($param) $this->create($param);

        self::$DB = new Database;
    }

     public function all(){
        global $conn;
        $modelArray = array();
        $query = self::$DB->read($conn,$this->table);

        $modelArray = $this->createCollection($query);

        return $modelArray;
     }
    public function createCollection(array $query): array
    {
        $modelArray = array();

        $modelClass = get_class($this);

        $refl = new \ReflectionClass($modelClass);

        foreach ($query as $item) {
            array_push($modelArray, new $refl->name($item));
        }
        return $modelArray;
    }
    public function create($attributes){
        $this->$attributes = $attributes;
        return $this;
    }
    public function getItemById(int $id)
    {
        global $conn;

        $result = self::$DB->readOne($conn,$this->table, $id);

        if (!isset($result["id"])) {
            $result = $result[0];
        }

        return $this->create($result);
    }

    public function getItemBy(string $column, string $value)
    {
        global $conn;

        $result = self::$DB->getItemByValue($conn,$this->table, $column, $value);
        if ($result) {
            return $this->create($result[0]);
        } else {
            return false;
        }
    }

    public function getItemsBy(string $column, string $value)
    {
        global $conn;
        $query = self::$DB->getItemByValue($conn,$this->table, $column, $value);
        $collection = array();
        $collection = $this->createCollection($query);
        if ($collection) {
            return $collection;
        } else {
            return false;
        }
    }
}
    

?>