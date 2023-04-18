@inject('excelDate', '\PhpOffice\PhpSpreadsheet\Shared\Date')
<table>
    <tr>
        <td></td>
        <td style="font-weight: bold; font-size: 16px;">Vendor</td>
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
            <th>Code</th>
            <th>Name</th>
            <th>Type</th>
            <th>SBU</th>
            <th>Sites</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $index => $row)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->sbu->name ?? '' }}</td>
            <td>{{ json_encode($row->sites->pluck('name')) }}</td>
            <td>{{ $excelDate::dateTimeToExcel($row->created_at) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>