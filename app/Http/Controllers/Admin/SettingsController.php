<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsRepository;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(CmsRepository $cms)
    {
        return view('admin.settings.index', ['settings' => $cms->getSettings()]);
    }

    public function update(Request $request, CmsRepository $cms)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'brand_name' => 'required|string|max:100',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:150',
            'address' => 'required|string|max:500',
            'facebook' => 'nullable|url|max:300',
            'whatsapp' => 'nullable|url|max:300',
            'default_og_image' => 'nullable|string|max:500',
        ]);

        $data = array_map(fn ($value) => is_string($value) ? $this->cleanText($value) : $value, $data);

        $cms->saveSettings($data);

        return back()->with('success', 'Site settings saved successfully.');
    }

    protected function cleanText(string $value): string
    {
        return trim(str_replace(['â€”', 'â€“', 'â€"', 'â€', 'Â·', 'Â', '—', '–'], ['-', '-', '-', '', '-', '', '-', '-'], $value));
    }
}
