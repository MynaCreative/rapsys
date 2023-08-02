@inject('excelDate', '\PhpOffice\PhpSpreadsheet\Shared\Date')
<table>
    <thead class="bg-head">
        <tr>
            <th class="text-center">#</th>
            <th>ID</th>
            <th>Code</th>
            <th>Amount</th>
            <th>Weight</th>
            <th width=10></th>
            <th>Delta Validation Code</th>
            <th>Delta Validation Already Bill</th>
            <th>Delta Validation Weight</th>
            <th>Delta Validation Scan Compliance</th>
            <th>Delta Validation Ops Plan</th>
            <th>Delta Validation Score</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $index => $row)
        <tr>
            <td class="text-center">{{ $index+1 }}</td>
            <td>{{ $row->id }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->amount }}</td>
            <td>{{ $row->weight }}</td>
            <td></td>
            <td>{{ $row->validation_reference ? '✓' : '✗' }}</td>
            <td>{{ $row->validation_bill ? '✓' : '✗' }}</td>
            <td>
                @if ($row->validation_weight)
                ✓
                @else
                @if (isset($row->total_weight_smu))
                {{ $row->total_weight_smu }}
                @endif
                @if (isset($row->delta_weight))
                {{ $row->delta_weight }}
                @endif
                @endif
            </td>
            <td>{{ $row->validation_scan_compliance ? '✓' : '✗' }}</td>
            <td>{{ $row->validation_ops_plan ? '✓' : '✗' }}</td>
            <td>{{ $row->validation_score }}</td>
            <td>{{ $row->message }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
