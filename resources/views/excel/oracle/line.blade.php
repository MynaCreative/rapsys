@inject('excelDate', '\PhpOffice\PhpSpreadsheet\Shared\Date')
<table>
    <tr>
        <td></td>
        <td style="font-weight: bold; font-size: 16px;">Report - Oracle Line</td>
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
            <th>Dist</th>
            <th>Description</th>
            <th>PPN</th>
            <th>Tax Rate</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Message</th>
            <th>Creation Date</th>
            <th>Staging ID</th>
            <th>Ledger ID</th>
            <th>Org ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $index => $row)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $row->invoice?->trx_number ?? '' }}</td>
            <td>{{ $row->dist_code_concat ?? '' }}</td>
            <td>{{ $row->description ?? '' }}</td>
            <td>{{ $row->ppn_code ?? '' }}</td>
            <td>{{ $row->tax_rate_id ?? '' }}</td>
            <td>{{ $row->amount ?? '' }}</td>
            <td>{{ $row->status ?? '' }}</td>
            <td>{{ $row->error_message ?? '' }}</td>
            <td>{{ $row->creation_date ? $excelDate::dateTimeToExcel($row->creation_date) : '' }}</td>
            <td>{{ $row->staging_id ?? '' }}</td>
            <td>{{ $row->ledger_id ?? '' }}</td>
            <td>{{ $row->org_id ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
