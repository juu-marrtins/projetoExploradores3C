<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTradeRequest;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Trade;
use App\Models\TradeItem;

class TradeController extends Controller
{
    public function store(StoreTradeRequest $request)
    {
        $dataValidated = $request->validated();
        
        if($dataValidated['explorer_id_trader'] == $dataValidated['explorer_id_buyer']){
            return response()->json(['message' => 'Os Exploradores nao podem ser iguais']);
        }
        $traderItem = Item::find($dataValidated['item_id_trader']);
        $buyerItem = Item::find($dataValidated['item_id_buyer']);

        $trader_value = $traderItem->value * $dataValidated['quantity_trader'];
        $buyer_value = $buyerItem->value * $dataValidated['quantity_buyer'];

        if ($trader_value != $buyer_value) {
            return response()->json(['message' => 'Troca com valor não equivalente.']);
        }       

        $trade = Trade::create([
            'explorer_id_trader' => $dataValidated['explorer_id_trader'],
            'explorer_id_buyer' => $dataValidated['explorer_id_buyer']
        ]);

        TradeItem::create([
            'trade_id' => $trade->id,
            'item_id_trader' => $dataValidated['item_id_trader'],
            'item_id_buyer' => $dataValidated['item_id_buyer'],
            'quantity_trader' => $dataValidated['quantity_trader'],
            'quantity_buyer' => $dataValidated['quantity_buyer'],
        ]);

        $inventoryTrader = Inventory::where('explorer_id_owner', $dataValidated['explorer_id_trader'])
                                ->where('item_id', $dataValidated['item_id_trader'])
                                ->first();

        if (!$inventoryTrader || $inventoryTrader->quantity < $dataValidated['quantity_trader']) {
            return response()->json(['message' => 'O trader não possui quantidade suficiente do item.']);
        }

        $inventoryBuyer = Inventory::where('explorer_id_owner', $dataValidated['explorer_id_buyer'])
                                ->where('item_id', $dataValidated['item_id_buyer'])
                                ->first();
        if (!$inventoryBuyer || $inventoryBuyer->quantity < $dataValidated['quantity_buyer']) {
            return response()->json(['message' => 'O buyer não possui quantidade suficiente do item.']);
        }

        Inventory::where('explorer_id_owner', $dataValidated['explorer_id_trader'])
                ->where('item_id', $dataValidated['item_id_trader'])
                ->decrement('quantity', $dataValidated['quantity_trader']); //drecrement usado para remover

        $inventoryReceiver = Inventory::where('explorer_id_owner', $dataValidated['explorer_id_buyer'])
                                    ->where('item_id', $dataValidated['item_id_trader'])
                                    ->first();

        if ($inventoryReceiver != null) {
            $inventoryReceiver->quantity = $inventoryReceiver->quantity + $dataValidated['quantity_trader'];
            $inventoryReceiver->save(); // db
        } else {
            Inventory::create([
                'explorer_id_owner' => $dataValidated['explorer_id_buyer'],
                'item_id' => $dataValidated['item_id_trader'],
                'quantity' => $dataValidated['quantity_trader'],
            ]);
        }

        Inventory::where('explorer_id_owner', $dataValidated['explorer_id_buyer'])
                ->where('item_id', $dataValidated['item_id_buyer'])
                ->decrement('quantity', $dataValidated['quantity_buyer']);

        $inventoryReceiverTrader = Inventory::where('explorer_id_owner', $dataValidated['explorer_id_trader'])
                                        ->where('item_id', $dataValidated['item_id_buyer'])
                                        ->first();
        if ($inventoryReceiverTrader != null) {
            $inventoryReceiverTrader->quantity += $dataValidated['quantity_buyer'];
            $inventoryReceiverTrader->save(); //db
        } else {
            Inventory::create([
                'explorer_id_owner' => $dataValidated['explorer_id_trader'],
                'item_id' => $dataValidated['item_id_buyer'],
                'quantity' => $dataValidated['quantity_buyer'],
            ]);                                   
            return response()->json(['message' => 'Troca realizada com sucesso.'], 201);
        }
    }      
}