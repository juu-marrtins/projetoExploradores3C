<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExploreRequest;
use App\Http\Requests\UpdateExplorerRequest;
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

    public function store(StoreExploreRequest $request)
    {
        $dataValidated = $request->validated(); 

        $explorer = Explorer::create($dataValidated);

        return response()->json($explorer, 201);
    }

    public function update(UpdateExplorerRequest $request, string $id){
        if(!$explorer = Explorer::find($id)){
            return response()
            ->json(['message' => 'Explordor nao cadastrado no sistema.'], 201);
        }
        $data = $request->validated();
        $explorer->update($data);

        return response()->json(['success' => 'Explorer atualizado com sucesso.'], 201);
    }
}