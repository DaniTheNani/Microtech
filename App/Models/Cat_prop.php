<?php 
namespace App\Models;
use App\Model;
class Cat_prop{
protected string $table = 'cat_prop';

protected $attributes = [
    "prop_id" => 'int',
    "cat_id" => 'int'   
];
}
?>
