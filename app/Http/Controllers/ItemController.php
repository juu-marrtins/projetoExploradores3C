<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'name' => 'required|min:3|max:255',
            'value' => 'required',
            'explorer_id' => 'required|exists:explorers,id',
            'latitude' => 'required|max:15|string',
            'longitude' => 'required|max:15|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $item = Item::createWithColletion([
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
