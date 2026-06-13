<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotFaq extends Model
{
    protected $table = 'chatbot_faqs';

    protected $fillable = ['question', 'answer', 'keywords', 'status', 'sort_order'];

    public function scopeActive($query)
    {
        return $query->where('status', 'active')->orderBy('sort_order');
    }
}
