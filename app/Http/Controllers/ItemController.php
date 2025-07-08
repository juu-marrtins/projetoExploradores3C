<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Inventory;
use App\Models\Item;

class ItemController extends Controller
{
    public function store(StoreItemRequest $request)
    {
        $dataValidated = $request->validated();

        $item = Item::createWithCollection([
            'name' => $dataValidated['name'],
            'value' => $dataValidated['value']], 
            [
            'explorer_id' => $dataValidated['explorer_id'],
            'latitude' => $dataValidated['latitude'],
            'longitude' => $dataValidated['longitude'],
            'quantity' => $dataValidated['quantity']
            ]);

        Inventory::create([
                'explorer_id_owner' => $dataValidated['explorer_id'],
                'item_id' => $item->id,
                'quantity' =>$dataValidated['quantity']
            ]);

        return response()->json($item, 201);
    }
}
