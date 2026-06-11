<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventarioController extends Controller
{
    public function __construct(
        private readonly StockService $stockService
    ) {}

    public function index(Request $request): View
    {
        $query = Inventario::with(['proveedor', 'producto']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('producto', fn($q) => $q->where('Nom_pro', 'like', "%{$search}%"));
        }

        $inventarios = $query->get();

        return view('inventarios.index', compact('inventarios'));
    }

    public function create(): View
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();

        return view('inventarios.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'Precio_Com' => 'required|numeric|min:0',
            'Precio_Ven' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'Categoria' => 'nullable|string|max:255',
            'Descripcion' => 'nullable|string|max:500',
            'Id_Proveedor' => 'nullable|exists:proveedors,Id_Prov',
            'Id_Producto' => 'required|exists:producto,Id_pro',
        ]);

        Inventario::create($validated);

        $producto = Producto::find($request->Id_Producto);
        if ($producto) {
            $this->stockService->incrementStock($producto, (int) $request->Stock);
            $producto->update([
                'Precio_pro' => $request->Precio_Ven,
            ]);
        }

        return redirect()
            ->route('inventarios.index')
            ->with('success', 'Inventario registrado y producto actualizado');
    }

    public function edit(Inventario $inventario): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para modificar inventario.');
        }

        $proveedores = Proveedor::all();
        $productos = Producto::all();

        return view('inventarios.edit', compact('inventario', 'proveedores', 'productos'));
    }

    public function update(Request $request, Inventario $inventario): RedirectResponse
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para modificar inventario.');
        }

        $validated = $request->validate([
            'Precio_Com' => 'required|numeric|min:0',
            'Precio_Ven' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'Categoria' => 'nullable|string|max:255',
            'Descripcion' => 'nullable|string|max:500',
            'Id_Proveedor' => 'nullable|exists:proveedors,Id_Prov',
            'Id_Producto' => 'required|exists:producto,Id_pro',
        ]);

        $oldStock = (int) $inventario->Stock;
        $oldProductoId = $inventario->Id_Producto;

        $inventario->update($validated);

        $oldProducto = Producto::find($oldProductoId);
        if ($oldProducto) {
            $this->stockService->decrementStock($oldProducto, $oldStock);
        }

        $newProducto = Producto::find($request->Id_Producto);
        if ($newProducto) {
            $this->stockService->incrementStock($newProducto, (int) $request->Stock);
            $newProducto->update([
                'Precio_pro' => $request->Precio_Ven,
            ]);
        }

        return redirect()
            ->route('inventarios.index')
            ->with('success', 'Inventario actualizado correctamente');
    }

    public function destroy(Inventario $inventario): RedirectResponse
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para eliminar inventario.');
        }

        $producto = Producto::find($inventario->Id_Producto);
        if ($producto) {
            $this->stockService->decrementStock($producto, (int) $inventario->Stock);
        }

        $inventario->delete();

        return redirect()
            ->route('inventarios.index')
            ->with('success', 'Inventario eliminado y stock de producto actualizado');
    }
}
