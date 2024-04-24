@inject('excelDate', '\PhpOffice\PhpSpreadsheet\Shared\Date')
<table>
    <tr>
        <td></td>
        <td style="font-weight: bold; font-size: 16px;">Report - Invoice Header</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Exported By : {{ auth()->user()->name ?? '' }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Exported At: {{ now()->format('Y-m-d H:i:s') }}</td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Invoice Number</th>
            <th>Vendor</th>
            <th>Invoice Amount</th>
            <th>Invoice Amount (Distribution)</th>
            <th>Document Status</th>
            <th>Approval Status</th>
            <th>Data Type</th>
            <th>Invoice Date</th>
            <th>Posting Date</th>
            <th>Created Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $index => $row)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $row->invoice_number }}</td>
            <td>{{ optional($row->vendor)->name ?? '-' }}</td>
            <td>{{ $row->total_amount }}</td>
            <td>
                @if ($row->amount_distribution)
                {{ json_encode($row->amount_distribution) }}
                @endif
            </td>
            <td>{{ $row->document_status }}</td>
            <td>{{ $row->approval_status }}</td>
            <td>
                @switch(optional($row->expense->expense)->type)

                @case(1)
                SMU
                @break

                @case(2)
                AWB
                @break

                @case(3)
                CONS
                @break

                @endswitch
            </td>
            <td>{{ $excelDate::dateTimeToExcel($row->invoice_date) }}</td>
            <td>{{ $excelDate::dateTimeToExcel($row->posting_date) }}</td>
            <td>{{ $excelDate::dateTimeToExcel($row->created_at) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>