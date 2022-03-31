<?php

namespace App\Models;

use App\Model;

class Categories extends Model
{
    protected string $table = 'categories';

    public array $attributes = [
        "id" => 'int',
        "name" => 'string'
    ];
}
