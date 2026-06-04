<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
          'Nom_pro' => 'required',
         'Cant_pro' => 'required',
            'Precio_pro' => 'required|numeric',
'Estado_pro' => 'required',
    'Descrip_pro' => 'nullable'
]);

        Producto::create($request->all());

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto registrado correctamente');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, string $id)
{
$request->validate([
'Nom_pro' => 'required',
'Cant_pro' => 'required',
'Precio_pro' => 'required|numeric',
'Estado_pro' => 'required',
'Descrip_pro' => 'nullable'
]);

$producto = Producto::findOrFail($id);

$producto->update($request->all());

return redirect()
    ->route('productos.index')
    ->with('success', 'Producto actualizado correctamente');

}

    public function destroy($id)
{
    $producto = Producto::findOrFail($id);

    if ($producto->ventas()->count() > 0) {
        return back()->with('error', 'No se puede eliminar: tiene ventas registradas');
    }

    if ($producto->compras()->count() > 0) {
        return back()->with('error', 'No se puede eliminar: tiene compras registradas');
    }

    $producto->delete();

    return back()->with('success', 'Producto eliminado correctamente');
}
}