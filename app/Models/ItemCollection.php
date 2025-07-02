<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCollection extends Model
{
    protected $fillable = [ 
        'explorer_id',
        'item_id',
        'quantity',
        'latitude',
        'longitude'
    ];
    
    public function explorer(){
        return $this->belongsTo(Explorer::class);
    }
    public function items(){
        return $this->belongsToMany(Item::class);
    }
}
