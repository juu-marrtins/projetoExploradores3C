<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'value'
    ];

    public function tradeItems(){
        return $this->hasMany(TradeItem::class);
    }

    public function collectionLocations(){
        return $this->hasMany(ItemCollection::class);
    }

    public function inventories(){
        return $this->hasMany(Inventory::class);
    }
}