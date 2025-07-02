<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{

    protected $fillable = [
        'explorer_id_trader',
        'buyer_id_trader',
        'status'
    ]; 

    public function tradeItems(){
        return $this->hasMany(TradeItem::class);
    }

    public function explorerSender(){ 
        return $this->belongsTo(Explorer::class, 'explorer_id_trader');
    }

    public function explorerReceiver(){
        return $this->belongsTo(Explorer::class, 'buyer_id_trader');
    }

}