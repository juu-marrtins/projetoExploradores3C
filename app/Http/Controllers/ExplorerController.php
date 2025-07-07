<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explorer;

class ExplorerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {   
        $explorer = Explorer::with('inventories')->find($id); 
        //acha as linhas em inventarios e explorer onde o id seja o que foi passado na rota

        if (!$explorer) {
            return response()->json(['message' => 'Explorador nao cadastrado'], 404);
        }

        return response()->json($explorer, 201);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'name' => 'required|min:3|max:50',
            'age' => 'required|integer',
            'latitude' => 'required|max:15|string',
            'longitude' => 'required|max:15|string'
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
            return response()
            ->json(['message' => 'Explordor nao cadastrado no sistema.'], 201);
        }
        $data = $request->only('latitude', 'longitude');

        $data['longitude'] = $request->longitude;
        $data['latitude'] = $request->latitude;
        $explorer->update($data);

        return response()->json(['success' => 'Explorer atualizado com sucesso.'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}