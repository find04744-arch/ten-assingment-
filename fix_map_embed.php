<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ContactInfo;

$info = ContactInfo::first();
if ($info) {
    $info->map_embed = null; // Set to null so it uses the default iframe in the view
    $info->save();
    echo "Updated map_embed to null successfully!\n";
    print_r($info->fresh()->toArray());
}
