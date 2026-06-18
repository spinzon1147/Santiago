<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\FacturaVenta;
use App\Models\Producto;
use App\Models\Venta;
use App\Services\StockService;
use App\Http\Requests\StoreVentaRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function __construct(
        private readonly StockService $stockService
    ) {
    }

    public function index(Request $request): View
    {
        $query = Venta::with('producto');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('producto', function ($q) use ($search) {
                $q->where('Nom_pro', 'LIKE', "%{$search}%");
            });
        }
        if ($request->filled('fecha_desde')) {
            $query->whereDate('Fecha_Ven', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('Fecha_Ven', '<=', $request->fecha_hasta);
        }

        $ventas = $query->orderBy('Fecha_Ven', 'desc')->paginate(15);

        return view('ventas.index', compact('ventas'));
    }

    public function create(): View
    {
        $productos = Producto::all();
        $clientes = Cliente::all();

        return view('ventas.create', compact('productos', 'clientes'));
    }

    public function store(StoreVentaRequest $request): RedirectResponse
    {
        $producto = Producto::findOrFail($request->Id_Prod_FK);

        if (!$this->stockService->hasSufficientStock($producto, $request->Cant_Ven)) {
            return back()->with('error', 'Stock insuficiente en el producto seleccionado');
        }

        DB::transaction(function () use ($request, $producto) {
            $total = $this->stockService->calculateTotal($producto, $request->Cant_Ven);

            $venta = Venta::create([
                'Id_Prod_FK' => $request->Id_Prod_FK,
                'Cant_Ven' => $request->Cant_Ven,
                'Total_Ven' => $total,
                'Fecha_Ven' => $request->Fecha_Ven,
            ]);

            DetalleVenta::create([
                'Id_Ven_FK' => $venta->Id_Ven,
                'Id_Prod_FK' => $request->Id_Prod_FK,
                'Cantidad' => $request->Cant_Ven,
                'Precio' => $producto->Precio_pro,
                'Subtotal' => $total,
            ]);

            $this->stockService->decrementStock($producto, $request->Cant_Ven);

            if ($request->filled('Id_Cli')) {
                $subtotal = $total;
                $iva = $subtotal * 0.19;
                $totalFact = $subtotal + $iva;

                FacturaVenta::create([
                    'Fecha_Fact' => now(),
                    'Subtotal_Fact' => (int) round($subtotal),
                    'Iva_Fact' => (int) round($iva),
                    'Total_Fact' => (int) round($totalFact),
                    'Id_Cli_FK_FACTURA_VENTA' => $request->Id_Cli,
                    'Id_Ven_FK' => $venta->Id_Ven,
                    'Estado_Fact' => 'Pagada',
                ]);
            }
        });

        return redirect()
            ->route('ventas.index')
            ->with('success', 'Venta registrada correctamente');
    }

    public function show(string $id): View
    {
        $venta = Venta::with('producto')->findOrFail($id);

        return view('ventas.show', compact('venta'));
    }

    public function edit(string $id): View
    {
        $venta = Venta::findOrFail($id);
        $productos = Producto::all();

        return view('ventas.edit', compact('venta', 'productos'));
    }

    public function update(StoreVentaRequest $request, string $id): RedirectResponse
    {
        $venta = Venta::findOrFail($id);
        $productoAnterior = Producto::find($venta->Id_Prod_FK);
        $productoNuevo = Producto::findOrFail($request->Id_Prod_FK);

        try {
            $this->stockService->transferStock(
                $productoAnterior,
                $venta->Cant_Ven,
                $productoNuevo,
                $request->Cant_Ven
            );
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        $total = $this->stockService->calculateTotal($productoNuevo, $request->Cant_Ven);

        $venta->update([
            'Id_Prod_FK' => $request->Id_Prod_FK,
            'Cant_Ven' => $request->Cant_Ven,
            'Total_Ven' => $total,
            'Fecha_Ven' => $request->Fecha_Ven,
        ]);

        return redirect()
            ->route('ventas.index')
            ->with('success', 'Venta actualizada correctamente');
    }

    public function destroy(string $id): RedirectResponse
    {
        $venta = Venta::findOrFail($id);
        $producto = Producto::find($venta->Id_Prod_FK);

        if ($producto) {
            $this->stockService->incrementStock($producto, $venta->Cant_Ven);
        }

        $venta->delete();

        return redirect()
            ->route('ventas.index')
            ->with('success', 'Venta eliminada correctamente');
    }

    public function facturaPdf($id)
    {
        $venta = Venta::with('producto')->findOrFail($id);
        $factura = FacturaVenta::with('cliente')
            ->where('Id_Ven_FK', $venta->Id_Ven)
            ->first();

        if (!$factura) {
            $factura = FacturaVenta::create([
                'Fecha_Fact' => $venta->Fecha_Ven,
                'Subtotal_Fact' => (int) round($venta->Total_Ven),
                'Iva_Fact' => (int) round($venta->Total_Ven * 0.19),
                'Total_Fact' => (int) round($venta->Total_Ven * 1.19),
                'Id_Cli_FK_FACTURA_VENTA' => null,
                'Id_Ven_FK' => $venta->Id_Ven,
                'Estado_Fact' => 'Pagada',
            ]);
        }

        $detalles = [[
            'producto' => $venta->producto->Nom_pro ?? 'Producto',
            'cantidad' => $venta->Cant_Ven,
            'precio' => $venta->Total_Ven / $venta->Cant_Ven,
            'subtotal' => $venta->Total_Ven,
        ]];

        $pdf = Pdf::loadView('reportes.invoice', compact('factura', 'detalles'));
        $pdf->setPaper([0, 0, 612, 936], 'portrait');

        return $pdf->stream('factura-' . str_pad($factura->Id_Fact, 6, '0', STR_PAD_LEFT) . '.pdf');
    }
}
