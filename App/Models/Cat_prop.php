<?php 
namespace App\Models;
use App\Model;
class Cat_prop extends Model{
protected string $table = 'cat_prop';

public array $attributes = [
    "prop_id" => 'int',
    "cat_id" => 'int'
];
}
