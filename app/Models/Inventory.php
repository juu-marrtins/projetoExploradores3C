<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{   
    protected $fillable = [
        'explorer_id',
        'item_id',
        'quantity'
    ]; 

    public function items(){
        return $this->belongsToMany(Item::class);
    }

    public function explorer(){
        return $this->belongsTo(Explorer::class, 'explorer_id_owner');
    }
}