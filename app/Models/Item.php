<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'value'
    ];

    public static function createWithColletion(array $itemData, array $collectionData){
        $item  = self::create($itemData);

        ItemCollection::create([
            'explorer_id' => $collectionData['explorer_id'],
            'item_id' => $item->id,
            'quantity' => $collectionData['quantity'],
            'latitude' => $collectionData['latitude'],
            'longitude' => $collectionData['longitude']
        ]);

        return $item;
    }
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