<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explorer;

class ExplorerController extends Controller
{
    public function index(string $id)
    {   
        $explorer = Explorer::with('inventories')->find($id); 

        if (!$explorer) {
            return response()->json(['message' => 'Explorador nao cadastrado'], 404);
        }

        return response()->json($explorer, 201);
    }

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
}