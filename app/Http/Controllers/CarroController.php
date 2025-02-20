<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $carros = Carro::when($search, function ($query, $search) {
            return $query->where('marca', 'like', '%' . $search . '%')
                ->orWhere('modelo', 'like', '%' . $search . '%');
        })
            ->paginate(8);

        return view('carros.index', compact('carros', 'search'));
    }

    public function create()
    {
        return view('carros.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'año' => 'required|integer',
            'color' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        Carro::create($validatedData);

        return redirect()->route('carros.index')->with('success', 'Carro agregado con éxito');
    }


    public function show(Carro $carro)
    {
        return view('carros.show', compact('carro'));
    }

    public function edit(Carro $carro)
    {
        return view('carros.edit', compact('carro'));
    }

    public function update(Request $request, Carro $carro)
    {
        $validatedData = $request->validate([
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'año' => 'required|integer',
            'color' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        $carro->update($validatedData);

        return redirect()->route('carros.index')->with('success', 'Carro actualizado con éxito');
    }

    public function destroy(Carro $carro)
    {
        $carro->delete();
        return redirect()->route('carros.index')->with('success', 'Carro eliminado');
    }
}
