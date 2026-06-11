<header style="display:none;background:#fff;border-bottom:1px solid #e2e8f0;padding:0 20px;height:64px;align-items:center;justify-content:space-between;flex-shrink:0" class="mobile-header">
    <div style="display:flex;align-items:center;gap:12px">
        <img src="{{ asset('images/logo-homero.png') }}" alt="Homero Pet Shop" style="width:32px;height:32px;border-radius:8px;object-fit:cover;flex-shrink:0;box-shadow:0 4px 8px rgba(249,115,22,0.2)">
        <span style="font-weight:600;color:#1e293b;font-size:14px">Homero Pet Shop</span>
    </div>
    <div style="display:flex;align-items:center;gap:4px">
        <a href="{{ route('profile.edit') }}" style="padding:8px;border-radius:12px;color:#94a3b8;text-decoration:none;transition:all 0.2s" class="topbar-icon">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" style="padding:8px;border-radius:12px;border:none;background:transparent;color:#94a3b8;cursor:pointer;transition:all 0.2s" class="topbar-icon logout-topbar">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>
        </form>
    </div>
</header>

<style>
    @media(max-width:1023px){.mobile-header{display:flex !important}}
    .topbar-icon:hover{color:#475569 !important;background:#f1f5f9 !important}
    .logout-topbar:hover{color:#ef4444 !important;background:#fef2f2 !important}
</style>
