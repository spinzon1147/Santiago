@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    use App\Models\Producto;
    use App\Models\Venta;
    use App\Models\Compra;
    use App\Models\Cliente;

    $stats = [
        ['label' => 'Productos', 'value' => Producto::count(), 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'from' => '#f97316', 'to' => '#ea580c', 'bg' => '#fff7ed'],
        ['label' => 'Ventas', 'value' => Venta::count(), 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z', 'from' => '#10b981', 'to' => '#059669', 'bg' => '#ecfdf5'],
        ['label' => 'Compras', 'value' => Compra::count(), 'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0', 'from' => '#3b82f6', 'to' => '#2563eb', 'bg' => '#eff6ff'],
        ['label' => 'Clientes', 'value' => Cliente::count(), 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'from' => '#a855f7', 'to' => '#9333ea', 'bg' => '#faf5ff'],
    ];

    $modules = [
        ['route' => 'compras.index', 'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0', 'color' => '#3b82f6', 'bg' => '#eff6ff', 'title' => 'Compras', 'desc' => 'Control y registro de compras de productos.', 'count' => Compra::count()],
        ['route' => 'ventas.index', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z', 'color' => '#10b981', 'bg' => '#ecfdf5', 'title' => 'Ventas', 'desc' => 'Administración y seguimiento de ventas.', 'count' => Venta::count()],
        ['route' => 'productos.index', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color' => '#f97316', 'bg' => '#fff7ed', 'title' => 'Productos', 'desc' => 'Gestión de productos, precios y disponibilidad.', 'count' => Producto::count()],
        ['route' => 'clientes.index', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'color' => '#a855f7', 'bg' => '#faf5ff', 'title' => 'Clientes', 'desc' => 'Administración de información de clientes.', 'count' => Cliente::count()],
        ['route' => 'proveedores.index', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => '#f59e0b', 'bg' => '#fefce8', 'title' => 'Proveedores', 'desc' => 'Gestión de proveedores y abastecimiento.', 'count' => 0],
        ['route' => 'inventarios.index', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4', 'color' => '#f43f5e', 'bg' => '#fff1f2', 'title' => 'Inventario', 'desc' => 'Control de existencias y stock disponible.', 'count' => 0],
    ];
@endphp

<div style="margin-bottom:36px">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px">
        <div>
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:6px">
                <h1 style="font-size:30px;font-weight:700;color:#1e293b;letter-spacing:-0.7px">Bienvenido, {{ Auth::user()->name }}</h1>
                <div style="display:none;align-items:center;gap:6px;padding:5px 14px;background:linear-gradient(135deg,#ecfdf5,#d1fae5);border-radius:9999px;border:1px solid #a7f3d0" class="status-dot">
                    <div style="width:7px;height:7px;border-radius:50%;background:#10b981;box-shadow:0 0 8px rgba(16,185,129,0.5);animation:pulse 2s infinite"></div>
                    <span style="font-size:11px;font-weight:600;color:#047857">En línea</span>
                </div>
            </div>
            <p style="font-size:15px;color:#94a3b8">Panel de control — Homero Pet Shop</p>
        </div>
        <div style="display:flex;gap:10px">
            <a href="{{ route('ventas.create') }}" class="btn-primary" style="padding:11px 22px;font-size:13px">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Venta
            </a>
            <a href="{{ route('compras.create') }}" class="btn-secondary" style="padding:11px 22px;font-size:13px">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Compra
            </a>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;margin-bottom:40px">
    @foreach ($stats as $i => $stat)
    <div style="background:#fff;border-radius:20px;border:1px solid rgba(255,255,255,0.8);padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.04),0 4px 16px rgba(249,115,22,0.04);transition:all .3s cubic-bezier(.34,1.56,.64,1);animation:fadeUp .4s cubic-bezier(.22,1,.36,1);animation-fill-mode:both;position:relative;overflow:hidden" class="stat-card">
        <div style="position:absolute;top:0;right:0;width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,{{ $stat['bg'] }},transparent);transform:translate(40%,-40%)"></div>
        <div style="display:flex;align-items:center;gap:16px;position:relative;z-index:1">
            <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,{{ $stat['from'] }},{{ $stat['to'] }});display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(0,0,0,0.08);transition:all .3s cubic-bezier(.34,1.56,.64,1);position:relative;overflow:hidden" class="stat-icon">
                <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,0.25),transparent);border-radius:inherit"></div>
                <svg width="24" height="24" fill="none" stroke="#fff" stroke-width="1.8" viewBox="0 0 24 24" style="position:relative;z-index:1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
                </svg>
            </div>
            <div>
                <p style="font-size:13px;font-weight:500;color:#94a3b8;margin:0;text-transform:uppercase;letter-spacing:0.05em">{{ $stat['label'] }}</p>
                <p style="font-size:34px;font-weight:700;color:#1e293b;letter-spacing:-1px;margin:2px 0 0 0;line-height:1">{{ $stat['value'] }}</p>
            </div>
        </div>
        <div style="margin-top:16px;height:4px;background:#f1ece8;border-radius:10px;overflow:hidden;position:relative;z-index:1">
            <div style="height:100%;border-radius:10px;width:{{ min(100, $stat['value'] * 10) }}%;background:linear-gradient(90deg,{{ $stat['from'] }},{{ $stat['to'] }});transition:width .8s ease"></div>
        </div>
    </div>
    @endforeach
</div>

@php
    use App\Models\Inventario;
    $ventasHoy = Venta::today()->count();
    $ventasHoyTotal = Venta::today()->sum('Total_Ven');
    $bajoStock = Producto::lowStock(5)->count();
    $agotados = Producto::where('Cant_pro', '<=', 0)->count();
    $ultimasVentas = Venta::with('producto')->latest('Fecha_Ven')->take(5)->get();
    $inventarioCount = Inventario::count();
@endphp

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:16px;margin-bottom:32px">
    <div class="card" style="padding:20px">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
            <div style="width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#10b981,#059669);display:flex;align-items:center;justify-content:center">
                <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 style="font-size:14px;font-weight:600;color:#1e293b;margin:0">Alertas de Stock</h3>
        </div>
        <div style="display:flex;gap:12px">
            <div style="flex:1;background:#fef2f2;border-radius:10px;padding:12px;text-align:center">
                <div style="font-size:20px;font-weight:800;color:#b91c1c">{{ $agotados }}</div>
                <div style="font-size:10px;color:#991b1b;font-weight:600;text-transform:uppercase;letter-spacing:0.5px">Agotados</div>
            </div>
            <div style="flex:1;background:#fefce8;border-radius:10px;padding:12px;text-align:center">
                <div style="font-size:20px;font-weight:800;color:#b45309">{{ $bajoStock }}</div>
                <div style="font-size:10px;color:#92400e;font-weight:600;text-transform:uppercase;letter-spacing:0.5px">Stock Bajo</div>
            </div>
            <div style="flex:1;background:#f0fdf4;border-radius:10px;padding:12px;text-align:center">
                <div style="font-size:20px;font-weight:800;color:#047857">{{ $inventarioCount }}</div>
                <div style="font-size:10px;color:#166534;font-weight:600;text-transform:uppercase;letter-spacing:0.5px">Registros</div>
            </div>
        </div>
        <a href="{{ route('inventarios.index') }}" style="display:block;margin-top:12px;font-size:12px;font-weight:600;color:#ea580c;text-decoration:none;text-align:center">Ir a Inventario →</a>
    </div>

    <div class="card" style="padding:20px">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
            <div style="width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#f97316,#ea580c);display:flex;align-items:center;justify-content:center">
                <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 style="font-size:14px;font-weight:600;color:#1e293b;margin:0">Resumen del D&iacute;a</h3>
        </div>
        <div style="display:flex;gap:12px">
            <div style="flex:1;background:#fff7ed;border-radius:10px;padding:12px;text-align:center">
                <div style="font-size:20px;font-weight:800;color:#c2410c">{{ $ventasHoy }}</div>
                <div style="font-size:10px;color:#9a3412;font-weight:600;text-transform:uppercase;letter-spacing:0.5px">Ventas Hoy</div>
            </div>
            <div style="flex:1;background:#ecfdf5;border-radius:10px;padding:12px;text-align:center">
                <div style="font-size:20px;font-weight:800;color:#047857">${{ number_format($ventasHoyTotal, 0) }}</div>
                <div style="font-size:10px;color:#166534;font-weight:600;text-transform:uppercase;letter-spacing:0.5px">Total Hoy</div>
            </div>
        </div>
        <a href="{{ route('ventas.index') }}" style="display:block;margin-top:12px;font-size:12px;font-weight:600;color:#ea580c;text-decoration:none;text-align:center">Ver todas las ventas →</a>
    </div>

    <div class="card" style="padding:20px">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px">
            <div style="width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#3b82f6,#2563eb);display:flex;align-items:center;justify-content:center">
                <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h3 style="font-size:14px;font-weight:600;color:#1e293b;margin:0">&Uacute;ltimas Ventas</h3>
        </div>
        @if ($ultimasVentas->isEmpty())
            <p style="font-size:12px;color:#94a3b8;text-align:center;padding:12px 0">Sin ventas recientes</p>
        @else
            <div style="display:flex;flex-direction:column;gap:6px">
                @foreach ($ultimasVentas as $v)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:6px 10px;background:#f8fafc;border-radius:8px">
                    <div>
                        <span style="font-size:12px;font-weight:600;color:#1e293b">{{ $v->producto->Nom_pro ?? '—' }}</span>
                        <span style="font-size:11px;color:#94a3b8;margin-left:6px">x{{ $v->Cant_Ven }}</span>
                    </div>
                    <span style="font-size:12px;font-weight:600;color:#047857">${{ number_format($v->Total_Ven, 0) }}</span>
                </div>
                @endforeach
            </div>
        @endif
        <a href="{{ route('ventas.index') }}" style="display:block;margin-top:8px;font-size:12px;font-weight:600;color:#ea580c;text-decoration:none;text-align:center">Ver todas →</a>
    </div>
</div>

<div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between">
    <div>
        <h2 style="font-size:20px;font-weight:700;color:#1e293b;letter-spacing:-0.4px;margin:0">Módulos del sistema</h2>
        <p style="font-size:14px;color:#94a3b8;margin:4px 0 0 0">Accede a cada sección para gestionar tu negocio</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px">
    @foreach ($modules as $module)
    <a href="{{ route($module['route']) }}" style="display:block;background:#fff;border-radius:20px;border:1px solid rgba(255,255,255,0.8);padding:24px;text-decoration:none;box-shadow:0 1px 3px rgba(0,0,0,0.04),0 4px 16px rgba(249,115,22,0.04);transition:all .3s cubic-bezier(.34,1.56,.64,1);position:relative;overflow:hidden" class="module-card">
        <div style="position:absolute;top:0;right:0;width:140px;height:140px;border-radius:50%;background:{{ $module['bg'] }};transform:translate(35%,-35%);opacity:.6;transition:all .4s ease" class="module-glow"></div>
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;position:relative;z-index:1">
            <div style="width:48px;height:48px;border-radius:16px;background:linear-gradient(135deg,{{ $module['bg'] }},#fff);display:flex;align-items:center;justify-content:center;color:{{ $module['color'] }};border:1.5px solid {{ $module['bg'] }};transition:all .3s" class="module-icon">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $module['icon'] }}"/>
                </svg>
            </div>
            <span style="display:inline-flex;align-items:center;padding:4px 14px;border-radius:9999px;font-size:12px;font-weight:600;background:#f8f4f0;color:#94a3b8;border:1px solid #f1ece8;transition:all .25s" class="module-badge">{{ $module['count'] }}</span>
        </div>
        <div style="position:relative;z-index:1">
            <h3 style="font-size:16px;font-weight:600;color:#1e293b;margin:0;transition:color .2s" class="module-title">{{ $module['title'] }}</h3>
            <p style="margin-top:6px;font-size:14px;color:#94a3b8;line-height:1.6">{{ $module['desc'] }}</p>
            <div style="margin-top:16px;display:flex;align-items:center;font-size:13px;font-weight:600;color:#ea580c;opacity:0;transition:all .25s cubic-bezier(.34,1.56,.64,1)" class="module-cta">
                <span>Acceder al módulo</span>
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" style="margin-left:6px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </div>
    </a>
    @endforeach
