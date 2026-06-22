<?php

namespace Tests\Unit;

use App\Services\ChatService;
use App\Services\PromotionRepository;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ChatServiceTest extends TestCase
{
    public function test_ai_response_is_used_when_gemini_is_configured(): void
    {
        config([
            'chatbot.ai_enabled' => true,
            'chatbot.gemini_api_key' => 'test-key',
            'chatbot.gemini_model' => 'gemini-test-model',
            'cms.json_store' => storage_path('framework/testing/chat-store.json'),
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [[
                    'content' => ['parts' => [['text' => 'A concise verified tracking answer.']]],
                ]],
            ]),
        ]);

        $result = app(ChatService::class)->reply(
            'How does GPS vehicle tracking support work?',
            app(PromotionRepository::class),
            ['name' => 'Test User', 'email' => 'test@example.com', 'phone' => '03001234567'],
            [['role' => 'user', 'text' => 'I need help with my vehicle.']]
        );

        $this->assertSame('ai', $result['source']);
        $this->assertSame('A concise verified tracking answer.', $result['reply']);
        Http::assertSent(fn ($request) => str_contains($request->url(), 'gemini-test-model'));
    }
}
