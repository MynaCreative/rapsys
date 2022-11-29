<?php
use Illuminate\Support\Facades\File;

foreach (File::allFiles(__DIR__ . '/setting') as $route) {
    require $route->getPathname();
}
