<?php

namespace App\Exports\Vendor;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Vendor\Sample\Item;

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
