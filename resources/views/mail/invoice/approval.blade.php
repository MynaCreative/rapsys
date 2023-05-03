@extends('layouts.email-large')

@section('title', 'Invoice Approval')

@section('content')
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Dear <strong>{{ $recevier->name }}</strong>,</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;text-decoration-line: underline">This is to inform you that {{ $model->createdUser->name }} {{ $model->createdUser->position ? ' - '.$model->createdUser->position : ''  }} has submitted a Vendor Invoice below :</p>
<table>
    <tr>
        <td>Vendor Name</td>
        <td width="10px">:</td>
        <td>{{ $model->vendor->name }}</td>
    </tr>
    <tr>
        <td>Invoice No</td>
        <td>:</td>
        <td><a href="{{ url(route('transaction.invoices.edit', $model->id)) }}" target="_blank" style="color:#1c1958;font-weight:bold;text-decoration: underline">{{ $model->invoice_number }}</a></td>
    </tr>
    <tr>
        <td>Amount Invoice</td>
        <td>:</td>
        <td>{{ number_format($model->total_amount) }}</td>
    </tr>
    <tr>
        <td>Valid Amount</td>
        <td>:</td>
        <td>{{ number_format($model->total_amount_valid) }}</td>
    </tr>
    <tr>
        <td>Unvalid Amount</td>
        <td>:</td>
        <td>{{ number_format($model->total_amount_invalid) }}</td>
    </tr>
    <tr>
        <td>Due Date Invoice</td>
        <td>:</td>
        <td>{{ $model->due_date }}</td>
    </tr>
</table><br><br>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Which requires your action. Please log in to your AP Validation System (<a href="{{ config('app.url') }}" target="_blank" style="color:#1c1958;font-weight:bold;text-decoration: none">{{ config('app.url') }}</a>) to approve this request<br>so that AP Department Can Process Payables this Invoice.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Summary Unvalidated Item</p>
<table class="table-content">
    <thead>
        <tr>
            <th>Item Tagihan</th>
            <th>Validation Item</th>
            <th>Reason</th>
            <th class="text-right">Count of AWB/SMU</th>
            <th class="text-right">Count of Weight</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>SMU</td>
            <td>Validation SMU/AWB</td>
            <td>Data not found</td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_reference'];
                    })->count()) 
                }}
            </td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_reference'];
                    })->sum('weight')) 
                }}
            </td>
        </tr>
        <tr>
            <td>SMU</td>
            <td>Validation Bill</td>
            <td>Already Billed</td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_bill'];
                    })->count()) 
                }}
            </td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_bill'];
                    })->sum('weight')) 
                }}
            </td>
        </tr>
        <tr>
            <td>SMU</td>
            <td>Validation Weight SMU/AWB</td>
            <td>Weight Not Match</td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_weight'];
                    })->count()) 
                }}
            </td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_weight'];
                    })->sum('weight')) 
                }}
            </td>
        </tr>
        <tr>
            <td>SMU</td>
            <td>Validation Scan Compliance</td>
            <td>Scan Not Found</td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_scan_compliance'];
                    })->count()) 
                }}
            </td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_scan_compliance'];
                    })->sum('weight')) 
                }}
            </td>
        </tr>
        <tr>
            <td>SMU</td>
            <td>Validation Ops Plan</td>
            <td>Warning RPX Area</td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_ops_plan'];
                    })->count()) 
                }}
            </td>
            <td class="text-right">
                {{
                    number_format($model->items->filter(function ($item) {
                        return $item['type'] !== 'MNL' && !$item['validation_ops_plan'];
                    })->sum('weight')) 
                }}
            </td>
        </tr>
    </tbody>
</table><br><br>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Detailed Report : <a href="{{ url(route('transaction.invoices.edit', $model->id)) }}" target="_blank" style="color:#1c1958;font-weight:bold;text-decoration: underline">{{ url(route('transaction.invoices.edit', $model->id)) }}</a></p>
<table width="100%">
    <tr>
        <td>
            <img src="{{asset('img/submitted.png')}}" width="200" alt="submitted">
        </td>
        @foreach ($model->approvals as $approval)
        <td>
            @if($approval->status == 'approved')
            <img src="{{asset('img/approved.png')}}" width="200" alt="approved">
            @else
            {{ $approval->status }}
            @endif
        </td>
        @endforeach
    </tr>
    <tr>
        <td>Requestor</td>
        @foreach ($model->approvals as $approval)
        <td>{{ $approval->description }}</td>
        @endforeach
    </tr>
    <tr>
        <td>{{ $model->createdUser->name }} {{ $model->createdUser->position ? ' - '.$model->createdUser->position : ''  }}</td>
        @foreach ($model->approvals as $approval)
        <td>{{ $approval->user->name }} {{ $approval->user->position ? ' - '.$approval->user->position : ''  }}</td>
        @endforeach
    </tr>
</table>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;  margin-top: 15px; color: #555555;">Please note : This is an auto generated e-mail. Do not reply to this messge.</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">Thank you for using <b>RAPSYS</b></p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #555555;">
    <b>Best regards,</b><br>
    <b>RAPSYS</b><br>
    <b>FABC Department</b><br><br>
    RPX Center Building,| Jl. Ciputat Raya No. 99 - Pondok Pinang, Jakarta Selatan 12310 | Indonesia<br>
    ☎ +62 21 7590 1800 | 🐁 <a href="www.rpx.co.id">www.rpx.co.id</a><br>
</p>
@endsection