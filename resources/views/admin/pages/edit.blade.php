@extends('layouts.admin')

@section('title', $pageName)
@section('page_title', $pageName)

@php
    $packagesSeed = [];
    $addonsSeed = [];

    if ($pageKey === 'services') {
        $packagesRaw = old('packages_json', $content['packages_json'] ?? '[]');
        $addonsRaw = old('addons_json', $content['addons_json'] ?? '[]');
        $packagesSeed = json_decode($packagesRaw, true);
        $addonsSeed = json_decode($addonsRaw, true);
        $packagesSeed = is_array($packagesSeed) ? $packagesSeed : [];
        $addonsSeed = is_array($addonsSeed) ? $addonsSeed : [];
    }
@endphp

@section('styles')
<style>
    .builder-note{background:#fff7ed;border:1px solid #fed7aa;color:#9a3412;border-radius:10px;padding:12px 14px;font-size:13px;margin:10px 0 16px;}
    .builder-list{display:grid;gap:14px;}
    .builder-item{border:1px solid #e5e7eb;border-radius:12px;padding:16px;background:#fbfbfc;}
    .builder-head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px;}
    .builder-head strong{font-size:15px;color:#111827;}
    .builder-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
    .builder-grid .wide{grid-column:1 / -1;}
    .builder-grid .half{grid-column:span 2;}
    .builder-small{font-size:12px;color:#6b7280;margin-top:5px;}
    .builder-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:14px;}
    .check-row{display:flex;align-items:center;gap:8px;height:38px;}
    .check-row input{width:auto;}
    @media(max-width:900px){.builder-grid{grid-template-columns:1fr}.builder-grid .half{grid-column:1}.builder-head{align-items:flex-start;flex-direction:column}}
</style>
@endsection

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:18px;">
    <div>
        <h2>{{ $pageName }}</h2>
        <p class="muted">Text fields edit karein. Image/video ke liye URL paste karein ya file upload karein. Packages ke liye form builder use karein, JSON touch karne ki zaroorat nahi.</p>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Pages</a>
        @if($pageKey === 'global')<a href="{{ route('home') }}" target="_blank" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> View Website</a>@else<a href="{{ route($pageKey) }}" target="_blank" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> View Page</a>@endif
    </div>
</div>

<form method="POST" action="{{ route('admin.pages.update', $pageKey) }}" enctype="multipart/form-data" id="pageContentForm">
    @csrf
    @foreach($fieldGroups as $group => $fields)
        <div class="card">
            <h2 style="font-size:18px;text-transform:capitalize;">{{ str_replace('_', ' ', $group) }}</h2>
            <div class="grid-2">
                @foreach($fields as $label => $field)
                    @php
                        [$fieldKey, $type, $default] = $field;
                        $value = old($fieldKey, $content[$fieldKey] ?? $default);
                    @endphp
                    <div class="form-group" style="{{ in_array($type, ['textarea', 'json', 'html']) ? 'grid-column:1 / -1;' : '' }}">
                        <label>{{ $label }}</label>
                        @if($type === 'textarea')
                            <textarea name="{{ $fieldKey }}" rows="4">{{ $value }}</textarea>
                        @elseif($type === 'html')
                            <textarea name="{{ $fieldKey }}" rows="18" style="font-family:Consolas,monospace;font-size:12px;" placeholder="Optional HTML. Leave empty to use current default SLA text.">{{ $value }}</textarea>
                            <p class="muted" style="margin-top:6px;">Optional: agar empty chhorenge to current website agreement text hi show hoga.</p>
                        @elseif($type === 'json' && $fieldKey === 'packages_json')
                            <input type="hidden" name="{{ $fieldKey }}" id="packages_json_input" value="{{ e($value) }}">
                            <div class="builder-note">Yahan se packages add, edit, delete karein. Save ke baad Packages page par changes show honge.</div>
                            <div id="packageBuilder" class="builder-list"></div>
                            <div class="builder-actions">
                                <button type="button" class="btn btn-primary" onclick="addPackage()"><i class="fas fa-plus"></i> Add Package</button>
                            </div>
                        @elseif($type === 'json' && $fieldKey === 'addons_json')
                            <input type="hidden" name="{{ $fieldKey }}" id="addons_json_input" value="{{ e($value) }}">
                            <div class="builder-note">Add-on devices/services yahan manage karein.</div>
                            <div id="addonBuilder" class="builder-list"></div>
                            <div class="builder-actions">
                                <button type="button" class="btn btn-primary" onclick="addAddon()"><i class="fas fa-plus"></i> Add Add-on</button>
                            </div>
                        @elseif($type === 'json')
                            <textarea name="{{ $fieldKey }}" rows="16" style="font-family:Consolas,monospace;font-size:12px;">{{ $value }}</textarea>
                        @elseif($type === 'media')
                            <input type="text" name="{{ $fieldKey }}" value="{{ $value }}" placeholder="images/uploads/file.jpg or https://...">
                            <input type="file" name="{{ $fieldKey }}_file" accept="image/*,video/*" style="margin-top:8px;">
                            @if($value)<p class="muted" style="margin-top:6px;">Current: {{ $value }}</p>@endif
                        @else
                            <input type="text" name="{{ $fieldKey }}" value="{{ $value }}">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Save Page Content</button>
</form>

@if($pageKey === 'services')
<script>
    let packagesData = @json($packagesSeed);
    let addonsData = @json($addonsSeed);

    function emptyPackage() {
        return { type: 'rental', badge: '', name: '', price: '', unit: '/Total', popular: false, breakdown: [], features: [] };
    }

    function emptyAddon() {
        return { name: '', price: '', description: '' };
    }

    function esc(value) {
        return String(value ?? '').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    }

    function breakdownToText(rows) {
        return Array.isArray(rows) ? rows.map((row) => `${row?.[0] ?? ''} | ${row?.[1] ?? ''}`).join('\n') : '';
    }

    function textToBreakdown(value) {
        return String(value || '').split('\n').map((line) => line.trim()).filter(Boolean).map((line) => {
            const parts = line.split('|');
            return [parts[0]?.trim() || '', parts.slice(1).join('|').trim() || ''];
        });
    }

    function featuresToText(rows) {
        return Array.isArray(rows) ? rows.join('\n') : '';
    }

    function textToFeatures(value) {
        return String(value || '').split('\n').map((line) => line.trim()).filter(Boolean);
    }

    function addPackage() {
        packagesData.push(emptyPackage());
        renderPackages();
    }

    function removePackage(index) {
        if (!confirm('Delete this package?')) return;
        packagesData.splice(index, 1);
        renderPackages();
    }

    function addAddon() {
        addonsData.push(emptyAddon());
        renderAddons();
    }

    function removeAddon(index) {
        if (!confirm('Delete this add-on?')) return;
        addonsData.splice(index, 1);
        renderAddons();
    }

    function renderPackages() {
        const wrap = document.getElementById('packageBuilder');
        wrap.innerHTML = packagesData.map((pkg, index) => `
            <div class="builder-item" data-package-index="${index}">
                <div class="builder-head">
                    <strong>Package ${index + 1}: ${esc(pkg.name || 'New package')}</strong>
                    <button type="button" class="btn btn-danger" onclick="removePackage(${index})"><i class="fas fa-trash"></i> Delete</button>
                </div>
                <div class="builder-grid">
                    <div><label>Type</label><select data-field="type"><option value="rental" ${pkg.type === 'rental' ? 'selected' : ''}>Rental</option><option value="device" ${pkg.type === 'device' ? 'selected' : ''}>With Device</option></select></div>
                    <div><label>Name</label><input type="text" data-field="name" value="${esc(pkg.name || '')}"></div>
                    <div><label>Badge</label><input type="text" data-field="badge" value="${esc(pkg.badge || '')}" placeholder="Starter / Popular"></div>
                    <div><label>Popular</label><label class="check-row"><input type="checkbox" data-field="popular" ${pkg.popular ? 'checked' : ''}> Highlight card</label></div>
                    <div><label>Price</label><input type="text" data-field="price" value="${esc(pkg.price || '')}" placeholder="PKR 18,500"></div>
                    <div><label>Unit</label><input type="text" data-field="unit" value="${esc(pkg.unit || '')}" placeholder="/Total"></div>
                    <div class="half"><label>Breakdown</label><textarea data-field="breakdown" rows="5" placeholder="VTU Unit | PKR 0\nInstallation | PKR 2,500">${esc(breakdownToText(pkg.breakdown))}</textarea><div class="builder-small">One line per item: Label | Amount</div></div>
                    <div class="half"><label>Features</label><textarea data-field="features" rows="5" placeholder="24/7 Monitoring\nRemote Shutdown">${esc(featuresToText(pkg.features))}</textarea><div class="builder-small">One feature per line</div></div>
                </div>
            </div>
        `).join('');
        bindPackageInputs();
        syncBuilders();
    }

    function renderAddons() {
        const wrap = document.getElementById('addonBuilder');
        wrap.innerHTML = addonsData.map((addon, index) => `
            <div class="builder-item" data-addon-index="${index}">
                <div class="builder-head">
                    <strong>Add-on ${index + 1}: ${esc(addon.name || 'New add-on')}</strong>
                    <button type="button" class="btn btn-danger" onclick="removeAddon(${index})"><i class="fas fa-trash"></i> Delete</button>
                </div>
                <div class="builder-grid">
                    <div><label>Name</label><input type="text" data-field="name" value="${esc(addon.name || '')}"></div>
                    <div><label>Price</label><input type="text" data-field="price" value="${esc(addon.price || '')}"></div>
                    <div class="half"><label>Description</label><input type="text" data-field="description" value="${esc(addon.description || '')}"></div>
                </div>
            </div>
        `).join('');
        bindAddonInputs();
        syncBuilders();
    }

    function bindPackageInputs() {
        document.querySelectorAll('[data-package-index]').forEach((item) => {
            const index = Number(item.dataset.packageIndex);
            item.querySelectorAll('[data-field]').forEach((input) => {
                input.addEventListener('input', () => updatePackage(index, input));
                input.addEventListener('change', () => updatePackage(index, input));
            });
        });
    }

    function bindAddonInputs() {
        document.querySelectorAll('[data-addon-index]').forEach((item) => {
            const index = Number(item.dataset.addonIndex);
            item.querySelectorAll('[data-field]').forEach((input) => {
                input.addEventListener('input', () => updateAddon(index, input));
                input.addEventListener('change', () => updateAddon(index, input));
            });
        });
    }

    function updatePackage(index, input) {
        const field = input.dataset.field;
        if (field === 'popular') packagesData[index][field] = input.checked;
        else if (field === 'breakdown') packagesData[index][field] = textToBreakdown(input.value);
        else if (field === 'features') packagesData[index][field] = textToFeatures(input.value);
        else packagesData[index][field] = input.value;
        syncBuilders();
    }

    function updateAddon(index, input) {
        addonsData[index][input.dataset.field] = input.value;
        syncBuilders();
    }

    function syncBuilders() {
        const packagesInput = document.getElementById('packages_json_input');
        const addonsInput = document.getElementById('addons_json_input');
        if (packagesInput) packagesInput.value = JSON.stringify(packagesData);
        if (addonsInput) addonsInput.value = JSON.stringify(addonsData);
    }

    document.getElementById('pageContentForm').addEventListener('submit', syncBuilders);
    renderPackages();
    renderAddons();
</script>
@endif
@endsection