<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function ventasPdf(): Response
    {
        $ventas = Venta::with('producto')->orderBy('Fecha_Ven', 'desc')->get();
        $totalGeneral = $ventas->sum('Total_Ven');
        $totalCantidad = $ventas->sum('Cant_Ven');
        $promedio = $ventas->count() > 0 ? $totalGeneral / $ventas->count() : 0;
        $ventaMax = $ventas->max('Total_Ven') ?? 0;
        $fechaMin = $ventas->min('Fecha_Ven');
        $fechaMax = $ventas->max('Fecha_Ven');

        $pdf = Pdf::loadView('reportes.ventas', compact('ventas', 'totalGeneral', 'totalCantidad', 'promedio', 'ventaMax', 'fechaMin', 'fechaMax'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('reporte-ventas-' . now()->format('Y-m-d') . '.pdf');
    }

    public function comprasPdf(): Response
    {
        $compras = Compra::with('producto', 'proveedor')->orderBy('Fecha_Com', 'desc')->get();
        $totalGeneral = $compras->sum('Valor_Com');
        $totalCantidad = $compras->sum('Cant_Com');
        $promedio = $compras->count() > 0 ? $totalGeneral / $compras->count() : 0;
        $compraMax = $compras->max('Valor_Com') ?? 0;
        $fechaMin = $compras->min('Fecha_Com');
        $fechaMax = $compras->max('Fecha_Com');

        $pdf = Pdf::loadView('reportes.compras', compact('compras', 'totalGeneral', 'totalCantidad', 'promedio', 'compraMax', 'fechaMin', 'fechaMax'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('reporte-compras-' . now()->format('Y-m-d') . '.pdf');
    }

    public function productosPdf(): Response
    {
        $productos = Producto::orderBy('Nom_pro')->get();
        $totalStock = $productos->sum('Cant_pro');
        $totalValor = $productos->sum(fn ($p) => $p->Cant_pro * $p->Precio_pro);
        $bajoStock = $productos->filter(fn ($p) => $p->Cant_pro > 0 && $p->Cant_pro <= 5)->count();
        $agotados = $productos->filter(fn ($p) => $p->Cant_pro <= 0)->count();
        $disponibles = $productos->count() - $bajoStock - $agotados;
        $promedioPrecio = $productos->count() > 0 ? $productos->avg('Precio_pro') : 0;
        $precioMax = $productos->max('Precio_pro') ?? 0;
        $precioMin = $productos->min('Precio_pro') ?? 0;

        $pdf = Pdf::loadView('reportes.productos', compact('productos', 'totalStock', 'totalValor', 'bajoStock', 'agotados', 'disponibles', 'promedioPrecio', 'precioMax', 'precioMin'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('reporte-productos-' . now()->format('Y-m-d') . '.pdf');
    }
}
