<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Illuminate\Support\Facades\Artisan;

require __DIR__.'/../repositories/gorillalabs/bootstrap/autoload.php';

$app = require_once __DIR__.'/../repositories/gorillalabs/bootstrap/app.php';
$app->make(Illuminate\Contracts\Http\Kernel::class)->handle(
    Illuminate\Http\Request::capture()
);

Artisan::call('cache:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');
Artisan::call('route:clear');

echo "Caché de Laravel limpiada con éxito.";
