<?php
use Illuminate\Support\Facades\File;

$module   = basename(dirname(__FILE__));

foreach (File::allFiles(__DIR__ . '/administrator') as $route) {
    require $route->getPathname();
}
