<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$users = User::select('id','name','email')->limit(20)->get();
echo "Found " . $users->count() . " users\n";
foreach ($users as $u) {
    echo "{$u->id}\t{$u->name}\t{$u->email}\n";
}

if ($users->count() === 0) {
    echo "(no users found)\n";
}