</div>

<style>
    @keyframes pulse{0%,100%{opacity:1}50%{opacity:.5}}
    @media(min-width:768px){.status-dot{display:flex !important}}
    .stat-card:nth-child(1){animation-delay:0s}
    .stat-card:nth-child(2){animation-delay:.08s}
    .stat-card:nth-child(3){animation-delay:.16s}
    .stat-card:nth-child(4){animation-delay:.24s}
    .stat-card:hover{box-shadow:0 8px 32px rgba(249,115,22,0.08) !important;transform:translateY(-4px) !important;border-color:rgba(249,115,22,0.15) !important}
    .stat-card:hover .stat-icon{transform:scale(1.1) rotate(-3deg) !important}
    .module-card:hover{box-shadow:0 12px 40px rgba(249,115,22,0.08) !important;transform:translateY(-4px) !important;border-color:rgba(249,115,22,0.2) !important}
    .module-card:hover .module-icon{transform:scale(1.05) rotate(2deg);border-color:{{ $module['color'] }} !important;box-shadow:0 4px 12px rgba(0,0,0,0.05) !important}
    .module-card:hover .module-glow{transform:translate(25%,-35%) scale(1.4) !important;opacity:.8 !important}
    .module-card:hover .module-title{color:#ea580c !important}
    .module-card:hover .module-cta{opacity:1 !important;transform:translateX(8px) !important}
    .module-card:hover .module-badge{background:#fff7ed !important;color:#ea580c !important;border-color:#fed7aa !important}
</style>
@endSection
