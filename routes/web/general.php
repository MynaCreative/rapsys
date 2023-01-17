<?php
use Illuminate\Support\Facades\File;

foreach (File::allFiles(__DIR__ . '/general') as $route) {
    require $route->getPathname();
}
