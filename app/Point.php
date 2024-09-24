<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    public $fillable = [
        'points_for_one',
        'currency',
    ];
}
