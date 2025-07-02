<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explorer;

class ExplorerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $explorers = Explorer::all();
        return view('explorers.index', compact('explorers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'name' => 'required|min:3|max:50',
            'age' => 'required|integer',
            'latitude' => 'required|max:15',
            'longitude' => 'required|max:15'
        ]); 

        $explorer = Explorer::create($dataValidated);
        return response()->json($explorer, 201);
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
    public function update(Request $request, string $id){
        if(!$explorer = Explorer::find($id)){
            //
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}