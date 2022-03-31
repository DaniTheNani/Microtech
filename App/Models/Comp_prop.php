<?php 
namespace App\Models;
use App\Model;
class Comp_prop extends Model{
protected string $table = 'comp_prop';

public array $attributes = [
    "comp_id" => 'int',
    "prop_id" => 'int',
    "value" => 'string'
];
}
?>
