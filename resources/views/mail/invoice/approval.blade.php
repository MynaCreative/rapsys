@extends('layouts.email-large')
 
@section('title', 'Invoice Approval')
 
@section('content')
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Dear <strong>{{ $recevier->name }}</strong>,</p>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Below {{ $title }} require(s) your approval.</p>
    <ul>
		<li><a href="{{ url(route('transaction.invoices.edit', $model->id)) }}" style="color:#1c1958;font-weight:bold;text-decoration: underline">{{ $model->code }}</a></li>
	</ul>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">This is to inform you that {{ $model->createdUser->name }} has submitted a Vendor Invoice  below :</p>
    <table>
        <tr>
            <td>Vendor Name</td>
            <td width="10px">:</td>
            <td>{{ $model->vendor->name }}</td>
        </tr>
        <tr>
            <td>Invoice No</td>
            <td>:</td>
            <td>{{ $model->invoice_number }}</td>
        </tr>
        <tr>
            <td>Amount Invoice</td>
            <td>:</td>
            <td>{{ number_format($model->total_amount_valid) }}</td>
        </tr>
        <tr>
            <td>Unvalidated Amount</td>
            <td>:</td>
            <td>{{ number_format($model->total_amount_invalid) }}</td>
        </tr>
        <tr>
            <td>Due Date Invoice</td>
            <td>:</td>
            <td>{{ $model->due_date }}</td>
        </tr>
    </table><br><br>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Which requires your action. Please log in to your AP Validation System (<a href="https://rapsys.rpx.co.id" style="color:#1c1958;font-weight:bold;text-decoration: none">https://rapsys.rpx.co.id</a>) to approve this request so that AP Department Can Process Payables this Invoice.</p>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Kindly login to your <a href="{{ config('app.url') }}" style="color:#1c1958;font-weight:bold;text-decoration: none">RAPsys</a> account to display all outstanding documents.</p>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Thank you,<br>RAPSYS Team</p>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;"> 
        <b>Best regards,</b><br>
        <b>RAPSYS</b><br>
        <b>FABC Department</b><br><br>
        RPX Center Building,| Jl. Ciputat Raya No. 99 - Pondok Pinang, Jakarta Selatan 12310 | Indonesia<br>
        ☎ +62 21 7590 1800 | 🐁 <a href="www.rpx.co.id">www.rpx.co.id</a><br>
    </p>
@endsection
