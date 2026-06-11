<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Factura #{{ $factura->Id_Fact }}</title>
    <style>
        @page { margin: 25px 30px; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #1e293b; line-height: 1.5; margin: 0; padding: 0; }

        .invoice-box { max-width: 100%; padding: 0; }
        .top-section { display: flex; justify-content: space-between; align-items: flex-start; padding-bottom: 18px; border-bottom: 2px solid #f97316; margin-bottom: 20px; }
        .brand h2 { color: #c2410c; font-size: 22px; margin: 0; letter-spacing: -0.5px; }
        .brand p { color: #94a3b8; font-size: 10px; margin: 2px 0 0; }
        .invoice-title { text-align: right; }
        .invoice-title h1 { color: #1e293b; font-size: 28px; margin: 0; letter-spacing: -1px; }
        .invoice-title p { color: #94a3b8; font-size: 11px; margin: 2px 0 0; }

        .info-section { display: flex; justify-content: space-between; margin-bottom: 22px; }
        .info-box { background: #fefaf5; border: 1px solid #fed7aa; border-radius: 8px; padding: 14px 18px; width: 48%; }
        .info-box h3 { font-size: 10px; text-transform: uppercase; letter-spacing: 0.8px; color: #9a7a6a; margin: 0 0 8px; }
        .info-box p { font-size: 12px; color: #1e293b; margin: 2px 0; font-weight: 500; }
        .info-box .muted { color: #94a3b8; font-weight: 400; font-size: 10px; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        thead th { background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; padding: 9px 14px; font-size: 9px; text-transform: uppercase; letter-spacing: 0.6px; font-weight: 600; text-align: left; }
        thead th:last-child { text-align: right; }
        thead th:nth-child(3) { text-align: right; }
        thead th:nth-child(4) { text-align: right; }
        tbody td { padding: 9px 14px; border-bottom: 1px solid #f1f5f9; font-size: 11px; vertical-align: middle; }
        tbody td:last-child { text-align: right; font-weight: 600; }
        tbody td:nth-child(3) { text-align: right; }
        tbody td:nth-child(2) { text-align: center; }
        tbody tr:nth-child(even) { background: #fefaf5; }

        .totals { margin-left: auto; width: 300px; }
        .totals table { margin-bottom: 0; }
        .totals td { padding: 8px 14px; border-bottom: 1px solid #f1f5f9; font-size: 11px; }
        .totals td:last-child { text-align: right; font-weight: 600; }
        .totals .grand td { font-size: 14px; font-weight: 800; color: #c2410c; border-top: 2px solid #f97316; border-bottom: none; padding: 12px 14px; }
        .totals .grand td:last-child { font-size: 16px; }

        .footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; padding: 10px 0; font-size: 8px; color: #cbd5e1; border-top: 1px solid #f1f5f9; }

        .status-paid { display: inline-block; padding: 3px 14px; border-radius: 9999px; font-size: 9px; font-weight: 700; text-transform: uppercase; background: #d1fae5; color: #047857; letter-spacing: 0.4px; }

        .watermark { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-30deg); font-size: 80px; color: rgba(249,115,22,0.04); font-weight: 900; letter-spacing: 12px; text-transform: uppercase; pointer-events: none; z-index: -1; }
    </style>
</head>
<body>
    <div class="watermark">FACTURA</div>

    <div class="top-section">
        <div class="brand">
            <h2>Homero Pet Shop</h2>
            <p>Sistema de Gesti&oacute;n — NIT: 901.XXX.XXX-X</p>
        </div>
        <div class="invoice-title">
            <h1>FACTURA</h1>
            <p>No. {{ str_pad($factura->Id_Fact, 6, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <div class="info-section">
        <div class="info-box">
            <h3>Cliente</h3>
            <p>{{ $factura->cliente->Nom_Cli ?? 'Cliente General' }}</p>
            @if ($factura->cliente)
                <p class="muted">{{ $factura->cliente->Email_Cli ?? '' }}</p>
                <p class="muted">{{ $factura->cliente->Direc_Cli ?? '' }}</p>
            @endif
        </div>
        <div class="info-box" style="text-align:right">
            <h3>Detalles de Factura</h3>
            <p>{{ \Carbon\Carbon::parse($factura->Fecha_Fact)->format('d/m/Y') }}</p>
            <p class="muted">Vence: {{ \Carbon\Carbon::parse($factura->Fecha_Fact)->addDays(30)->format('d/m/Y') }}</p>
            <p style="margin-top:6px"><span class="status-paid">{{ $factura->Estado_Fact }}</span></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:50%">Producto</th>
                <th style="width:15%">Cant.</th>
                <th style="width:20%">Precio Unit.</th>
                <th style="width:15%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $detalle)
            <tr>
                <td>{{ $detalle['producto'] }}</td>
                <td>{{ $detalle['cantidad'] }}</td>
                <td>${{ number_format($detalle['precio'], 2) }}</td>
                <td>${{ number_format($detalle['subtotal'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td>Subtotal</td>
                <td>${{ number_format($factura->Subtotal_Fact, 2) }}</td>
            </tr>
            <tr>
                <td>IVA 19%</td>
                <td>${{ number_format($factura->Iva_Fact, 2) }}</td>
            </tr>
            <tr class="grand">
                <td>Total</td>
                <td>${{ number_format($factura->Total_Fact, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-top:40px; padding-top:20px; border-top:1px solid #f1f5f9; text-align:center; font-size:9px; color:#94a3b8;">
        <p style="margin:0 0 4px"><strong>Homero Pet Shop</strong> — Gracias por su compra</p>
        <p style="margin:0">Esta factura se asimila en todos sus efectos a una letra de cambio. Art. 774 C.Co.</p>
    </div>

    <div class="footer">
        Homero Pet Shop — Sistema de Gesti&oacute;n — {{ now()->format('Y') }} — P&aacute;gina 1 de 1
    </div>
</body>
</html>
