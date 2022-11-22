<?php
use Illuminate\Support\Facades\File;

foreach (File::allFiles(__DIR__ . '/master') as $route) {
    require $route->getPathname();
}
