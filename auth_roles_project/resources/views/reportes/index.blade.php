@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="page-header">
    <div>
        <h1>Reportes</h1>
        <p>Genera reportes en PDF de los diferentes módulos</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px">
    <a href="{{ route('reportes.ventas') }}" target="_blank" class="card report-card" style="text-decoration:none;cursor:pointer;padding:28px;transition:all .25s;display:flex;flex-direction:column;gap:14px">
        <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#fff7ed,#fed7aa);display:flex;align-items:center;justify-content:center">
            <svg width="26" height="26" fill="none" stroke="#ea580c" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
            </svg>
        </div>
        <div>
            <h3 style="font-size:18px;font-weight:700;color:#1e293b;margin:0 0 4px">Reporte de Ventas</h3>
            <p style="font-size:13px;color:#94a3b8;margin:0;line-height:1.5">Descargar listado completo de ventas con totales, cantidades y fechas.</p>
        </div>
        <div style="display:flex;align-items:center;gap:8px;margin-top:4px">
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#ea580c">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Abrir PDF
            </span>
        </div>
    </a>

    <a href="{{ route('reportes.compras') }}" target="_blank" class="card report-card" style="text-decoration:none;cursor:pointer;padding:28px;transition:all .25s;display:flex;flex-direction:column;gap:14px">
        <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#eff6ff,#bfdbfe);display:flex;align-items:center;justify-content:center">
            <svg width="26" height="26" fill="none" stroke="#2563eb" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
            </svg>
        </div>
        <div>
            <h3 style="font-size:18px;font-weight:700;color:#1e293b;margin:0 0 4px">Reporte de Compras</h3>
            <p style="font-size:13px;color:#94a3b8;margin:0;line-height:1.5">Descargar listado de compras realizadas con inversión total y detalle.</p>
        </div>
        <div style="display:flex;align-items:center;gap:8px;margin-top:4px">
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#2563eb">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Abrir PDF
            </span>
        </div>
    </a>

    <a href="{{ route('reportes.productos') }}" target="_blank" class="card report-card" style="text-decoration:none;cursor:pointer;padding:28px;transition:all .25s;display:flex;flex-direction:column;gap:14px">
        <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,#ecfdf5,#a7f3d0);display:flex;align-items:center;justify-content:center">
            <svg width="26" height="26" fill="none" stroke="#059669" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <div>
            <h3 style="font-size:18px;font-weight:700;color:#1e293b;margin:0 0 4px">Reporte de Productos</h3>
            <p style="font-size:13px;color:#94a3b8;margin:0;line-height:1.5">Inventario completo con stock, precios, estado y valor total.</p>
        </div>
        <div style="display:flex;align-items:center;gap:8px;margin-top:4px">
            <span style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#059669">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Abrir PDF
            </span>
        </div>
    </a>
</div>

<style>
    .report-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.08); }
    .report-card:hover h3 { color: #0f172a; }
</style>
@endsection
