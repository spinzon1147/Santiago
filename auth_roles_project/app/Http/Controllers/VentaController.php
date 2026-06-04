<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $producto = Producto::findOrFail($request->Id_Prod_FK);

        $cantidad = $request->Cant_Ven;

        if ($producto->Cant_pro < $cantidad) {
            return back()->with('error', 'Stock insuficiente. Solo hay ' . $producto->Cant_pro);
        }

        $total = $producto->Precio_pro * $cantidad;

        $venta = Venta::create([
            'Id_Prod_FK' => $request->Id_Prod_FK,
            'Cant_Ven'   => $cantidad,
            'Total_Ven'  => $total,
            'Fecha_Ven'  => $request->Fecha_Ven,
        ]);

        $producto->Cant_pro -= $cantidad;
        $producto->save();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta registrada correctamente');
    }

    public function show(string $id)
    {
        $venta = Venta::with('producto')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    public function edit(string $id)
    {
        $venta = Venta::findOrFail($id);
        $productos = Producto::all();

        return view('ventas.edit', compact('venta', 'productos'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'Fecha_Ven'  => 'required|date',
            'Cant_Ven'   => 'required|integer|min:1',
            'Id_Prod_FK' => 'required|exists:producto,Id_pro'
        ]);

        $venta = Venta::findOrFail($id);

        // devolver stock anterior
        $productoAnterior = Producto::find($venta->Id_Prod_FK);
        if ($productoAnterior) {
            $productoAnterior->Cant_pro += $venta->Cant_Ven;
            $productoAnterior->save();
        }

        $productoNuevo = Producto::findOrFail($request->Id_Prod_FK);

        if ($productoNuevo->Cant_pro < $request->Cant_Ven) {
            return back()->with('error', 'Stock insuficiente');
        }

        $total = $productoNuevo->Precio_pro * $request->Cant_Ven;

        $venta->update([
            'Id_Prod_FK' => $request->Id_Prod_FK,
            'Cant_Ven'   => $request->Cant_Ven,
            'Total_Ven'  => $total,
            'Fecha_Ven'  => $request->Fecha_Ven,
        ]);

        $productoNuevo->Cant_pro -= $request->Cant_Ven;
        $productoNuevo->save();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta actualizada correctamente');
    }

    public function destroy(string $id)
    {
        $venta = Venta::findOrFail($id);

        $producto = Producto::find($venta->Id_Prod_FK);
        if ($producto) {
            $producto->Cant_pro += $venta->Cant_Ven;
            $producto->save();
        }

        $venta->delete();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada correctamente');
    }
    
}