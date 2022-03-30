<?php 
namespace App\Models;
use App\Model;
class Components extends Model{
protected string $table = 'components';

protected $attributes = [
    "id" => 'int',
    "name" => 'string',
    "cat_id" => 'int',
    "image" => 'string'
];
}
?>
