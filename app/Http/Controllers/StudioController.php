<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Studio::query();
        $search = false;

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $studios = $query->paginate(10);

        return view('studios.index', compact('studios', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do usuário
        $request->validate([
            'name' => 'required',
            'address' => 'required|max:250',
            'email' => 'required|email|unique:studios,email',
            'phone' => 'required|string|max:20'
        ]);

        Studio::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return redirect()->route('studios.index')->with('success', 'Estúdio cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studio = Studio::findOrFail($id);

        return view('studios.edit', compact('studio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $studio = Studio::findOrFail($id);

        // Validação dos dados do usuário
        $validation_data = [
            'name' => 'required',
            'address' => 'required|max:250',
            'phone' => 'required|string|max:20'
        ];

        if ($request->email != $studio->email) {
            $validation_data['email'] = 'required|email|unique:studios,email';
        }

        $request->validate($validation_data);


        $studio->update([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return redirect()->route('studios.index')->with('success', 'Estúdio atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $studio = Studio::findOrFail($id);
            $studio->delete();

            return redirect()->route('studios.index')->with('success', 'Estúdio deletado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('studios.index')->with('error', 'Erro ao deletar o estúdio.');
        }
    }
}
