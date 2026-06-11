<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Productos</title>
    <style>
        @page { margin: 25px 30px; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #1e293b; line-height: 1.5; margin: 0; padding: 0; }

        .watermark { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-30deg); font-size: 80px; color: rgba(16,185,129,0.04); font-weight: 900; letter-spacing: 12px; text-transform: uppercase; pointer-events: none; z-index: -1; }

        .top-bar { display: flex; justify-content: space-between; align-items: center; padding-bottom: 14px; border-bottom: 3px solid #10b981; margin-bottom: 18px; }
        .top-bar .brand h2 { color: #047857; font-size: 18px; margin: 0; letter-spacing: -0.3px; }
        .top-bar .brand p { color: #94a3b8; font-size: 9px; margin: 1px 0 0; }
        .top-bar .meta { text-align: right; font-size: 9px; color: #94a3b8; }
        .top-bar .meta strong { color: #64748b; }

        .report-title { text-align: center; margin-bottom: 18px; }
        .report-title h1 { color: #047857; font-size: 20px; margin: 0; letter-spacing: -0.5px; }
        .report-title p { color: #94a3b8; font-size: 10px; margin: 2px 0 0; }

        .summary-row { display: flex; gap: 10px; margin-bottom: 18px; }
        .summary-card { flex: 1; background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 1px solid #a7f3d0; border-radius: 8px; padding: 12px 16px; text-align: center; }
        .summary-card .label { font-size: 8px; text-transform: uppercase; letter-spacing: 1px; color: #6b8a7a; margin-bottom: 3px; }
        .summary-card .value { font-size: 20px; font-weight: 800; color: #047857; }
        .summary-card .value span { font-size: 12px; font-weight: 600; }

        .summary-row-2 { display: flex; gap: 10px; margin-bottom: 18px; }
        .mini-card { flex: 1; border-radius: 8px; padding: 10px 14px; text-align: center; }
        .mini-card .label { font-size: 7px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 3px; }
        .mini-card .value { font-size: 16px; font-weight: 700; }

        .stock-badge { display: inline-block; padding: 2px 10px; border-radius: 9999px; font-size: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; }
        .stock-disponible { background: #d1fae5; color: #047857; }
        .stock-bajo { background: #fef3c7; color: #b45309; }
        .stock-agotado { background: #fee2e2; color: #b91c1c; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        thead th { background: linear-gradient(135deg, #10b981, #059669); color: #fff; padding: 8px 12px; font-size: 8px; text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; text-align: left; }
        thead th:nth-child(3) { text-align: right; }
        thead th:nth-child(4) { text-align: right; }
        tbody td { padding: 7px 12px; border-bottom: 1px solid #f1f5f9; font-size: 10px; }
        tbody tr:nth-child(even) { background: #f0fdf9; }
        tbody td:nth-child(3) { text-align: right; font-weight: 600; }
        tbody td:nth-child(4) { text-align: right; font-weight: 600; }
        .fw-600 { font-weight: 600; }
        .text-muted { color: #94a3b8; }

        .footer-bar { position: fixed; bottom: 0; left: 0; right: 0; display: flex; justify-content: space-between; padding: 8px 0; font-size: 8px; color: #cbd5e1; border-top: 1px solid #f1f5f9; }
    </style>
</head>
<body>
    <div class="watermark">INVENTARIO</div>

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
        <h1>Reporte de Inventario y Productos</h1>
        <p>Inventario completo del pet shop con valorizaci&oacute;n de existencias</p>
    </div>

    @php
        $totalStock = $productos->sum('Cant_pro');
        $totalValor = $productos->sum(fn($p) => $p->Cant_pro * $p->Precio_pro);
        $bajoStock = $productos->filter(fn($p) => $p->Cant_pro > 0 && $p->Cant_pro <= 5)->count();
        $agotados = $productos->filter(fn($p) => $p->Cant_pro <= 0)->count();
        $disponibles = $productos->count() - $bajoStock - $agotados;
    @endphp

    <div class="summary-row">
        <div class="summary-card">
            <div class="label">Total Productos</div>
            <div class="value">{{ $productos->count() }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Unidades en Stock</div>
            <div class="value">{{ number_format($totalStock) }} <span>uds</span></div>
        </div>
        <div class="summary-card">
            <div class="label">Valor del Inventario</div>
            <div class="value">$<span>{{ number_format($totalValor, 2) }}</span></div>
        </div>
        <div class="summary-card">
            <div class="label">Precio Promedio</div>
            <div class="value">$<span>{{ number_format($productos->count() > 0 ? $productos->avg('Precio_pro') : 0, 2) }}</span></div>
        </div>
    </div>

    <div class="summary-row-2">
        <div class="mini-card" style="background:#fefce8;border:1px solid #fef08a;">
            <div class="label" style="color:#92400e;">Stock Bajo (&le;5)</div>
            <div class="value" style="color:#b45309;">{{ $bajoStock }}</div>
        </div>
        <div class="mini-card" style="background:#fef2f2;border:1px solid #fecaca;">
            <div class="label" style="color:#991b1b;">Agotados</div>
            <div class="value" style="color:#b91c1c;">{{ $agotados }}</div>
        </div>
        <div class="mini-card" style="background:#f0fdf4;border:1px solid #bbf7d0;">
            <div class="label" style="color:#166534;">Disponibles</div>
            <div class="value" style="color:#047857;">{{ $disponibles }}</div>
        </div>
        <div class="mini-card" style="background:#f0f9ff;border:1px solid #bae6fd;">
            <div class="label" style="color:#075985;">Valor Promedio</div>
            <div class="value" style="color:#0369a1;">${{ number_format($productos->count() > 0 ? $totalValor / $productos->count() : 0, 2) }}</div>
        </div>
    </div>

    @if ($productos->isEmpty())
        <p style="text-align:center;padding:40px;color:#94a3b8;">No hay productos registrados en el sistema</p>
    @else
        <table>
            <thead>
                <tr>
                    <th style="width:8%">ID</th>
                    <th style="width:32%">Nombre</th>
                    <th style="width:12%">Stock</th>
                    <th style="width:15%">Precio</th>
                    <th style="width:15%">Valor Total</th>
                    <th style="width:18%">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                @php $valorTotal = $producto->Cant_pro * $producto->Precio_pro; @endphp
                <tr>
                    <td class="fw-600">{{ str_pad($producto->Id_pro, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        {{ $producto->Nom_pro }}
                        @if ($producto->Descrip_pro)
                            <div style="font-size:8px;color:#94a3b8;margin-top:1px">{{ $producto->Descrip_pro }}</div>
                        @endif
                    </td>
                    <td>{{ $producto->Cant_pro }} uds</td>
                    <td>${{ number_format($producto->Precio_pro, 2) }}</td>
                    <td>${{ number_format($valorTotal, 2) }}</td>
                    <td><span class="stock-badge stock-{{ strtolower($producto->stock_label) }}">{{ $producto->stock_label }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div style="margin-top:16px;padding-top:12px;border-top:1px solid #f1f5f9;font-size:8px;color:#94a3b8;text-align:center">
        <p style="margin:0">Valor total del inventario: <strong>${{ number_format($totalValor, 2) }}</strong> | {{ $disponibles }} disponibles, {{ $bajoStock }} por reabastecer, {{ $agotados }} agotados</p>
    </div>

    <div class="footer-bar">
        <span>Homero Pet Shop — Sistema de Gesti&oacute;n</span>
        <span>P&aacute;gina 1 de 1</span>
    </div>
</body>
</html>
