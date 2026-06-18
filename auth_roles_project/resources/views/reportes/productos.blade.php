<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Inventario y Productos</title>
    <style>
        @page { margin: 0; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 9px; color: #1e293b; line-height: 1.5; margin: 0; padding: 0; }

        .banner { background: linear-gradient(135deg, #065f46 0%, #059669 50%, #34d399 100%); padding: 18px 28px; }
        .banner table { width: 100%; border-collapse: collapse; }
        .banner td { vertical-align: middle; }
        .banner .co-name { font-size: 16px; font-weight: 900; color: #fff; margin: 0; letter-spacing: 1.2px; }
        .banner .co-det { font-size: 7px; color: rgba(255,255,255,0.8); margin: 2px 0 0; letter-spacing: 0.3px; }
        .banner .doc-ref { text-align: right; color: rgba(255,255,255,0.9); font-size: 7px; line-height: 1.7; letter-spacing: 0.2px; }
        .banner .doc-ref strong { color: #fff; }

        .body-wrap { padding: 22px 28px 40px; }

        .title-section { margin-bottom: 20px; }
        .title-section h1 { font-size: 20px; font-weight: 900; color: #0f172a; margin: 0 0 2px; letter-spacing: -0.8px; }
        .title-section .subtitle { font-size: 8.5px; color: #64748b; margin: 0; letter-spacing: 0.2px; }
        .title-section .subtitle strong { color: #059669; }
        .title-line { width: 60px; height: 3px; background: linear-gradient(90deg, #059669, #34d399); border-radius: 6px; margin-top: 8px; }

        .kpi-row { margin-bottom: 12px; }
        .kpi-row table { width: 100%; border-collapse: collapse; }
        .kpi-row td { padding: 0; vertical-align: top; }
        .kpi-cell { padding: 0 4px; }
        .kpi-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 14px; }
        .kpi-card table { width: 100%; border-collapse: collapse; }
        .kpi-card td { vertical-align: middle; padding: 0; }
        .kpi-icon { width: 36px; height: 36px; border-radius: 10px; display: inline-block; text-align: center; vertical-align: middle; font-size: 16px; font-weight: 800; margin-right: 10px; line-height: 36px; font-family: 'DejaVu Sans', sans-serif; }
        .kpi-label { font-size: 7px; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; font-weight: 600; }
        .kpi-value { font-size: 17px; font-weight: 900; color: #0f172a; line-height: 1.2; }
        .kpi-value span { font-size: 9px; font-weight: 600; color: #94a3b8; }

        .badge-row { margin-bottom: 16px; }
        .badge-row table { width: 100%; border-collapse: collapse; }
        .badge-row td { padding: 0; vertical-align: top; }
        .badge-cell { padding: 0 4px; }
        .badge-card { border-radius: 8px; padding: 10px 14px; text-align: center; }
        .badge-card .lbl { font-size: 6.5px; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 2px; font-weight: 700; }
        .badge-card .val { font-size: 14px; font-weight: 800; }

        .table-wrap { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 16px; }
        .table-header { background: linear-gradient(135deg, #065f46, #059669); padding: 10px 16px; border-radius: 11px 11px 0 0; }
        .table-header span { font-size: 8px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1.2px; }

        table.data { width: 100%; border-collapse: collapse; }
        table.data thead th { padding: 8px 12px; font-size: 7px; text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; color: #475569; background: #f8fafc; text-align: left; border-bottom: 1.5px solid #e2e8f0; }
        table.data tbody td { padding: 7px 12px; font-size: 8.5px; border-bottom: 1px solid #f1f5f9; }
        table.data tbody tr:last-child td { border-bottom: none; }
        table.data tbody tr:nth-child(even) { background: #fafbfc; }
        .num { text-align: right; font-weight: 600; }
        .muted { color: #94a3b8; }

        .tag { display: inline-block; padding: 1.5px 8px; border-radius: 9999px; font-size: 6.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; }
        .tag-disp { background: #d1fae5; color: #065f46; }
        .tag-bajo { background: #fef3c7; color: #92400e; }
        .tag-ago { background: #fee2e2; color: #991b1b; }

        .summary { background: linear-gradient(135deg, #0f172a, #1e293b); border-radius: 10px; padding: 12px 18px; margin-bottom: 14px; }
        .summary table { width: 100%; border-collapse: collapse; }
        .summary td { text-align: center; color: #cbd5e1; font-size: 7px; padding: 4px 8px; letter-spacing: 0.3px; }
        .summary td strong { display: block; font-size: 14px; color: #fff; font-weight: 800; margin-bottom: 2px; letter-spacing: -0.3px; }

        .footer { background: #0f172a; padding: 10px 28px; }
        .footer table { width: 100%; border-collapse: collapse; }
        .footer td { color: #64748b; font-size: 6.5px; letter-spacing: 0.2px; }
        .footer td:last-child { text-align: right; }
        .footer strong { color: #94a3b8; }
    </style>
</head>
<body>

    <div class="banner">
        <table>
            <tr>
                <td style="width:60%">
                    <div class="co-name">HOMERO PET SHOP</div>
                    <div class="co-det">NIT: 901.XXX.XXX-X &bull; Cra 73D #35B-31 Sur &bull; Tel: 310 2326494 &bull; info@homeropetshop.com</div>
                </td>
                <td style="width:40%" class="doc-ref">
                    <strong>Documento:</strong> REP-IN-{{ now()->format('Ymd') }}<br>
                    <strong>Emisi&oacute;n:</strong> {{ now()->format('d/m/Y h:i A') }} &bull; <strong>Usuario:</strong> {{ Auth::user()->name ?? '—' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="body-wrap">

        <div class="title-section">
            <h1>Reporte de Inventario</h1>
            <p class="subtitle"><strong>{{ $productos->count() }} productos</strong> registrados &bull; <strong>{{ number_format($totalStock) }}</strong> unidades en stock &bull; Valorizado en <strong>${{ number_format($totalValor) }}</strong></p>
            <div class="title-line"></div>
        </div>

        <div class="kpi-row">
            <table>
                <tr>
                    <td class="kpi-cell">
                        <div class="kpi-card">
                            <table><tr>
                                <td style="width:36px"><span class="kpi-icon" style="background:#d1fae5;color:#059669;">#</span></td>
                                <td><div class="kpi-label">Total Productos</div><div class="kpi-value">{{ $productos->count() }}</div></td>
                            </tr></table>
                        </div>
                    </td>
                    <td class="kpi-cell">
                        <div class="kpi-card">
                            <table><tr>
                                <td style="width:36px"><span class="kpi-icon" style="background:#fef3c7;color:#d97706;">N</span></td>
                                <td><div class="kpi-label">Unidades en Stock</div><div class="kpi-value">{{ number_format($totalStock) }} <span>uds</span></div></td>
                            </tr></table>
                        </div>
                    </td>
                    <td class="kpi-cell">
                        <div class="kpi-card">
                            <table><tr>
                                <td style="width:36px"><span class="kpi-icon" style="background:#dbeafe;color:#2563eb;">$</span></td>
                                <td><div class="kpi-label">Valor Inventario</div><div class="kpi-value">${{ number_format($totalValor) }}</div></td>
                            </tr></table>
                        </div>
                    </td>
                    <td class="kpi-cell">
                        <div class="kpi-card">
                            <table><tr>
                                <td style="width:36px"><span class="kpi-icon" style="background:#f3e8ff;color:#9333ea;">&Oslash;</span></td>
                                <td><div class="kpi-label">Precio Promedio</div><div class="kpi-value">${{ number_format($promedioPrecio) }}</div></td>
                            </tr></table>
                        </div>
                    </td>
                    <td class="kpi-cell">
                        <div class="kpi-card">
                            <table><tr>
                                <td style="width:36px"><span class="kpi-icon" style="background:#fce7f3;color:#db2777;">R</span></td>
                                <td><div class="kpi-label">Rango Precios</div><div class="kpi-value">${{ number_format($precioMin) }} <span>a ${{ number_format($precioMax) }}</span></div></td>
                            </tr></table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="badge-row">
            <table>
                <tr>
                    <td class="badge-cell">
                        <div class="badge-card" style="background:#f0fdf4;border:1.5px solid #86efac;">
                            <div class="lbl" style="color:#166534;">Disponibles</div>
                            <div class="val" style="color:#16a34a;">{{ $disponibles }}</div>
                        </div>
                    </td>
                    <td class="badge-cell">
                        <div class="badge-card" style="background:#fefce8;border:1.5px solid #facc15;">
                            <div class="lbl" style="color:#92400e;">Stock Bajo (&le;5)</div>
                            <div class="val" style="color:#ca8a04;">{{ $bajoStock }}</div>
                        </div>
                    </td>
                    <td class="badge-cell">
                        <div class="badge-card" style="background:#fef2f2;border:1.5px solid #fca5a5;">
                            <div class="lbl" style="color:#991b1b;">Agotados</div>
                            <div class="val" style="color:#dc2626;">{{ $agotados }}</div>
                        </div>
                    </td>
                    <td class="badge-cell">
                        <div class="badge-card" style="background:#f0f9ff;border:1.5px solid #93c5fd;">
                            <div class="lbl" style="color:#075985;">Valor Prom. x Prod.</div>
                            <div class="val" style="color:#2563eb;">${{ number_format($productos->count() > 0 ? $totalValor / $productos->count() : 0) }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        @if ($productos->isEmpty())
            <p style="text-align:center;padding:50px;color:#94a3b8;border:1px solid #e2e8f0;border-radius:12px;background:#fff;">No hay productos registrados en el sistema</p>
        @else
            <div class="table-wrap">
                <div class="table-header"><span>DETALLE DE PRODUCTOS</span></div>
                <table class="data">
                    <thead>
                        <tr>
                            <th style="width:6%">ID</th>
                            <th style="width:31%">Nombre</th>
                            <th style="width:9%" class="num">Stock</th>
                            <th style="width:14%" class="num">Precio</th>
                            <th style="width:16%" class="num">Valor Total</th>
                            <th style="width:11%">Estado</th>
                            <th style="width:13%">Descripci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        @php $valorTotal = $producto->Cant_pro * $producto->Precio_pro; @endphp
                        <tr>
                            <td style="font-weight:700">{{ str_pad($producto->Id_pro, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $producto->Nom_pro }}</td>
                            <td class="num">{{ number_format($producto->Cant_pro) }}</td>
                            <td class="num">${{ number_format($producto->Precio_pro) }}</td>
                            <td class="num">${{ number_format($valorTotal) }}</td>
                            <td>
                                @if (($producto->stock_label ?? $producto->Estado_pro) === 'Disponible')
                                    <span class="tag tag-disp">Disponible</span>
                                @elseif (($producto->stock_label ?? $producto->Estado_pro) === 'Bajo')
                                    <span class="tag tag-bajo">Bajo</span>
                                @else
                                    <span class="tag tag-ago">Agotado</span>
                                @endif
                            </td>
                            <td class="muted">{{ Str::limit($producto->Descrip_pro ?? '—', 30) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="summary">
                <table>
                    <tr>
                        <td><strong>{{ $productos->count() }}</strong>Productos registrados</td>
                        <td><strong>{{ number_format($totalStock) }}</strong>Unidades en inventario</td>
                        <td><strong>${{ number_format($totalValor) }}</strong>Valor total del inventario</td>
                        <td><strong>{{ $disponibles }} / {{ $bajoStock }} / {{ $agotados }}</strong>Disp. / Bajo / Agot.</td>
                    </tr>
                </table>
            </div>
        @endif

    </div>

    <div class="footer">
        <table>
            <tr>
                <td>Homero Pet Shop &mdash; <strong>NIT:</strong> 901.XXX.XXX-X &mdash; Cra 73D #35B-31 Sur &mdash; Tel: 310 2326494</td>
                <td>Confidencial &mdash; {{ now()->format('Y') }} &mdash; P&aacute;gina 1 de 1</td>
            </tr>
        </table>
    </div>

</body>
</html>
