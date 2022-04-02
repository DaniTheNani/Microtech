<?php 
namespace App\Models;
use App\Model;
class Properties extends Model{
protected string $table = 'properties';

public array $attributes = [
    "id" => 'int',
    "name" => 'string'
];
}
?>
