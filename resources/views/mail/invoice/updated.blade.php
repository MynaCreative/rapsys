@extends('layouts.email')
 
@section('title', $title.' - '.$data['action'])
 
@section('content')
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Dear <strong>{{ $data['creator'] }}</strong>,</p>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Your updated {{ $title }} <a href="{{ url(route('notifications.invoice-receipts', $data['id'])) }}" style="color:#1c1958;font-weight:bold;text-decoration: underline">{{ $data['code'] }}</a> has been sent to <strong>{{ $data['approver'] }}</strong> for approval.</p>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Thank you,<br>RAPsys Team</p>
@endsection
