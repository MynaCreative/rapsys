@inject('excelDate', '\PhpOffice\PhpSpreadsheet\Shared\Date')
<table>
    <tr>
        <td></td>
        <td style="font-weight: bold; font-size: 16px;">Line Type</td>
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
    <thead class="bg-head">
        <tr>
            <th class="text-center">#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $index => $row)
        <tr>
            <td class="text-center">{{ $index+1 }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->description }}</td>
            <td>{{ $row->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>