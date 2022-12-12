<?php

namespace App\Exports\Expense;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Expense\Sample\Item;

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
