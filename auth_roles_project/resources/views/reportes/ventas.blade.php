<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas</title>
    <style>
        @page { margin: 25px 30px; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #1e293b; line-height: 1.5; margin: 0; padding: 0; }

        .watermark { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-30deg); font-size: 80px; color: rgba(249,115,22,0.04); font-weight: 900; letter-spacing: 12px; text-transform: uppercase; pointer-events: none; z-index: -1; }

        .top-bar { display: flex; justify-content: space-between; align-items: center; padding-bottom: 14px; border-bottom: 3px solid #f97316; margin-bottom: 18px; }
        .top-bar .brand h2 { color: #c2410c; font-size: 18px; margin: 0; letter-spacing: -0.3px; }
        .top-bar .brand p { color: #94a3b8; font-size: 9px; margin: 1px 0 0; }
        .top-bar .meta { text-align: right; font-size: 9px; color: #94a3b8; }
        .top-bar .meta strong { color: #64748b; }

        .report-title { text-align: center; margin-bottom: 18px; }
        .report-title h1 { color: #c2410c; font-size: 20px; margin: 0; letter-spacing: -0.5px; }
        .report-title p { color: #94a3b8; font-size: 10px; margin: 2px 0 0; }

        .summary-row { display: flex; gap: 10px; margin-bottom: 18px; }
        .summary-card { flex: 1; background: linear-gradient(135deg, #fff7ed, #ffedd5); border: 1px solid #fed7aa; border-radius: 8px; padding: 12px 16px; text-align: center; }
        .summary-card .label { font-size: 8px; text-transform: uppercase; letter-spacing: 1px; color: #9a7a6a; margin-bottom: 3px; }
        .summary-card .value { font-size: 20px; font-weight: 800; color: #c2410c; }
        .summary-card .value span { font-size: 12px; font-weight: 600; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        thead th { background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; padding: 8px 12px; font-size: 8px; text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; text-align: left; }
        thead th:last-child { text-align: right; }
        tbody td { padding: 7px 12px; border-bottom: 1px solid #f1f5f9; font-size: 10px; vertical-align: middle; }
        tbody tr:nth-child(even) { background: #fefaf5; }
        tbody td:last-child { text-align: right; font-weight: 600; }
        .fw-600 { font-weight: 600; }
        .text-muted { color: #94a3b8; }
        .text-right { text-align: right; }

        .footer-bar { position: fixed; bottom: 0; left: 0; right: 0; display: flex; justify-content: space-between; padding: 8px 0; font-size: 8px; color: #cbd5e1; border-top: 1px solid #f1f5f9; }
    </style>
</head>
<body>
    <div class="watermark">VENTAS</div>

    <div class="top-bar">
        <div class="brand">
            <h2>Homero Pet Shop</h2>
            <p>NIT: 901.XXX.XXX-X</p>
        </div>
        <div class="meta">
            <strong>Generado:</strong> {{ now()->format('d/m/Y h:i A') }}<br>
            <strong>Usuario:</strong> {{ Auth::user()->name ?? '—' }}
        </div>
    </div>

    <div class="report-title">
        <h1>Reporte General de Ventas</h1>
        <p>Resumen detallado de todas las transacciones de venta</p>
    </div>

    <div class="summary-row">
        <div class="summary-card">
            <div class="label">Total Transacciones</div>
            <div class="value">{{ $ventas->count() }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Unidades Vendidas</div>
            <div class="value">{{ number_format($totalCantidad) }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Ingreso Total</div>
            <div class="value">$<span>{{ number_format($totalGeneral, 2) }}</span></div>
        </div>
        <div class="summary-card">
            <div class="label">Promedio por Venta</div>
            <div class="value">$<span>{{ number_format($ventas->count() > 0 ? $totalGeneral / $ventas->count() : 0, 2) }}</span></div>
        </div>
    </div>

    @if ($ventas->isEmpty())
        <p style="text-align:center;padding:40px;color:#94a3b8;">No hay ventas registradas en el sistema</p>
    @else
        <table>
            <thead>
                <tr>
                    <th style="width:8%"># Factura</th>
                    <th style="width:30%">Producto</th>
                    <th style="width:12%">Cantidad</th>
                    <th style="width:15%">P. Unitario</th>
                    <th style="width:15%">Total</th>
                    <th style="width:20%">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <td class="fw-600">{{ str_pad($venta->Id_Ven, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $venta->producto->Nom_pro ?? '—' }}</td>
                    <td>{{ $venta->Cant_Ven }} uds</td>
                    <td class="text-right">${{ number_format($venta->Total_Ven / max($venta->Cant_Ven, 1), 2) }}</td>
                    <td>${{ number_format($venta->Total_Ven, 2) }}</td>
                    <td class="text-muted">{{ $venta->Fecha_Ven ? \Carbon\Carbon::parse($venta->Fecha_Ven)->format('d/m/Y h:i A') : '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div style="margin-top:16px;padding-top:12px;border-top:1px solid #f1f5f9;font-size:8px;color:#94a3b8;text-align:center">
        <p style="margin:0">Este reporte contiene {{ $ventas->count() }} transacciones por un total de <strong>${{ number_format($totalGeneral, 2) }}</strong></p>
    </div>

    <div class="footer-bar">
        <span>Homero Pet Shop — Sistema de Gesti&oacute;n</span>
        <span>P&aacute;gina 1 de 1</span>
    </div>
</body>
</html>
