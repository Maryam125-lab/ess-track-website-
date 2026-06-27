<?php

return [

    'enabled' => env('CHATBOT_ENABLED', true),

    'ai_enabled' => env('CHATBOT_AI_ENABLED', true),

    'gemini_api_key' => env('GEMINI_API_KEY', ''),

    'gemini_model' => env('GEMINI_MODEL', 'gemini-1.5-flash'),

    'company_phone' => '021-34330887',

    'whatsapp' => 'https://wa.me/923342011104',

    'knowledge' => [
        'ESS-Track by ESSPL is Pakistan\'s GPS vehicle tracking service since 2009.',
        'Packages: Basic Package, Silver Package, Gold Package — with different features and pricing.',
        'Services include real-time GPS tracking, geofencing, speed alerts, 24/7 call center support.',
        'Phone: 021-34330887-88. Email: info@esspl.com.pk. Address: Suite 201, Kawish Crown, Block 6 PECHS, Karachi.',
        'Website pages: Home, Vehicle Tracker, Packages, About, Blog, Success Stories, Contact.',
        'We do not guarantee theft recovery. We provide monitoring and alerts to help protect vehicles.',
        'For exact pricing and installation, contact our team or visit the Packages page.',
    ],

];
