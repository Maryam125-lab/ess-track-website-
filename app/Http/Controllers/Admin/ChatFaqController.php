<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatFaqController extends Controller
{
    public function index(ChatService $chat)
    {
        return view('admin.chatbot.index', ['faqs' => $chat->allFaqs()]);
    }

    public function create()
    {
        return view('admin.chatbot.form', ['faq' => null]);
    }

    public function store(Request $request, ChatService $chat)
    {
        $chat->saveFaq($this->validated($request));

        return redirect()->route('admin.chatbot.index')->with('success', 'Chatbot FAQ added.');
    }

    public function edit(int $id, ChatService $chat)
    {
        $faq = collect($chat->allFaqs())->firstWhere('id', $id);
        if (! $faq) {
            abort(404);
        }

        return view('admin.chatbot.form', compact('faq'));
    }

    public function update(Request $request, int $id, ChatService $chat)
    {
        $chat->saveFaq($this->validated($request), $id);

        return redirect()->route('admin.chatbot.index')->with('success', 'FAQ updated.');
    }

    public function destroy(int $id, ChatService $chat)
    {
        $chat->deleteFaq($id);

        return redirect()->route('admin.chatbot.index')->with('success', 'FAQ deleted.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string|max:2000',
            'keywords' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
