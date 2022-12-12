<?php
use Illuminate\Support\Facades\File;

$module   = basename(dirname(__FILE__));

foreach (File::allFiles(__DIR__ . '/configuration') as $route) {
    require $route->getPathname();
}
