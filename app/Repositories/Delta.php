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
                        'tracking_status_id' => 'SMU',
                    ]
                ]
            ]), 'application/json')
            ->get(config('delta.rest.url').'/v3/track/getTrackAwbDetail');
    }

    /**
     * Get token
     */
    public static function token()
    {
        if(session()->has('delta.soap.timestamp')) {
            $lifetime = now()->diffInSeconds(session('delta.soap.timestamp'));
            if($lifetime > session('delta.soap.expired')){
                session()->forget('delta.soap.token');
            }
        }
        
        if(!session()->has('delta.soap.token')) {
            $username   = config('delta.rest.username');
            $password   = config('delta.rest.password');
    
            $response = Http::withBasicAuth($username,$password)
                ->withBody(json_encode([
                    'grant_type'=>'client_credential'
                ]), 'application/json')
                ->post(config('delta.rest.url').'/token');
                
            session([
                'delta.soap.token'      => $response['data']['token'],
                'delta.soap.expired'    => $response['data']['expired'],
                'delta.soap.timestamp'  => now()
            ]);
        }

        return session('delta.soap.token');
    }
}
