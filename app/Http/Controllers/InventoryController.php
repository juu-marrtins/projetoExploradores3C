<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'explorer_id_owner' => 'required',
            'item_id' => 'integer|min:1',
            'quantity' => 'integer|min:1'
        ]);

        $inventory = Inventory::create($dataValidated);
        return response()->json($inventory, 201);
    }
}
