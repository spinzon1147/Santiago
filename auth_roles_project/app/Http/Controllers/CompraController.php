<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with('producto')->get();
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('compras.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Fecha_Com' => 'required',
            'Cant_Com' => 'required|integer|min:1',
            'Id_Prod_FK' => 'required'
        ]);

        $producto = Producto::findOrFail($request->Id_Prod_FK);

        $cantidad = $request->Cant_Com;

        // 💰 total automático (control interno)
        $total = $producto->Precio_pro * $cantidad;

        Compra::create([
            'Id_Prod_FK' => $request->Id_Prod_FK,
            'Cant_Com'   => $cantidad,
            'Valor_Com'  => $total,
            'Fecha_Com'  => $request->Fecha_Com,
        ]);

        // 📦 AUMENTAR STOCK
        $producto->Cant_pro += $cantidad;
        $producto->save();

        return redirect()->route('compras.index')
            ->with('success', 'Compra registrada y stock actualizado');
    }

    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $productos = Producto::all();

        return view('compras.edit', compact('compra', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);

        $productoAnterior = Producto::find($compra->Id_Prod_FK);

        // 🔁 revertir stock anterior
        if ($productoAnterior) {
            $productoAnterior->Cant_pro -= $compra->Cant_Com;
            $productoAnterior->save();
        }

        $productoNuevo = Producto::findOrFail($request->Id_Prod_FK);

        $cantidad = $request->Cant_Com;
        $total = $productoNuevo->Precio_pro * $cantidad;

        $compra->update([
            'Id_Prod_FK' => $request->Id_Prod_FK,
            'Cant_Com'   => $cantidad,
            'Valor_Com'  => $total,
            'Fecha_Com'  => $request->Fecha_Com,
        ]);

        // 📦 nuevo stock
        $productoNuevo->Cant_pro += $cantidad;
        $productoNuevo->save();

        return redirect()->route('compras.index')
            ->with('success', 'Compra actualizada correctamente');
    }

    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);

        $producto = Producto::find($compra->Id_Prod_FK);

        if ($producto) {
            $producto->Cant_pro -= $compra->Cant_Com;
            $producto->save();
        }

        $compra->delete();

        return redirect()->route('compras.index')
            ->with('success', 'Compra eliminada y stock actualizado');
    }
}