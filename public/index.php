<?php

/*
 * public/index.php
 * Entry point aplikasi Laravel
 * Semua request dilewatkan ke file ini
 */

define('LARAVEL_START', microtime(true));

// Tentukan public path
if (file_exists(__DIR__ . '/../storage/framework/maintenance.php')) {
    require __DIR__ . '/../storage/framework/maintenance.php';
}

// Load autoloader dari Composer
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle request
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = \Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
