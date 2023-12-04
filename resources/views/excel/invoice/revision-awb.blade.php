@inject('excelDate', '\PhpOffice\PhpSpreadsheet\Shared\Date')
<table>
    <thead class="bg-head">
        <tr>
            <th class="text-center">#</th>
            <th>ID</th>
            <th>SMU</th>
            <th>AWB</th>
            <th>Amount</th>
            <th>Weight</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $index => $row)
        <tr>
            <td class="text-center">{{ $index+1 }}</td>
            <td>{{ $row->id }}</td>
            <td>{{ $row->smu }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->amount }}</td>
            <td>{{ $row->weight }}</td>
        </tr>
        @endforeach
    </tbody>
</table>