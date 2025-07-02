<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeItem extends Model
{
    protected $fillable = [
        'trade_id',
        'item_id',
        'explorer_id_trader',
        'quantity'
    ];

    public function trade(){
        return $this->belongsTo(Trade::class);
    }
    public function explorer(){
        return $this->belongsTo(Explorer::class, 'explorer_id_trader');
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
