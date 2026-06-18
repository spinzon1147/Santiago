@if ($paginator->hasPages())
    <nav style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-top:24px;padding:16px 20px;background:#fff;border-radius:14px;border:1px solid #f1f5f9">
        <div style="font-size:13px;color:#94a3b8">
            @if ($paginator->firstItem())
                <span style="font-weight:600;color:#475569">{{ $paginator->firstItem() }}</span>
                — <span style="font-weight:600;color:#475569">{{ $paginator->lastItem() }}</span>
                de <span style="font-weight:600;color:#475569">{{ $paginator->total() }}</span>
                registros
            @else
                {{ $paginator->count() }} registros
            @endif
        </div>

        <div style="display:flex;gap:4px;align-items:center">
            @if ($paginator->onFirstPage())
                <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:10px;color:#cbd5e1;cursor:default;font-size:14px;font-weight:600;background:#f8fafc;border:1px solid #f1f5f9">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:10px;color:#64748b;text-decoration:none;font-size:14px;font-weight:600;background:#fff;border:1px solid #e2e8f0;transition:all 0.2s" onmouseover="this.style.background='#fff7ed';this.style.borderColor='#fed7aa';this.style.color='#ea580c'" onmouseout="this.style.background='#fff';this.style.borderColor='#e2e8f0';this.style.color='#64748b'">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span style="display:inline-flex;align-items:center;justify-content:center;min-width:34px;height:34px;border-radius:10px;color:#94a3b8;font-size:13px;font-weight:600;background:transparent;cursor:default">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span style="display:inline-flex;align-items:center;justify-content:center;min-width:34px;height:34px;border-radius:10px;color:#fff;font-size:13px;font-weight:700;background:linear-gradient(135deg,#f97316,#ea580c);box-shadow:0 2px 8px rgba(249,115,22,0.25);cursor:default">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" style="display:inline-flex;align-items:center;justify-content:center;min-width:34px;height:34px;border-radius:10px;color:#64748b;text-decoration:none;font-size:13px;font-weight:600;background:#fff;border:1px solid #e2e8f0;transition:all 0.2s" onmouseover="this.style.background='#fff7ed';this.style.borderColor='#fed7aa';this.style.color='#ea580c'" onmouseout="this.style.background='#fff';this.style.borderColor='#e2e8f0';this.style.color='#64748b'">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:10px;color:#64748b;text-decoration:none;font-size:14px;font-weight:600;background:#fff;border:1px solid #e2e8f0;transition:all 0.2s" onmouseover="this.style.background='#fff7ed';this.style.borderColor='#fed7aa';this.style.color='#ea580c'" onmouseout="this.style.background='#fff';this.style.borderColor='#e2e8f0';this.style.color='#64748b'">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:10px;color:#cbd5e1;cursor:default;font-size:14px;font-weight:600;background:#f8fafc;border:1px solid #f1f5f9">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
