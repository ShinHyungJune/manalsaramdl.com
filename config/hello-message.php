<?php

use Illuminate\Support\Str;

// 카카오톡 알림톡 발송 API
return [
    'key' => env('HELLO_MESSAGE_KEY', 'NCSP8CNBZWJ5TGLH'),
    'secret' => env('HELLO_MESSAGE_SECRET', 'CUHSSAHVPUL3EPF8OK2SXR4LZDVIVZ62'),
    // 'pf_id' => env('HELLO_MESSAGE_PF_ID', 'KA01PF220906075416189VE2ro53T2Fb'),
    'from' => env('HELLO_MESSAGE_FROM', '01030217486'),
];
