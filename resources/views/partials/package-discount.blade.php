@if(!empty($promo))
<div style="position:absolute;top:14px;left:14px;z-index:5;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;font-size:11px;font-weight:800;padding:6px 12px;border-radius:8px;box-shadow:0 4px 12px rgba(220,38,38,.35);text-align:center;line-height:1.3;">
    {{ $promo['badge_text'] ?? (($promo['discount_value'] ?? '') . '% OFF') }}
    @if(!empty($promo['promo_code']))
    <div style="font-size:9px;font-weight:600;margin-top:3px;opacity:.95;">Code: {{ $promo['promo_code'] }}</div>
    @endif
</div>
@endif
