<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validade = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create($validade);

            return response()->json($user, 201);
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Dados inválidos', 'details' => $e->errors()], 422);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Erro no banco de dados', 'details' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar o usuario'], 501);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuario não encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validade = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255',
                'password' => 'sometimes|required|string|min:8',
            ]);

            $user = User::findOrFail($id);
            $user->update($validade);

            return response()->json($user, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Dados inválidos', 'details' => $e->errors()], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Erro no banco de dados', 'details' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o usuario'], 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar o usuario'], 501);
        }
    }
}
