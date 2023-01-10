<?php

namespace App\Imports;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Queue\ShouldQueue;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use App\Models\OpsPlan;

class OpsPlanImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $value = Arr::except($row, ['created_by','updated_by','created_at','updated_at']);
        return new OpsPlan($value);
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
