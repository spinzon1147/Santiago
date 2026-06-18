@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="page-header">
    <div>
        <h1>Reportes</h1>
        <p>Informes ejecutivos en PDF de los m&oacute;dulos del sistema</p>
    </div>
</div>

<div class="r-grid">
    <a href="{{ route('reportes.ventas') }}" target="_blank" class="r-card" style="--r-color:#dc2626;--r-bg:#fef2f2;--r-border:#fecaca;">
        <div class="r-top" style="background:linear-gradient(135deg,#dc2626,#f97316);">
            <span class="r-icon">
                <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 20V4m3 16V8m3 12v-5m3 5V9m3 11V6a1 1 0 011-1h2a1 1 0 011 1v14"/>
                </svg>
            </span>
        </div>
        <div class="r-body">
            <h3>Ventas</h3>
            <p>Reporte detallado de ingresos, ticket promedio y rendimiento comercial.</p>
        </div>
        <div class="r-foot">
            <span class="r-btn">Generar PDF</span>
            <span class="r-code">REP-VT</span>
        </div>
    </a>

    <a href="{{ route('reportes.compras') }}" target="_blank" class="r-card" style="--r-color:#2563eb;--r-bg:#eff6ff;--r-border:#bfdbfe;">
        <div class="r-top" style="background:linear-gradient(135deg,#1e40af,#3b82f6);">
            <span class="r-icon">
                <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l2 2 4-4"/>
                </svg>
            </span>
        </div>
        <div class="r-body">
            <h3>Compras</h3>
            <p>&Oacute;rdenes de compra, inversi&oacute;n total y an&aacute;lisis por proveedor.</p>
        </div>
        <div class="r-foot">
            <span class="r-btn">Generar PDF</span>
            <span class="r-code">REP-CO</span>
        </div>
    </a>

    <a href="{{ route('reportes.productos') }}" target="_blank" class="r-card" style="--r-color:#059669;--r-bg:#ecfdf5;--r-border:#a7f3d0;">
        <div class="r-top" style="background:linear-gradient(135deg,#065f46,#059669);">
            <span class="r-icon">
                <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </span>
        </div>
        <div class="r-body">
            <h3>Inventario</h3>
            <p>Stock disponible, valorizaci&oacute;n de existencias y alertas de inventario.</p>
        </div>
        <div class="r-foot">
            <span class="r-btn">Generar PDF</span>
            <span class="r-code">REP-IN</span>
        </div>
    </a>
</div>

<style>
    .r-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 22px;
    }

    .r-card {
        text-decoration: none;
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        border: 1px solid #e2e8f0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .r-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 24px 60px rgba(0,0,0,0.1);
        border-color: var(--r-color);
    }

    .r-top {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
    }

    .r-icon {
        width: 52px;
        height: 52px;
        background: rgba(255,255,255,0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .r-icon svg {
        display: block;
    }

    .r-top h2 {
        font-size: 18px;
        font-weight: 800;
        color: #fff;
        margin: 0;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .r-body {
        padding: 18px 24px;
        flex: 1;
    }

    .r-body h3 {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.3px;
        color: #0f172a;
        margin: 0 0 6px;
    }

    .r-body p {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        font-size: 13.5px;
        color: #64748b;
        margin: 0;
        line-height: 1.6;
        font-weight: 400;
    }

    .r-foot {
        padding: 14px 24px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .r-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        color: var(--r-color);
        padding: 7px 16px;
        border-radius: 10px;
        background: var(--r-bg);
        border: 1px solid var(--r-border);
        transition: all 0.2s;
    }

    .r-card:hover .r-btn {
        background: var(--r-color);
        color: #fff;
        border-color: var(--r-color);
    }

    .r-code {
        font-size: 11px;
        color: #94a3b8;
        font-family: 'SF Mono', 'Fira Code', 'Cascadia Code', monospace;
        font-weight: 500;
        letter-spacing: 0.8px;
    }
</style>
@endsection
