<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;

class ProdutosController extends Controller
{
    function index() {
        return Produtos::all();
    }

    function show($id) {
        try{
            $produto = Produtos::findOrFail($id);
            return response()->json($produto, 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
    }

    function store(Request $request) {
        $produto = Produtos::create($request->all());
        return response()->json($produto, 201);
    }

    function update(Request $request, $id) {
        $produto = Produtos::findOrFail($id);
        $produto->update($request->all());
        return response()->json($produto, 200);
    }

    function delete($id) {
        Produtos::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
