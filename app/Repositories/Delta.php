<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use SoapClient;
use Exception;

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

        try {
            $result = $client->getTrackingAWB($username, $password, $code, 'json');
            $response = json_decode($result, true);
            return $response;
        } catch ( Exception $e ) {
            return $e->getMessage();
        }
    }

    /**
     * Get tracking AWB Detail
     */
    public static function awbDetail($code)
    {
        $token = self::token();
        return Http::withToken($token)
            ->withBody(json_encode([
                'request'=>[
                    'body' => [
                        'reference_number' => $code,
                        'tracking_status_id' => 'SMU'
                    ]
                ],
                'signature' => ''
            ]), 'application/json')
            ->get(config('delta.rest.url').'/v3/track/getTrackAwbDetail');
    }

    /**
     * Get tracking AWB Detail
     */
    public static function awbBatch($awb)
    {
        $token = self::token();
        return Http::withToken($token)
            ->withBody(json_encode([
                'request'=>[
                    'body' => [
                        'awb' => $awb,
                    ]
                ],
                'signature' => ''
            ]), 'application/json')
            ->get(config('delta.rest.url').'/v3/tracking/');
    }

    /**
     * Get tracking AWB Detail
     */
    public static function smu($code)
    {
        $token = self::token();
        return Http::withToken($token)
            ->withBody(json_encode([
                'request'=>[
                    'body' => [
                        'smu_number' => $code
                    ]
                ],
                'signature' => ''
            ]), 'application/json')
            ->get(config('delta.rest.url').'/v3/track/getSmuDetail');
    }

    /**
     * Get token
     */
    public static function token()
    {
        if(session()->has('delta.rest.timestamp')) {
            $lifetime = now()->diffInSeconds(session('delta.rest.timestamp'));
            if($lifetime > session('delta.rest.expired')){
                session()->forget('delta.rest.token');
            }
        }
        
        if(!session()->has('delta.rest.token')) {
            $username   = config('delta.rest.username');
            $password   = config('delta.rest.password');
    
            $response = Http::withBasicAuth($username,$password)
                ->withBody(json_encode([
                    'grant_type'=>'client_credential'
                ]), 'application/json')
                ->post(config('delta.rest.url').'/token');
                
            session([
                'delta.rest.token'      => $response['data']['token'],
                'delta.rest.expired'    => $response['data']['expired'],
                'delta.rest.timestamp'  => now()
            ]);
        }

        return session('delta.rest.token');
    }
}
