<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'PataFeliz')) &mdash; Homero Pet Shop</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-homero.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;background:linear-gradient(135deg,#fefaf5 0%,#fff5f0 50%,#fefaf5 100%);color:#1e293b;min-height:100vh;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
        .app-wrap{display:flex;height:100vh;overflow:hidden}
        .main-area{display:flex;flex-direction:column;flex:1;min-width:0;overflow:hidden}
        main{flex:1;overflow-y:auto;padding:32px 36px;width:100%;animation:fadeUp .4s cubic-bezier(.22,1,.36,1)}
        @keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
        
        /* Scrollbar */
        ::-webkit-scrollbar{width:5px;height:5px}
        ::-webkit-scrollbar-track{background:transparent}
        ::-webkit-scrollbar-thumb{background:#e2e8f0;border-radius:10px}
        ::-webkit-scrollbar-thumb:hover{background:#cbd5e1}
        
        /* Alerts */
        .alert-success{background:#ecfdf5;border:1px solid #a7f3d0;border-radius:16px;padding:16px 24px;margin-bottom:24px;color:#047857;font-size:14px;font-weight:500;display:flex;align-items:center;gap:12px;box-shadow:0 1px 3px rgba(0,0,0,0.04);animation:fadeUp .3s ease}
        .alert-error{background:#fef2f2;border:1px solid #fecaca;border-radius:16px;padding:16px 24px;margin-bottom:24px;color:#b91c1c;font-size:14px;font-weight:500;display:flex;align-items:center;gap:12px;box-shadow:0 1px 3px rgba(0,0,0,0.04);animation:fadeUp .3s ease}
        .alert-icon{width:32px;height:32px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .alert-success .alert-icon{background:#d1fae5}
        .alert-error .alert-icon{background:#fee2e2}
        
        /* Cards */
        .card{background:#fff;border-radius:20px;border:1px solid rgba(255,255,255,0.8);padding:32px;box-shadow:0 1px 3px rgba(0,0,0,0.04),0 4px 16px rgba(249,115,22,0.04);backdrop-filter:blur(4px)}
        
        /* Buttons */
        .btn-primary{display:inline-flex;align-items:center;gap:10px;padding:12px 28px;border-radius:14px;border:none;font-size:14px;font-weight:600;color:#fff;cursor:pointer;background:linear-gradient(135deg,#f97316,#ea580c);box-shadow:0 4px 16px rgba(249,115,22,0.25);transition:all .25s cubic-bezier(.34,1.56,.64,1);text-decoration:none;position:relative;overflow:hidden}
        .btn-primary::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,0.15),transparent);opacity:0;transition:opacity .25s}
        .btn-primary:hover::before{opacity:1}
        .btn-primary:hover{transform:translateY(-3px) scale(1.02);box-shadow:0 8px 28px rgba(249,115,22,0.35)}
        .btn-primary:active{transform:translateY(-1px) scale(1);box-shadow:0 4px 12px rgba(249,115,22,0.2)}
        .btn-secondary{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;border-radius:14px;font-size:14px;font-weight:500;color:#64748b;background:transparent;border:1.5px solid #e2e8f0;cursor:pointer;text-decoration:none;transition:all .2s}
        .btn-secondary:hover{color:#0f172a;background:#fff;border-color:#cbd5e1;box-shadow:0 2px 8px rgba(0,0,0,0.04)}
        .btn-pdf{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;border-radius:14px;font-size:14px;font-weight:600;cursor:pointer;text-decoration:none;border:1.5px solid var(--pdf-color);color:var(--pdf-color);background:#fff;transition:all .25s cubic-bezier(.34,1.56,.64,1)}
        .btn-danger{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;border-radius:14px;font-size:14px;font-weight:600;color:#fff;cursor:pointer;background:linear-gradient(135deg,#f87171,#ef4444);border:none;box-shadow:0 4px 16px rgba(239,68,68,0.2);transition:all .25s cubic-bezier(.34,1.56,.64,1);text-decoration:none}
        .btn-danger:hover{transform:translateY(-3px) scale(1.02);box-shadow:0 8px 28px rgba(239,68,68,0.3)}
        
        /* Inputs */
        .input-group{position:relative}
        .input{width:100%;padding:13px 18px;border:2px solid #f1f5f9;border-radius:14px;font-size:14px;background:#fafafa;outline:none;transition:all .2s;font-family:'Inter',sans-serif;color:#1e293b}
        .input:focus{border-color:#fb923c;background:#fff;box-shadow:0 0 0 4px rgba(249,115,22,0.06)}
        .input.is-invalid,.input.is-invalid:focus{border-color:#f87171;background:#fef2f2;box-shadow:0 0 0 4px rgba(239,68,68,0.06)}
        .input::placeholder{color:#b0b8c4;font-weight:400}
        .input-label{display:block;font-size:13px;font-weight:600;color:#475569;margin-bottom:7px;letter-spacing:0.01em}
        .input-error{font-size:13px;color:#ef4444;font-weight:500;margin-top:6px;display:flex;align-items:center;gap:6px}
        
        /* Select */
        select.input{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%2394a3b8' stroke-width='2.5' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 16px center;padding-right:44px}
        
        /* Badges */
        .badge{display:inline-flex;align-items:center;padding:5px 14px;border-radius:9999px;font-size:12px;font-weight:600;letter-spacing:0.01em}
        .badge-success{background:#d1fae5;color:#047857}
        .badge-danger{background:#fee2e2;color:#b91c1c}
        .badge-warning{background:#fef3c7;color:#b45309}
        .badge-info{background:#e0f2fe;color:#0369a1}
        
        /* Table */
        .table-wrap{background:#fff;border-radius:20px;border:1px solid rgba(255,255,255,0.8);overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04),0 4px 16px rgba(249,115,22,0.04);backdrop-filter:blur(4px)}
        .table-scroll{overflow-x:auto}
        table{width:100%;border-collapse:collapse}
        thead{position:sticky;top:0;z-index:1}
        th{text-align:left;padding:16px 20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#94a3b8;background:#fefaf5;border-bottom:1px solid #f1f5f9;white-space:nowrap}
        td{padding:16px 20px;font-size:14px;border-bottom:1px solid #f8f4f0;color:#475569}
        tr:last-child td{border-bottom:none}
        .table-wrap tr{transition:background .15s}
        .table-wrap tr:hover td{background:linear-gradient(90deg,#fff7ed,transparent)}
        
        /* Action links in tables */
        .action-link{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s}
        .action-link-edit{color:#ea580c;background:transparent}
        .action-link-edit:hover{background:#fff7ed;color:#c2410c}
        .action-link-delete{color:#ef4444;background:transparent}
        .action-link-delete:hover{background:#fef2f2;color:#dc2626}
        
        /* Page header */
        .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:16px}
        .page-header h1{font-size:28px;font-weight:700;color:#1e293b;letter-spacing:-0.6px}
        .page-header p{margin-top:4px;font-size:14px;color:#94a3b8}
        
        /* Empty state */
        .empty-state{text-align:center;padding:60px 20px;background:#fefaf5;border-radius:20px}
        .empty-state svg{margin:0 auto 16px;color:#e2e8f0}
        .empty-state p{font-size:15px;color:#94a3b8;margin-bottom:20px}
        
        /* Dividers */
        hr.section-divider{border:none;border-top:1.5px solid #f1ece8;margin:24px 0;border-radius:10px}
        
        /* Back link */
        .back-link{display:inline-flex;align-items:center;gap:6px;font-size:14px;font-weight:500;color:#94a3b8;text-decoration:none;margin-bottom:16px;transition:color 0.2s}
        .back-link:hover{color:#64748b}
    </style>
</head>
<body>
    <div class="app-wrap">
        @include('layouts.sidebar')
        <div class="main-area">
            @include('layouts.topbar')
            <main>
                @if (session('success'))
                    <div class="alert-success">
                        <div class="alert-icon">
                            <svg width="16" height="16" fill="none" stroke="#047857" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert-error">
                        <div class="alert-icon">
                            <svg width="16" height="16" fill="none" stroke="#b91c1c" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
    <script>
        (function() {
            var sidebar = document.getElementById('sidebar');
            var toggle = document.getElementById('sidebarToggle');
            if (sidebar && toggle) {
                var collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (collapsed) sidebar.classList.add('collapsed');
                toggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                });
            }
        })();
    </script>
</body>
</html>
