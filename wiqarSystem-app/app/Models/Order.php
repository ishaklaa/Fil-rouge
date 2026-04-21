<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id',
        'discount',
        'subtotal',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'tasks')->withPivot('quantity', 'created_at')->withTimestamps();
    }
}
