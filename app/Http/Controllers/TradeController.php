<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Item;
use App\Models\Trade;
use App\Models\TradeItem;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'explorer_id_trader' => 'required|integer|exists:explorers,id',
            'explorer_id_buyer' => 'required|integer|exists:explorers,id',
            'item_id_trader' => 'required|integer|exists:items,id',
            'quantity_trader' => 'required|integer|min:1',
            'item_id_buyer' => 'required|integer|exists:items,id',
            'quantity_buyer' => 'required|integer|min:1'
        ]);
        
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

        Inventory::where('explorer_id_owner', $dataValidated['explorer_id_trader'])
                ->where('item_id', $dataValidated['item_id_trader'])
                ->decrement('quantity', $dataValidated['quantity_trader']); //drecrement usado para remover

        $inventoryReceiver = Inventory::where('explorer_id_owner', $dataValidated['explorer_id_buyer'])
                                    ->where('item_id', $dataValidated['item_id_trader'])
                                    ->first();

        if ($inventoryReceiver != null) {
            $inventoryReceiver->quantity = $inventoryReceiver->quantity + $dataValidated['quantity_trader'];
            $inventoryReceiver->save();
        } else {
            Inventory::create([
                'explorer_id_owner' => $dataValidated['explorer_id_buyer'],
                'item_id' => $dataValidated['item_id_trader'],
                'quantity' => $dataValidated['quantity_trader'],
            ]);
        }

        return response()->json(['message' => 'Troca realizada com sucesso.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request){
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
