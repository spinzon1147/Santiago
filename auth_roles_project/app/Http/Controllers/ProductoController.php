<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(Request $request): View
    {
        $query = Producto::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('Nom_pro', 'like', "%{$search}%");
        }

        $productos = $query->orderBy('Nom_pro')->get();

        return view('productos.index', compact('productos'));
    }

    public function create(): View
    {
        return view('productos.create');
    }

    public function store(StoreProductoRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['Cant_pro'] = $data['Cant_pro'] ?? 0;
        $data['Estado_pro'] = $data['Estado_pro'] ?? ($data['Cant_pro'] > 0 ? 'Disponible' : 'Agotado');

        Producto::create($data);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto registrado correctamente');
    }

    public function edit(string $id): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para modificar productos.');
        }

        $producto = Producto::findOrFail($id);

        return view('productos.edit', compact('producto'));
    }

    public function update(StoreProductoRequest $request, string $id): RedirectResponse
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para modificar productos.');
        }

        $producto = Producto::findOrFail($id);
        $producto->update($request->validated());

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(string $id): RedirectResponse
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para eliminar productos.');
        }

        $producto = Producto::findOrFail($id);

        if ($producto->ventas()->exists()) {
            return back()->with('error', 'No se puede eliminar: tiene ventas registradas');
        }

        if ($producto->compras()->exists()) {
            return back()->with('error', 'No se puede eliminar: tiene compras registradas');
        }

        if ($producto->inventarios()->exists()) {
            return back()->with('error', 'No se puede eliminar: tiene registros de inventario');
        }

        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
