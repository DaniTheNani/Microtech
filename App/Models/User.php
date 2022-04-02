<?php

namespace App\Models;

use App\Model;

class User extends Model
{
    protected string $table = 'users';

    public array $attributes = [
        "ID" => 'int',
        "username" => 'string',
        "password" => 'string',
        "email" => 'string',
        "fullname" => 'string',
        "permission" => 'string',
    ];
}
