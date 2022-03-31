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
        $modelArray = array();
        $query = self::$DB->read($this->table);

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
        $result = self::$DB->readOne($this->table, $id);

        if (!isset($result["id"])) {
            $result = $result[0];
        }

        return $this->create($result);
    }

    public function getItemBy(string $column, string $value)
    {

        $result = self::$DB->getItemByValue($this->table, $column, $value);
        if ($result) {
            return $this->create($result[0]);
        } else {
            return false;
        }
    }

    public function getItemsBy(string $column, string $value)
    {
        $query = self::$DB->getItemByValue($this->table, $column, $value);
        $collection = array();
        $collection = $this->createCollection($query);
        if ($collection) {
            return $collection;
        } else {
            return false;
        }
    }
}
