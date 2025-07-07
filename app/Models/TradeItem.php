<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeItem extends Model
{
    protected $fillable = [
        'trade_id',
        'item_id_trader',
        'item_id_buyer',
        'quantity_trader',
        'quantity_buyer'
    ];

    public function trade(){
        return $this->belongsTo(Trade::class);
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }

}
