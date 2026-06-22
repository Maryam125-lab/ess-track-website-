<?php

namespace App\Http\Controllers;

use App\Services\ChatService;
use App\Services\PromotionRepository;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function message(Request $request, ChatService $chat, PromotionRepository $promotions)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'lead.name' => 'nullable|string|max:150',
            'lead.email' => 'nullable|email|max:150',
            'lead.phone' => 'nullable|string|max:30',
            'lead.package_interest' => 'nullable|string|max:100',
            'history' => 'nullable|array|max:10',
            'history.*.role' => 'required|in:user,assistant',
            'history.*.text' => 'required|string|max:1000',
        ]);

        return response()->json($chat->reply(
            $request->message,
            $promotions,
            $request->input('lead', []),
            $request->input('history', [])
        ));
    }
}
