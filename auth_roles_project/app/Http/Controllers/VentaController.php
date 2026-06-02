<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        return view('ventas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Valor_Ven' => 'required',
            'Fecha_Ven' => 'required',
            'Cant_Ven'  => 'required'
        ]);

        Venta::create($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta registrada correctamente');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

    public function update(Request $request, string $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->update($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta actualizada correctamente');
    }

    public function destroy(string $id)
    {
        Venta::destroy($id);

        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada correctamente');
    }
}