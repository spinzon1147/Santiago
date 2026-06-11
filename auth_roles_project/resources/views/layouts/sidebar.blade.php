@php
    $currentRoute = Route::currentRouteName();
    $menuItems = [
        'dashboard'   => ['label' => 'Dashboard',   'route' => 'dashboard',        'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        'productos'   => ['label' => 'Productos',   'route' => 'productos.index',   'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
        'ventas'      => ['label' => 'Ventas',      'route' => 'ventas.index',      'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z'],
        'compras'     => ['label' => 'Compras',     'route' => 'compras.index',     'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0'],
        'clientes'    => ['label' => 'Clientes',    'route' => 'clientes.index',    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
        'proveedores' => ['label' => 'Proveedores', 'route' => 'proveedores.index', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        'inventarios' => ['label' => 'Inventario',  'route' => 'inventarios.index', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
        'reportes'    => ['label' => 'Reportes',    'route' => 'reportes.index',    'icon' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2zM12 3v4a1 1 0 001 1h4M9 17v-2a3 3 0 016 0v2'],
        'perfil'      => ['label' => 'Mi Perfil',   'route' => 'profile.edit',      'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
    ];
    $isAdmin = Auth::user()->role && Auth::user()->role->name === 'admin';
@endphp

<aside class="gmail-sidebar" id="sidebar">
    <div class="gmail-sidebar-inner">

        {{-- Header --}}
        <div class="gmail-header">
            <button class="gmail-toggle" id="sidebarToggle" title="Colapsar menú">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
            <div class="gmail-brand">
                <img src="{{ asset('images/logo-homero.png') }}" alt="Homero" class="gmail-logo-img">
                <span class="gmail-brand-text">Homero Pet Shop</span>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="gmail-nav">
            <div class="gmail-section-label">General</div>
            @foreach ($menuItems as $key => $item)
                @php $isActive = Route::is($item['route']); @endphp
                <a href="{{ route($item['route']) }}" class="gmail-nav-item {{ $isActive ? 'active' : '' }}" title="{{ $item['label'] }}">
                    <svg class="gmail-nav-icon" width="20" height="20" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                    </svg>
                    <span class="gmail-nav-label">{{ $item['label'] }}</span>
                </a>
            @endforeach

            @if($isAdmin)
                <div class="gmail-section-label">Administración</div>
                @php $isUsers = Route::is('users.*'); @endphp
                <a href="{{ route('users.index') }}" class="gmail-nav-item {{ $isUsers ? 'active' : '' }}" title="Usuarios">
                    <svg class="gmail-nav-icon" width="20" height="20" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="gmail-nav-label">Usuarios</span>
                </a>
            @endif
        </nav>

        {{-- Footer with user --}}
        <div class="gmail-footer">
            <div class="gmail-user">
                <div class="gmail-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                <div class="gmail-user-info">
                    <span class="gmail-user-name">{{ Auth::user()->name }}</span>
                    <span class="gmail-user-role">{{ $isAdmin ? 'Administrador' : 'Usuario' }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="gmail-logout" title="Cerrar sesión">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>

    </div>
</aside>

<style>
.gmail-sidebar {
    display: none;
    width: 256px;
    min-width: 256px;
    background: #fff;
    color: #444746;
    flex-direction: column;
    border-right: 1px solid #e0e0e0;
    position: relative;
    z-index: 100;
    transition: width .2s ease, min-width .2s ease;
}
@media(min-width:1024px){ .gmail-sidebar { display: flex; } }

.gmail-sidebar-inner {
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
}

/* ── Header ── */
.gmail-header {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    height: 56px;
    flex-shrink: 0;
}
.gmail-toggle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: transparent;
    color: #5f6368;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background .15s;
}
.gmail-toggle:hover { background: #f1f3f4; }
.gmail-brand {
    display: flex;
    align-items: center;
    gap: 8px;
    overflow: hidden;
}
.gmail-logo-img {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    object-fit: cover;
    flex-shrink: 0;
}
.gmail-brand-text {
    font-size: 16px;
    font-weight: 600;
    color: #202124;
    white-space: nowrap;
    letter-spacing: -.3px;
}

/* ── Nav ── */
.gmail-nav {
    flex: 1;
    overflow-y: auto;
    padding: 4px 8px;
}
.gmail-nav::-webkit-scrollbar { width: 4px; }
.gmail-nav::-webkit-scrollbar-thumb { background: #e0e0e0; border-radius: 4px; }

.gmail-section-label {
    font-size: 11px;
    font-weight: 600;
    color: #80868b;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 16px 16px 6px;
}

.gmail-nav-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 0 16px;
    height: 40px;
    border-radius: 16px;
    text-decoration: none;
    color: #444746;
    font-size: 14px;
    font-weight: 500;
    transition: background .15s;
    position: relative;
    white-space: nowrap;
}
.gmail-nav-item:hover { background: #f1f3f4; }
.gmail-nav-item.active {
    background: #fef0e8;
    color: #c2410c;
    font-weight: 600;
}
.gmail-nav-item.active .gmail-nav-icon { color: #c2410c; }

.gmail-nav-icon {
    flex-shrink: 0;
    color: #5f6368;
}
.gmail-nav-item.active .gmail-nav-icon { color: #c2410c; }

.gmail-nav-label {
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ── Footer ── */
.gmail-footer {
    flex-shrink: 0;
    border-top: 1px solid #e0e0e0;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.gmail-user {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 0;
}
.gmail-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg,#f97316,#ea580c);
    color: #fff;
    font-weight: 700;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.gmail-user-info {
    display: flex;
    flex-direction: column;
    min-width: 0;
}
.gmail-user-name {
    font-size: 13px;
    font-weight: 600;
    color: #202124;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    line-height: 1.2;
}
.gmail-user-role {
    font-size: 11px;
    color: #80868b;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    line-height: 1.2;
}
.gmail-logout {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    background: transparent;
    color: #5f6368;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background .15s;
}
.gmail-logout:hover { background: #f1f3f4; color: #d93025; }

/* ── Collapsed state (exactly like Gmail) ── */
.gmail-sidebar.collapsed {
    width: 60px;
    min-width: 60px;
}
.gmail-sidebar.collapsed .gmail-brand-text,
.gmail-sidebar.collapsed .gmail-nav-label,
.gmail-sidebar.collapsed .gmail-user-info,
.gmail-sidebar.collapsed .gmail-section-label,
.gmail-sidebar.collapsed .gmail-logout { display: none; }

.gmail-sidebar.collapsed .gmail-header { justify-content: center; padding: 8px 0; }
.gmail-sidebar.collapsed .gmail-brand { display: none; }

.gmail-sidebar.collapsed .gmail-nav { padding: 4px; }
.gmail-sidebar.collapsed .gmail-nav-item {
    justify-content: center;
    padding: 0;
    height: 40px;
    width: 40px;
    margin: 2px auto;
    border-radius: 50%;
}
.gmail-sidebar.collapsed .gmail-nav-item.active {
    border-radius: 50%;
    background: #fef0e8;
}

.gmail-sidebar.collapsed .gmail-footer { justify-content: center; padding: 8px 0; }
.gmail-sidebar.collapsed .gmail-user { justify-content: center; }
.gmail-sidebar.collapsed .gmail-avatar { width: 32px; height: 32px; font-size: 11px; }
</style>
