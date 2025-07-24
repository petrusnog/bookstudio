<?php

namespace App\Http\Controllers;

use App\Models\Availability;
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
        try {
            // Studio data validation
            $request->validate([
                'name' => 'required',
                'address' => 'required|max:250',
                'email' => 'required|email|unique:studios,email',
                'phone' => 'required|string|max:20',
                'availabilities' => 'required|array|min:1',
                'availabilities.*.weekdays' => 'required|array|min:1',
                'availabilities.*.open_time' => 'required|date_format:H:i',
                'availabilities.*.close_time' => 'required|date_format:H:i'
            ]);

            $studio = Studio::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            foreach ($request->availabilities as $request_avl) {
                $availability = Availability::create([
                    'studio_id' => $studio->id,
                    'weekdays' => json_encode($request_avl['weekdays']),
                    'open_time' => $request_avl['open_time'],
                    'close_time' => $request_avl['close_time']
                ]);
            }

            return redirect()->route('studios.index')->with('success', 'Estúdio cadastrado com sucesso.');

        } catch (\Exception $e) {
            if (isset($studio)) {
                $studio->delete();
            }

            if (isset($availability)) {
                $availability->delete();
            }

            return redirect()->route('studios.index')->with('error', $e->getMessage());
        }
    }

    // public function debug()
    // {
    //     $request = new \Illuminate\Http\Request([
    //         'name' => 'Studio Teste',
    //         'address' => 'Rua Fictícia, 123',
    //         'email' => 'teste@example.com',
    //         'phone' => '85999999999',
    //         'availabilities' => [
    //             [
    //                 'weekdays' => ['monday', 'tuesday'],
    //                 'open_time' => '10:00',
    //                 'close_time' => '18:00',
    //             ]
    //         ]
    //     ]);

    //     return $this->store($request);
    // }

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
        $availabilities = $studio->availabilities;

        return view('studios.edit', compact('studio', 'availabilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
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


            foreach ($request->availabilities as $request_avl) {
                if (array_key_exists('id', $request_avl)) {
                    $availability = Availability::findOrFail($request_avl['id']);
                    $availability->update([
                        'weekdays' => json_encode($request_avl['weekdays']),
                        'open_time' => $request_avl['open_time'],
                        'close_time' => $request_avl['close_time']
                    ]);
                } else {
                    $availability = Availability::create([
                        'studio_id' => $studio->id,
                        'weekdays' => json_encode($request_avl['weekdays']),
                        'open_time' => $request_avl['open_time'],
                        'close_time' => $request_avl['close_time']
                    ]);
                }
            }

            return redirect()->route('studios.index')->with('success', 'Estúdio atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('studios.index')->with('error', $e->getMessage());
        }
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
