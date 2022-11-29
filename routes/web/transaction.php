<?php
use Illuminate\Support\Facades\File;

foreach (File::allFiles(__DIR__ . '/transaction') as $route) {
    require $route->getPathname();
}
