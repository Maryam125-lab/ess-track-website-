@if(!empty($promotions) && count($promotions) > 0)
<section style="background:linear-gradient(135deg,#0d1b2a,#1b2f45);padding:20px 0;">
    <div class="wrap">
        <div style="display:flex;flex-wrap:wrap;gap:16px;align-items:center;justify-content:center;">
            @foreach($promotions as $promo)
            <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(244,124,32,0.4);border-radius:12px;padding:14px 20px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
                @if(!empty($promo['badge_text']))
                <span style="background:var(--or);color:#fff;font-weight:800;font-size:12px;padding:4px 10px;border-radius:20px;">{{ $promo['badge_text'] }}</span>
                @endif
                <div>
                    <strong style="color:#fff;font-size:14px;">{{ $promo['title'] }}</strong>
                    @if(!empty($promo['description']))
                    <span style="color:rgba(255,255,255,0.65);font-size:12px;display:block;margin-top:2px;">{{ $promo['description'] }}</span>
                    @endif
                </div>
                @if(!empty($promo['promo_code']))
                <code style="background:#fff;color:var(--nv);padding:6px 12px;border-radius:6px;font-weight:700;font-size:13px;">{{ $promo['promo_code'] }}</code>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
