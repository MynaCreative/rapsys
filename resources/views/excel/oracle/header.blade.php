@inject('excelDate', '\PhpOffice\PhpSpreadsheet\Shared\Date')
<table>
    <tr>
        <td></td>
        <td style="font-weight: bold; font-size: 16px;">Report - Oracle Header</td>
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
            <th>Supplier Invoice Number</th>
            <th>Description</th>
            <th>Currency</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Invoice Date</th>
            <th>Receive Date</th>
            <th>Posting Date</th>
            <th>Status</th>
            <th>Message</th>
            <th>Creation Date</th>
            <th>Staging ID</th>
            <th>Ledger ID</th>
            <th>Org ID</th>
            <th>Vendor ID</th>
            <th>Vendor Site ID</th>
            <th>Terms ID</th>
            <th>AP Invoice ID</th>
            <th>AP Source</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $index => $row)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $row->trx_number ?? '' }}</td>
            <td>{{ $row->supplier_tax_invoice_number ?? '' }}</td>
            <td>{{ $row->description ?? '' }}</td>
            <td>{{ $row->currency_code ?? '' }}</td>
            <td>{{ $row->payment_method_lookup_code ?? '' }}</td>
            <td>{{ $row->amount ?? '' }}</td>
            <td>{{ $row->ap_invoice_date ? $excelDate::dateTimeToExcel($row->ap_invoice_date) : '' }}</td>
            <td>{{ $row->ap_invoice_received_date ? $excelDate::dateTimeToExcel($row->ap_invoice_received_date) : '' }}</td>
            <td>{{ $row->ap_gl_date ? $excelDate::dateTimeToExcel($row->ap_gl_date) : '' }}</td>
            <td>{{ $row->status ?? '' }}</td>
            <td>{{ $row->error_message ?? '' }}</td>
            <td>{{ $row->ap_gl_date ? $excelDate::dateTimeToExcel($row->creation_date) : '' }}</td>
            <td>{{ $row->staging_id ?? '' }}</td>
            <td>{{ $row->ledger_id ?? '' }}</td>
            <td>{{ $row->org_id ?? '' }}</td>
            <td>{{ $row->vendor_id ?? '' }}</td>
            <td>{{ $row->vendor_site_id ?? '' }}</td>
            <td>{{ $row->terms_id ?? '' }}</td>
            <td>{{ $row->ap_invoice_id ?? '' }}</td>
            <td>{{ $row->ap_source ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
