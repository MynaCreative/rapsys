<?php

namespace App\Exports\Tax;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Tax\Sample\Item;
use App\Exports\Tax\Sample\Type;

class Sample implements WithMultipleSheets
{
    public function sheets(): array
    {
        $page = basename(dirname(__FILE__));
        return [
            new Item($page),
            // new Type($page),
        ];
    }
}
