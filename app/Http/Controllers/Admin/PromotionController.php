<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PromotionRepository;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(PromotionRepository $promotions)
    {
        return view('admin.promotions.index', ['promotions' => $promotions->all()]);
    }

    public function create()
    {
        return view('admin.promotions.form', ['promotion' => null]);
    }

    public function store(Request $request, PromotionRepository $promotions)
    {
        $promotions->save($this->validated($request));

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion created - now visible on website.');
    }

    public function edit(int $id, PromotionRepository $promotions)
    {
        $promotion = $promotions->findById($id);
        if (! $promotion) {
            abort(404);
        }

        return view('admin.promotions.form', compact('promotion'));
    }

    public function update(Request $request, int $id, PromotionRepository $promotions)
    {
        $promotions->save($this->validated($request), $id);

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion updated.');
    }

    public function destroy(int $id, PromotionRepository $promotions)
    {
        $promotions->delete($id);

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'promo_code' => 'nullable|string|max:50',
            'discount_type' => 'required|in:percent,fixed,offer_text',
            'discount_value' => 'nullable|string|max:50',
            'badge_text' => 'nullable|string|max:100',
            'applies_to' => 'required|in:all,basic,silver,gold,tracker',
            'show_on_home' => 'nullable',
            'show_on_services' => 'nullable',
            'show_on_promo_modal' => 'nullable',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
