<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Services\StockService;
use App\Http\Requests\StoreCompraRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompraController extends Controller
{
    public function __construct(
        private readonly StockService $stockService
    ) {}

    public function index(Request $request): View
    {
        $query = Compra::with('producto', 'proveedor');

        if ($request->filled('fecha_desde')) {
            $query->whereDate('Fecha_Com', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('Fecha_Com', '<=', $request->fecha_hasta);
        }

        $compras = $query->orderBy('Fecha_Com', 'desc')->get();

        return view('compras.index', compact('compras'));
    }

    public function create(): View
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all();

        return view('compras.create', compact('productos', 'proveedores'));
    }

    public function store(StoreCompraRequest $request): RedirectResponse
    {
        $producto = Producto::findOrFail($request->Id_Prod_FK);
        $total = (int) round($request->Precio_Com * $request->Cant_Com);

        $compra = Compra::create([
            'Id_Prod_FK' => $request->Id_Prod_FK,
            'Cant_Com' => $request->Cant_Com,
            'Valor_Com' => $total,
            'Precio_Com' => (int) round($request->Precio_Com),
            'Fecha_Com' => $request->Fecha_Com,
            'Id_Proveedor' => $request->Id_Proveedor,
        ]);

        $this->stockService->incrementStock($producto, $request->Cant_Com);

        Inventario::create([
            'Precio_Com' => (int) round($request->Precio_Com),
            'Precio_Ven' => (int) round($producto->Precio_pro),
            'Stock' => $request->Cant_Com,
            'Id_Producto' => $request->Id_Prod_FK,
            'Id_Proveedor' => $request->Id_Proveedor,
        ]);

        return redirect()
            ->route('compras.index')
            ->with('success', 'Compra registrada, stock actualizado e inventario creado');
    }

    public function edit(string $id): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para modificar compras.');
        }

        $compra = Compra::with('producto')->findOrFail($id);
        $productos = Producto::all();
        $proveedores = Proveedor::all();

        return view('compras.edit', compact('compra', 'productos', 'proveedores'));
    }

    public function update(StoreCompraRequest $request, string $id): RedirectResponse
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para modificar compras.');
        }

        $compra = Compra::findOrFail($id);
        $productoAnterior = Producto::find($compra->Id_Prod_FK);
        $productoNuevo = Producto::findOrFail($request->Id_Prod_FK);

        if ($productoAnterior && $productoAnterior->Id_pro === $productoNuevo->Id_pro) {
            $diff = $request->Cant_Com - $compra->Cant_Com;
            if ($diff > 0) {
                $this->stockService->incrementStock($productoNuevo, $diff);
            } elseif ($diff < 0) {
                if (!$productoAnterior || !$this->stockService->hasSufficientStock($productoAnterior, abs($diff))) {
                    return back()->with('error', 'No hay suficiente stock para reducir la compra');
                }
                $this->stockService->decrementStock($productoNuevo, abs($diff));
            }
        } else {
            if ($productoAnterior) {
                $this->stockService->decrementStock($productoAnterior, $compra->Cant_Com);
            }
            $this->stockService->incrementStock($productoNuevo, $request->Cant_Com);
        }

        $total = (int) round($request->Precio_Com * $request->Cant_Com);

        Inventario::where('Id_Producto', $compra->Id_Prod_FK)
            ->where('Stock', $compra->Cant_Com)
            ->latest()
            ->take(1)
            ->get()
            ->each->delete();

        $compra->update([
            'Id_Prod_FK' => $request->Id_Prod_FK,
            'Cant_Com' => $request->Cant_Com,
            'Valor_Com' => $total,
            'Precio_Com' => (int) round($request->Precio_Com),
            'Fecha_Com' => $request->Fecha_Com,
            'Id_Proveedor' => $request->Id_Proveedor,
        ]);

        Inventario::create([
            'Precio_Com' => (int) round($request->Precio_Com),
            'Precio_Ven' => (int) round($productoNuevo->Precio_pro),
            'Stock' => $request->Cant_Com,
            'Id_Producto' => $request->Id_Prod_FK,
            'Id_Proveedor' => $request->Id_Proveedor,
        ]);

        return redirect()
            ->route('compras.index')
            ->with('success', 'Compra actualizada correctamente');
    }

    public function destroy(string $id): RedirectResponse
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para eliminar compras.');
        }

        $compra = Compra::findOrFail($id);
        $producto = Producto::find($compra->Id_Prod_FK);

        if ($producto) {
            $this->stockService->decrementStock($producto, $compra->Cant_Com);
        }

        Inventario::where('Id_Producto', $compra->Id_Prod_FK)
            ->where('Stock', $compra->Cant_Com)
            ->latest()
            ->take(1)
            ->get()
            ->each->delete();

        $compra->delete();

        return redirect()
            ->route('compras.index')
            ->with('success', 'Compra eliminada, stock e inventario actualizados');
    }
}
