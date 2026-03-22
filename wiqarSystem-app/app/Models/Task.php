<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable =[
        'activity_id',
        'order_id',
    ];
}
