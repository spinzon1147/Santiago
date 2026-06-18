<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Services\StockService;
use App\Http\Requests\InventarioFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventarioController extends Controller
{
    public function __construct(
        private readonly StockService $stockService
    ) {
    }

    public function index(Request $request): View
    {
        $query = Inventario::with(['proveedor', 'producto']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('producto', fn ($q) => $q->where('Nom_pro', 'like', "%{$search}%"));
        }

        $inventarios = $query->paginate(15);

        return view('inventarios.index', compact('inventarios'));
    }

    public function create(): View
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();

        return view('inventarios.create', compact('proveedores', 'productos'));
    }

    public function store(InventarioFormRequest $request): RedirectResponse
    {
        Inventario::create($request->validated());

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
        $proveedores = Proveedor::all();
        $productos = Producto::all();

        return view('inventarios.edit', compact('inventario', 'proveedores', 'productos'));
    }

    public function update(InventarioFormRequest $request, Inventario $inventario): RedirectResponse
    {
        $oldStock = (int) $inventario->Stock;
        $oldProductoId = $inventario->Id_Producto;

        $inventario->update($request->validated());

        $oldProducto = Producto::find($oldProductoId);
        if ($oldProducto) {
            if (!$this->stockService->hasSufficientStock($oldProducto, $oldStock)) {
                return back()->with('error', 'No hay suficiente stock para revertir el inventario anterior');
            }
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
        $producto = Producto::find($inventario->Id_Producto);
        if ($producto) {
            if (!$this->stockService->hasSufficientStock($producto, (int) $inventario->Stock)) {
                return back()->with('error', 'No hay suficiente stock para eliminar este inventario');
            }
            $this->stockService->decrementStock($producto, (int) $inventario->Stock);
        }

        $inventario->delete();

        return redirect()
            ->route('inventarios.index')
            ->with('success', 'Inventario eliminado y stock de producto actualizado');
    }
}
