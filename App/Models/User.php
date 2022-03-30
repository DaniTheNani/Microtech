<?php 
namespace App\Models;
use App\Model;
class Components extends Model{
protected string $table = 'components';

protected $attributes = [
    "ID" => 'int',
    "username" => 'string',
    "password" => 'string',
    "email" => 'string',
    "fullname" => 'string',
    "permission" => 'string'
];
}
?>
