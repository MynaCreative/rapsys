<?php

namespace App\Exports\SalesChannel;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\SalesChannel\Sample\Item;

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
