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

        $pdf = Pdf::loadView('reportes.ventas', compact('ventas', 'totalGeneral', 'totalCantidad'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('reporte-ventas-' . now()->format('Y-m-d') . '.pdf');
    }

    public function comprasPdf(): Response
    {
        $compras = Compra::with('producto')->orderBy('Fecha_Com', 'desc')->get();
        $totalGeneral = $compras->sum('Valor_Com');
        $totalCantidad = $compras->sum('Cant_Com');

        $pdf = Pdf::loadView('reportes.compras', compact('compras', 'totalGeneral', 'totalCantidad'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('reporte-compras-' . now()->format('Y-m-d') . '.pdf');
    }

    public function productosPdf(): Response
    {
        $productos = Producto::orderBy('Nom_pro')->get();

        $pdf = Pdf::loadView('reportes.productos', compact('productos'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('reporte-productos-' . now()->format('Y-m-d') . '.pdf');
    }
}
