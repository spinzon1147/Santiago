<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        return view('compras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Valor_Com' => 'required',
            'Fecha_Com' => 'required',
            'Cant_Com' => 'required'
        ]);

        Compra::create($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra registrada correctamente');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $compra = Compra::findOrFail($id);

        return view('compras.edit', compact('compra'));
    }

    public function update(Request $request, string $id)
    {
        $compra = Compra::findOrFail($id);

        $compra->update($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra actualizada correctamente');
    }

    public function destroy(string $id)
    {
        Compra::destroy($id);

        return redirect()->route('compras.index')
            ->with('success', 'Compra eliminada correctamente');
    }
}