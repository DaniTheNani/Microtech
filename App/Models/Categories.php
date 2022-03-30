<?php 

namespace App\Models;
include "../Model.php";
use App\Model;
class Categories extends Model{
protected string $table = 'categories';

protected $attributes = [
    "id" => 'int',
    "name" => 'string'
];
}
