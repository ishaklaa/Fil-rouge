<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','business_id',];
    public function business (){
        return $this->belongsTo(Business::class);
    }
    public function users (){
        return $this->hasMany(User::class);
    }
}
