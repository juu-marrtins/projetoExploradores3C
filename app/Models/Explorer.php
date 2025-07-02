<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Explorer extends Model
{
    protected $fillable = [
        'name',
        'age',
        'latitude',
        'longitude'
    ];  

    
    public function explorerSender(){
        return $this->belongsTo(Explorer::class, 'explorer_id_trader');
    }

    public function explorerReceiver(){
        return $this->belongsTo(Explorer::class, 'buyer_id_trader');
    }

    public function tradeItems(){
        return $this->hasMany(TradeItem::class, 'explorer_id_trader');
    }

    public function collectionLocations(){
        return $this->hasMany(ItemCollection::class);
    }

    public function inventory(){
        return $this->hasMany(Inventory::class, 'explorer_id_owner');
    }
}