<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Factura #{{ str_pad($factura->Id_Fact, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page { margin: 0; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 8.5px; color: #1e293b; line-height: 1.6; margin: 0; padding: 0; }

        .main { background: #fff; margin: 14px; border: 1px solid #e2e8f0; border-radius: 14px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); }

        .top-accent { height: 4px; background: #f97316; border-radius: 13px 13px 0 0; }

        .header { padding: 24px 28px 16px; border-bottom: 1.5px solid #f1f5f9; }
        .header table { width: 100%; border-collapse: collapse; }
        .header td { vertical-align: top; }
        .brand .logo-text { font-size: 18px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 2px; color: #0f172a; }
        .brand .logo-text .hl { color: #f97316; }
        .brand p { font-size: 6.5px; color: #64748b; margin: 1px 0; line-height: 1.5; }
        .invoice-ref { text-align: right; }
        .invoice-ref h1 { font-size: 26px; font-weight: 700; margin: 0; letter-spacing: -0.5px; color: #0f172a; }
        .invoice-ref .big-num { font-size: 13px; font-weight: 600; color: #64748b; letter-spacing: 1px; margin: 4px 0; }
        .invoice-ref .status { display: inline-block; margin-top: 6px; padding: 4px 16px; background: #fef3c7; color: #92400e; font-size: 7px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; border-radius: 4px; }

        .info-section { padding: 16px 28px; border-bottom: 1.5px solid #f1f5f9; }
        .info-section table { width: 100%; border-collapse: collapse; }
        .info-section td { width: 50%; vertical-align: top; }
        .info-box h3 { font-size: 7px; text-transform: uppercase; letter-spacing: 1.5px; color: #94a3b8; margin: 0 0 6px; font-weight: 600; }
        .info-box p { font-size: 9px; color: #1e293b; margin: 2px 0; }
        .info-box .sm { color: #64748b; font-size: 7.5px; }
        .info-box.right { text-align: right; }

        .items-section { padding: 16px 28px; }
        .items-section .section-label { font-size: 7.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.2px; color: #94a3b8; margin-bottom: 10px; }

        table.items { width: 100%; border-collapse: collapse; }
        table.items thead th { padding: 8px 12px; font-size: 7px; text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; color: #fff; background: #0f172a; text-align: left; }
        table.items tbody td { padding: 7px 12px; font-size: 8px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        table.items tbody tr:nth-child(even) { background: #f8fafc; }
        table.items tbody tr:last-child td { border-bottom: none; }
        .num { text-align: right; font-weight: 600; }

        .totals-section { padding: 0 28px 20px; text-align: right; }
        .totals-section table { margin-left: auto; width: 260px; border-collapse: collapse; }
        .totals-section td { padding: 5px 12px; font-size: 8px; border-bottom: 1px solid #f1f5f9; }
        .totals-section td:last-child { text-align: right; font-weight: 600; }
        .totals-section .grand-total td { font-size: 14px; font-weight: 800; border-top: 2px solid #f97316; border-bottom: 2px solid #f97316; color: #0f172a; padding: 10px 12px; }
        .totals-section .grand-total td:last-child { font-size: 16px; color: #f97316; }

        .terms-section { padding: 14px 28px; background: #f8fafc; border-top: 1.5px solid #f1f5f9; border-radius: 0 0 13px 13px; }
        .terms-section table { width: 100%; border-collapse: collapse; }
        .terms-section td { font-size: 7px; color: #64748b; vertical-align: middle; }
        .terms-section td:last-child { text-align: right; }
        .terms-section .legal { font-size: 6.5px; color: #94a3b8; margin-top: 2px; }

        .footer { text-align: center; padding: 8px 28px; font-size: 6px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="main">
        <div class="top-accent"></div>

        <div class="header">
            <table>
                <tr>
                    <td style="width:55%">
                        <div class="brand">
                            <div class="logo-text"><span class="hl">H</span>omero <span class="hl">P</span>et <span class="hl">S</span>hop</div>
                            <p>NIT: 901.XXX.XXX-X &bull; Cra 73D #35B-31 Sur &bull; Tel: 310 2326494</p>
                            <p>info@homeropetshop.com</p>
                        </div>
                    </td>
                    <td style="width:45%">
                        <div class="invoice-ref">
                            <h1>Factura</h1>
                            <p class="big-num"># {{ str_pad($factura->Id_Fact, 6, '0', STR_PAD_LEFT) }}</p>
                            <span class="status">{{ $factura->Estado_Fact ?? 'PENDIENTE' }}</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <table>
                <tr>
                    <td>
                        <div class="info-box">
                            <h3>Cliente</h3>
                            <p><strong>{{ $factura->cliente->Nom_Cli ?? 'Cliente General' }}</strong></p>
                            @if ($factura->cliente)
                                <p class="sm">{{ $factura->cliente->Email_Cli ?? '' }}</p>
                                <p class="sm">{{ $factura->cliente->Direc_Cli ?? '' }}</p>
                                <p class="sm">Tel: {{ $factura->cliente->Tel_Cli ?? '' }}</p>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="info-box right">
                            <h3>Detalles de Facturaci&oacute;n</h3>
                            <p><strong>Emisi&oacute;n:</strong> {{ \Carbon\Carbon::parse($factura->Fecha_Fact)->format('d/m/Y') }}</p>
                            <p class="sm"><strong>Vencimiento:</strong> {{ \Carbon\Carbon::parse($factura->Fecha_Fact)->addDays(30)->format('d/m/Y') }}</p>
                            <p class="sm"><strong>Forma de pago:</strong> Contado</p>
                            <p class="sm"><strong>Documento:</strong> FAC-{{ str_pad($factura->Id_Fact, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="items-section">
            <div class="section-label">&#x25C6; DETALLE DE PRODUCTOS</div>
            <table class="items">
                <thead>
                    <tr>
                        <th style="width:46%">Producto / Servicio</th>
                        <th style="width:12%" class="num">Cantidad</th>
                        <th style="width:20%" class="num">Precio Unit.</th>
                        <th style="width:22%" class="num">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                    <tr>
                        <td>{{ $detalle['producto'] }}</td>
                        <td class="num">{{ $detalle['cantidad'] }}</td>
                        <td class="num">${{ number_format($detalle['precio']) }}</td>
                        <td class="num">${{ number_format($detalle['subtotal']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="totals-section">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>${{ number_format($factura->Subtotal_Fact) }}</td>
                </tr>
                <tr>
                    <td>IVA 19%</td>
                    <td>${{ number_format($factura->Iva_Fact) }}</td>
                </tr>
                <tr class="grand-total">
                    <td>TOTAL A PAGAR</td>
                    <td>${{ number_format($factura->Total_Fact) }}</td>
                </tr>
            </table>
        </div>

        <div class="terms-section">
            <table>
                <tr>
                    <td style="width:60%">
                        <strong>T&eacute;rminos legales</strong>
                        <div class="legal">Esta factura se asimila en todos sus efectos a una letra de cambio (Art. 774 C&oacute;digo de Comercio). Mercanc&iacute;a entregada a satisfacci&oacute;n. Los precios incluyen IVA.</div>
                    </td>
                    <td style="width:40%;text-align:right">
                        <strong>Homero Pet Shop</strong>
                        <div class="legal">Gracias por su preferencia</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">
            Homero Pet Shop &mdash; NIT: 901.XXX.XXX-X &mdash; Cra 73D #35B-31 Sur &mdash; Tel: 310 2326494 &mdash; info@homeropetshop.com &mdash; {{ now()->format('Y') }} &mdash; P&aacute;gina 1 de 1
        </div>
    </div>
</body>
</html>
