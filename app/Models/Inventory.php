<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{   
        protected $fillable = [
            'explorer_id_owner',
            'item_id',
            'quantity'
        ]; 

    public static function store($explorer_id){ // vai permitir criar um inventario vazio
        return self::create([
            'explorer_id_owner' => $explorer_id,
            'item_id' => null,
            'quantity' => null
        ]);
    }

    public function items(){
        return $this->belongsToMany(Item::class);
    }

    public function explorer(){
        return $this->belongsTo(Explorer::class, 'explorer_id_owner');
    }
}