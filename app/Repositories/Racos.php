<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use SoapClient;

class Racos
{
    /**
     * Get tracking CONS Info
     */
    public static function info($code)
    {
        $payload = [
            'body' => [
                'cons_number' => $code,
            ]
        ];
        $signature = Delta::sign($payload);
        return Http::withToken(Delta::token())
            // ->retry(2, 1500)
            ->connectTimeout(100000)
            ->withOptions([
                'stream' => true,
            ])
            ->withBody(json_encode([
                'request'   => $payload,
                'signature' => $signature
            ]), 'application/json')
            ->get(config('delta.rest.url') . '/v3/track/cons-number-detail');
    }
}
