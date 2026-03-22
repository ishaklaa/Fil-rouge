<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['name',
        'user_id',];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
