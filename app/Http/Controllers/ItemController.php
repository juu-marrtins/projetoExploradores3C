<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
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

        return response()->json($item, 201);
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
    public function update(Request $request, string $id)
    {
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
