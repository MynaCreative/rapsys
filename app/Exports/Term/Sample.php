<?php

namespace App\Exports\Term;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Term\Sample\Item;

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
