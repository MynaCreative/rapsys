<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use SoapClient;

class Delta
{
    /**
     * Get tracking AWB
     */
    public static function awb($code)
    {
        $username   = config('delta.soap.username');
        $password   = config('delta.soap.password');
        $wsdl       = config('delta.soap.url');

        $client = new SoapClient($wsdl);

        $result = $client->getTrackingAWB($username, $password, $code, 'json');
        $response = json_decode($result, true);
        return $response;
    }

    /**
     * Get tracking AWB Detail
     */
    public static function awbDetail($code)
    {
        $payload = [
            'body' => [
                'reference_number' => $code,
                'tracking_status_id' => 'SMU'
            ]
        ];
        $signature = self::sign($payload);
        return Http::withToken(self::token())
            ->connectTimeout(100000)
            ->withOptions([
                'stream' => true,
            ])
            ->withBody(json_encode([
                'request'   => $payload,
                'signature' => $signature
            ]), 'application/json')
            ->get(config('delta.rest.url') . '/v3/track/getTrackAwbDetail');
    }

    /**
     * Get tracking AWB Detail
     */
    public static function awbScanCompliance($code, $with_scan, $or_scan)
    {
        $payload = [
            'body' => [
                'awb' => $code,
                'with_scan' => $with_scan,
                'or_scan' => $or_scan,
            ]
        ];
        $signature = self::sign($payload);
        return Http::withToken(self::token())
            ->connectTimeout(100000)
            ->withOptions([
                'stream' => true,
            ])
            ->withBody(json_encode([
                'request'   => $payload,
                'signature' => $signature
            ]), 'application/json')
            ->get(config('delta.rest.url') . '/v3/track/getScanCompliance');
    }

    /**
     * Get tracking AWB Detail
     */
    public static function awbBatch($awb)
    {
        $payload = [
            'body' => [
                'awb' => $awb
            ]
        ];
        $signature = self::sign($payload);
        return Http::withToken(self::token())
            ->connectTimeout(100000)
            ->withOptions([
                'stream' => true,
            ])
            ->withBody(json_encode([
                'request'   => $payload,
                'signature' => $signature
            ]), 'application/json')
            ->get(config('delta.rest.url') . '/v3/tracking/');
    }

    /**
     * Get tracking AWB Detail
     */
    public static function awbBatchStream($awb)
    {
        $payload = [
            'body' => [
                'awb' => $awb
            ]
        ];
        $signature = self::sign($payload);
        return Http::withToken(self::token())
            ->connectTimeout(100000)
            ->withOptions([
                'stream' => true,
            ])
            ->withBody(json_encode([
                'request'   => $payload,
                'signature' => $signature
            ]), 'application/json')
            ->get(config('delta.rest.url') . '/v3/tracking/');
    }

    /**
     * Get tracking AWB Detail
     */
    public static function smu($code)
    {
        $payload = [
            'body' => [
                'smu_number' => $code
            ]
        ];
        $signature = self::sign($payload);
        return Http::withToken(self::token())
            ->connectTimeout(100000)
            ->withOptions([
                'stream' => true,
            ])
            ->withBody(json_encode([
                'request'   => $payload,
                'signature' => $signature
            ]), 'application/json')
            ->get(config('delta.rest.url') . '/v3/track/getSmuDetail');
    }

    /**
     * Get token
     */
    public static function token()
    {
        if (session()->has('delta.rest.timestamp')) {
            $lifetime = now()->diffInSeconds(session('delta.rest.timestamp'));
            if ($lifetime > session('delta.rest.expired')) {
                session()->forget('delta.rest.token');
            }
        }

        if (!session()->has('delta.rest.token')) {
            $username   = config('delta.rest.username');
            $password   = config('delta.rest.password');

            $response = Http::withBasicAuth($username, $password)
                ->withBody(json_encode([
                    'grant_type' => 'client_credential'
                ]), 'application/json')
                ->post(config('delta.rest.url') . '/token');

            session([
                'delta.rest.token'      => $response['data']['token'],
                'delta.rest.expired'    => $response['data']['expired'],
                'delta.rest.timestamp'  => now()
            ]);
        }

        return session('delta.rest.token');
    }

    public static function sign($payload)
    {
        $signature = '';
        $pem = storage_path('pem/rapsys.pem');
        $privateKey = openssl_pkey_get_private(file_get_contents($pem));
        openssl_sign(json_encode($payload), $signature, $privateKey, OPENSSL_ALGO_SHA256);

        return base64_encode($signature);
    }
}
