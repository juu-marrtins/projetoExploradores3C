<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryRequest;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function store(StoreInventoryRequest $request)
    {
        $dataValidated = $request->validated();

        $inventory = Inventory::create($dataValidated);
        return response()->json($inventory, 201);
    }
}
