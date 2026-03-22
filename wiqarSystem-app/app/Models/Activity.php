<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['reserved','is_available','price','title',];
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
