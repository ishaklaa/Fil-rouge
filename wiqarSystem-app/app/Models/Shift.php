<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $casts = [
        'ends_at' => 'datetime',
    ];
    protected $fillable = ['user_id','ends_at'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
