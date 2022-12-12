<?php

namespace App\Exports\Department;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Department\Sample\Item;

class Sample implements WithMultipleSheets
{
    public function sheets(): array
    {
        $page = basename(dirname(__FILE__));
        return [
            new Item($page),
        ];
    }
}
