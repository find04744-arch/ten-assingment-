<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ContactInfo;

$info = ContactInfo::first();
if ($info) {
    echo "Record exists:\n";
    print_r($info->toArray());
} else {
    echo "No contact info record found\n";
}
