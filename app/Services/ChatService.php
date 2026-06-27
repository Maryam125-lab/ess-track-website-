<?php

namespace App\Services;

use App\Models\ChatbotFaq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ChatService
{
    public function reply(string $message, PromotionRepository $promotions, array $lead = [], array $history = []): array
    {
        $message = trim($message);

        if ($message === '') {
            return $this->response('Please type your question.', 'system');
        }

        if ($this->isIrrelevant($message)) {
            $blocked = 'This assistant is only for ESS-Track GPS tracking questions. Please ask about packages, pricing, installation, contact, promotions, or vehicle tracking.';
            $this->logChat($message, $blocked, 'blocked', $lead);

            return $this->response($blocked, 'blocked');
        }

        if (config('chatbot.ai_enabled') && config('chatbot.gemini_api_key')) {
            $ai = $this->askAi($message, $promotions, $history);
            if ($ai) {
                $this->logChat($message, $ai, 'ai', $lead);

                return $this->response($ai, 'ai');
            }
        } else {
            error_log('Gemini chatbot not configured: ' . json_encode([
                'ai_enabled' => (bool) config('chatbot.ai_enabled'),
                'has_key' => (bool) config('chatbot.gemini_api_key'),
                'model' => config('chatbot.gemini_model'),
            ]));
        }

        $direct = $this->directReply($message, $promotions);
        if ($direct) {
            $this->logChat($message, $direct, 'knowledge', $lead);

            return $this->response($direct, 'knowledge');
        }

        $faq = $this->matchFaq($message);
        if ($faq) {
            $this->logChat($message, $faq['answer'], 'faq', $lead);

            return $this->response($faq['answer'], 'faq');
        }

        $knowledge = $this->searchKnowledge($message, $promotions);
        if ($knowledge) {
            $this->logChat($message, $knowledge, 'knowledge', $lead);

            return $this->response($knowledge, 'knowledge');
        }

        $contact = $this->contactDetails();
        $fallback = "For this question, please contact our team directly for an accurate answer:\n\n"
            . "Call: {$contact['phone']}\n"
            . "WhatsApp: {$contact['whatsapp']}\n"
            . 'Contact form: ' . url('/contact');

        $this->logChat($message, $fallback, 'fallback', $lead);

        return $this->response($fallback, 'fallback', true);
    }

    protected function contactDetails(): array
    {
        $settings = app(CmsRepository::class)->getSettings();
        $phone = $settings['phone'] ?? '021-34330887-88';
        $whatsapp = $settings['whatsapp'] ?? 'https://wa.me/923342011104';
        if (! preg_match('#^https?://#i', $whatsapp)) {
            $number = preg_replace('/[^0-9+]/', '', $whatsapp) ?: '923342011104';
            $whatsapp = 'https://wa.me/' . $number;
        }

        return [
            'phone' => $phone,
            'whatsapp' => $whatsapp,
            'email' => $settings['email'] ?? 'info@esspl.com.pk',
            'address' => $settings['address'] ?? 'Suite 201, Kawish Crown, Block 6 PECHS, Karachi',
        ];
    }

    protected function isIrrelevant(string $message): bool
    {
        $msg = strtolower($message);
        $onTopic = ['ess', 'track', 'gps', 'vehicle', 'package', 'tracker', 'fleet', 'install',
            'price', 'contact', 'promo', 'discount', 'referral', 'code', 'car', 'silver', 'gold',
            'basic', 'platinum', 'monitor', 'geo', 'fence', 'whatsapp', 'phone', 'order', 'book',
            'rental', 'device', 'tracking', 'esspl', 'location', 'engine', 'shutdown', 'offer'];

        foreach ($onTopic as $word) {
            if (str_contains($msg, $word)) {
                return false;
            }
        }

        $offTopic = ['weather', 'cricket', 'football', 'recipe', 'joke', 'movie', 'song', 'game',
            'homework', 'math', 'politics', 'bitcoin', 'crypto', 'iphone', 'android phone', 'dating',
            'love', 'marriage', 'doctor', 'medicine', 'school', 'university exam'];

        foreach ($offTopic as $word) {
            if (str_contains($msg, $word)) {
                return true;
            }
        }

        return false;
    }

    protected function directReply(string $message, PromotionRepository $promotions): ?string
    {
        $msg = strtolower($message);
        $contact = $this->contactDetails();

        $packageWords = ['package', 'packages', 'price', 'pricing', 'rate', 'rates', 'silver', 'gold',
            'basic', 'platinum', 'rental', 'device', 'qeemat', 'kitna', 'kitnay'];
        foreach ($packageWords as $word) {
            if (str_contains($msg, $word)) {
                return 'We offer Basic, Silver, Gold, Platinum and fleet GPS tracking options. Exact pricing depends on the vehicle type, device and selected plan. Please check the Packages page or call ' . $contact['phone'] . ' for an accurate quote.';
            }
        }

        $contactWords = ['contact', 'phone', 'call', 'whatsapp', 'number', 'email', 'address', 'rabta'];
        foreach ($contactWords as $word) {
            if (str_contains($msg, $word)) {
                return 'You can contact ESS-Track here: Call ' . $contact['phone'] . ', WhatsApp ' . $contact['whatsapp'] . ', or email ' . $contact['email'] . '. Office: ' . $contact['address'] . '.';
            }
        }

        $promoWords = ['promo', 'promotion', 'discount', 'code', 'offer', 'referral'];
        foreach ($promoWords as $word) {
            if (str_contains($msg, $word)) {
                $active = $promotions->activeFor('home');
                if (count($active)) {
                    $lines = ['Current promotions:'];
                    foreach ($active as $p) {
                        $lines[] = '- ' . ($p['title'] ?? '') . ' - Code: ' . ($p['promo_code'] ?? 'Ask team') . ' - ' . ($p['badge_text'] ?? '');
                    }

                    return implode("\n", $lines);
                }

                return 'No active promo code is available right now. Contact us at ' . $contact['phone'] . ' for referral or seasonal offers.';
            }
        }

        return null;
    }

    protected function matchFaq(string $message): ?array
    {
        $msg = strtolower($message);

        foreach ($this->allFaqs() as $faq) {
            $q = strtolower($faq['question'] ?? '');
            if ($q && (str_contains($msg, $q) || str_contains($q, $msg))) {
                return $faq;
            }

            foreach (explode(',', $faq['keywords'] ?? '') as $kw) {
                $kw = trim(strtolower($kw));
                if ($kw && str_contains($msg, $kw)) {
                    return $faq;
                }
            }
        }

        return null;
    }

    protected function searchKnowledge(string $message, PromotionRepository $promotions): ?string
    {
        $msg = strtolower($message);
        $snippets = config('chatbot.knowledge', []);

        foreach ($promotions->activeFor('home') as $promo) {
            $snippets[] = 'Active offer: ' . ($promo['title'] ?? '')
                . '. Code: ' . ($promo['promo_code'] ?? 'N/A')
                . '. ' . ($promo['description'] ?? '')
                . ' Discount: ' . ($promo['badge_text'] ?? $promo['discount_value'] ?? '');
        }

        $best = null;
        $bestScore = 0;

        foreach ($snippets as $snippet) {
            $score = 0;
            foreach (preg_split('/\s+/', $msg) as $word) {
                if (strlen($word) > 3 && str_contains(strtolower($snippet), $word)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $snippet;
            }
        }

        if ($bestScore >= 2 && $best) {
            return $best . "\n\nNeed more help? Call " . $this->contactDetails()['phone'] . ' or WhatsApp us.';
        }

        return null;
    }

    protected function askAi(string $message, PromotionRepository $promotions, array $history = []): ?string
    {
        $key = config('chatbot.gemini_api_key');
        if (! $key) {
            return null;
        }

        $contact = $this->contactDetails();
        $context = implode("\n", config('chatbot.knowledge', []));
        foreach ($promotions->activeFor('home') as $p) {
            $context .= "\nPromotion: {$p['title']} code {$p['promo_code']} {$p['description']}";
        }
        foreach ($this->allFaqs() as $f) {
            $context .= "\nQ: {$f['question']} A: {$f['answer']}";
        }

        $historyText = collect($history)->take(-8)->map(function ($item) {
            $role = ($item['role'] ?? '') === 'assistant' ? 'ASSISTANT' : 'USER';

            return $role . ': ' . trim((string) ($item['text'] ?? ''));
        })->filter()->implode("\n");

        $prompt = "You are the ESS-Track customer support assistant for a GPS vehicle tracking company in Pakistan.\n"
            . "RULES: Answer only ESS-Track, GPS tracking, packages, installation, promotions and support questions. "
            . "Use only the verified context below. Never invent prices, guarantees or capabilities. "
            . "Reply in natural, concise English. Do not repeat greetings or praise ESSPL in every response. "
            . "Ask one useful follow-up only when needed. If unsure, tell the user to call {$contact['phone']}.\n\n"
            . "VERIFIED CONTEXT:\n{$context}\n\n"
            . ($historyText ? "RECENT CONVERSATION:\n{$historyText}\n\n" : '')
            . "USER: {$message}";

        try {
            $resp = Http::timeout(10)->retry(1, 200)->post(
                'https://generativelanguage.googleapis.com/v1beta/models/' . config('chatbot.gemini_model') . ':generateContent?key=' . $key,
                [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => ['temperature' => 0.35, 'maxOutputTokens' => 350],
                ]
            );

            if ($resp->successful()) {
                $text = $resp->json('candidates.0.content.parts.0.text');

                return $text ? trim($text) : null;
            }
            Log::warning('Gemini chatbot request failed', [
                'status' => $resp->status(),
                'error' => $resp->json('error.message'),
                'model' => config('chatbot.gemini_model'),
            ]);
            error_log('Gemini chatbot request failed: ' . json_encode([
                'status' => $resp->status(),
                'error' => $resp->json('error.message'),
                'model' => config('chatbot.gemini_model'),
            ]));
        } catch (\Throwable $e) {
            Log::warning('Gemini chatbot request exception', [
                'message' => $e->getMessage(),
                'model' => config('chatbot.gemini_model'),
            ]);
            error_log('Gemini chatbot request exception: ' . json_encode([
                'message' => $e->getMessage(),
                'model' => config('chatbot.gemini_model'),
            ]));
            return null;
        }

        return null;
    }

    public function allFaqs(): array
    {
        if (CmsStorage::usesDatabase() && Schema::hasTable('chatbot_faqs')) {
            return ChatbotFaq::active()->get()->toArray();
        }

        return CmsStorage::readJson()['chatbot_faqs'] ?? $this->defaultFaqs();
    }

    public function saveFaq(array $data, ?int $id = null): array
    {
        if (CmsStorage::usesDatabase() && Schema::hasTable('chatbot_faqs')) {
            if ($id) {
                $row = ChatbotFaq::findOrFail($id);
                $row->update($data);

                return $row->fresh()->toArray();
            }

            return ChatbotFaq::create($data)->toArray();
        }

        $store = CmsStorage::readJson();
        $items = $store['chatbot_faqs'] ?? $this->defaultFaqs();

        if ($id) {
            foreach ($items as $i => $item) {
                if ((int) ($item['id'] ?? 0) === $id) {
                    $items[$i] = array_merge($item, $data, ['id' => $id]);
                    $store['chatbot_faqs'] = $items;
                    CmsStorage::writeJson($store);

                    return $items[$i];
                }
            }
        }

        $newId = (collect($items)->max('id') ?? 0) + 1;
        $new = array_merge($data, ['id' => $newId]);
        $items[] = $new;
        $store['chatbot_faqs'] = $items;
        CmsStorage::writeJson($store);

        return $new;
    }

    public function deleteFaq(int $id): void
    {
        if (CmsStorage::usesDatabase() && Schema::hasTable('chatbot_faqs')) {
            ChatbotFaq::destroy($id);

            return;
        }

        $store = CmsStorage::readJson();
        $store['chatbot_faqs'] = array_values(array_filter(
            $store['chatbot_faqs'] ?? [],
            fn ($f) => (int) ($f['id'] ?? 0) !== $id
        ));
        CmsStorage::writeJson($store);
    }

    protected function defaultFaqs(): array
    {
        return CmsStorage::defaultChatFaqs();
    }

    protected function logChat(string $user, string $bot, string $source, array $lead = []): void
    {
        $entry = [
            'user_message' => $user,
            'bot_reply' => $bot,
            'source' => $source,
            'lead_name' => $lead['name'] ?? null,
            'lead_email' => $lead['email'] ?? null,
            'lead_phone' => $lead['phone'] ?? null,
            'package_interest' => $lead['package_interest'] ?? null,
            'created_at' => now()->toDateTimeString(),
        ];

        if (CmsStorage::usesDatabase() && Schema::hasTable('chatbot_logs')) {
            DB::table('chatbot_logs')->insert([
                'user_message' => $entry['user_message'],
                'bot_reply' => $entry['bot_reply'],
                'source' => $entry['source'],
                'lead_name' => $entry['lead_name'],
                'lead_email' => $entry['lead_email'],
                'lead_phone' => $entry['lead_phone'],
                'package_interest' => $entry['package_interest'],
                'created_at' => $entry['created_at'],
            ]);

            return;
        }

        $store = CmsStorage::readJson();
        $logs = $store['chatbot_logs'] ?? [];
        $logs[] = $entry;
        if (count($logs) > 500) {
            $logs = array_slice($logs, -500);
        }
        $store['chatbot_logs'] = $logs;
        CmsStorage::writeJson($store);
    }

    protected function response(string $text, string $source, bool $handoff = false): array
    {
        return [
            'reply' => $text,
            'source' => $source,
            'handoff' => $handoff,
        ];
    }
}
