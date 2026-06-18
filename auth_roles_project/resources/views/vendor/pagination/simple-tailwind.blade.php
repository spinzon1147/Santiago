@if ($paginator->hasPages())
    <nav style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-top:24px;padding:16px 20px;background:#fff;border-radius:14px;border:1px solid #f1f5f9">
        <div style="font-size:13px;color:#94a3b8">
            P&aacute;gina {{ $paginator->currentPage() }}
        </div>

        <div style="display:flex;gap:4px;align-items:center">
            @if ($paginator->onFirstPage())
                <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:10px;color:#cbd5e1;cursor:default;font-size:13px;font-weight:600;background:#f8fafc;border:1px solid #f1f5f9">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="display:inline-flex;align-items:center;gap:4px;padding:0 12px;height:34px;border-radius:10px;color:#64748b;text-decoration:none;font-size:13px;font-weight:600;background:#fff;border:1px solid #e2e8f0;transition:all 0.2s" onmouseover="this.style.background='#fff7ed';this.style.borderColor='#fed7aa';this.style.color='#ea580c'" onmouseout="this.style.background='#fff';this.style.borderColor='#e2e8f0';this.style.color='#64748b'">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Anterior
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="display:inline-flex;align-items:center;gap:4px;padding:0 12px;height:34px;border-radius:10px;color:#64748b;text-decoration:none;font-size:13px;font-weight:600;background:#fff;border:1px solid #e2e8f0;transition:all 0.2s" onmouseover="this.style.background='#fff7ed';this.style.borderColor='#fed7aa';this.style.color='#ea580c'" onmouseout="this.style.background='#fff';this.style.borderColor='#e2e8f0';this.style.color='#64748b'">
                    Siguiente
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span style="display:inline-flex;align-items:center;gap:4px;padding:0 12px;height:34px;border-radius:10px;color:#cbd5e1;cursor:default;font-size:13px;font-weight:600;background:#f8fafc;border:1px solid #f1f5f9">
                    Siguiente
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
