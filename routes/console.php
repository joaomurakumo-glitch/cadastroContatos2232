<?php

use Illuminate\Support\Facades\Artisan;

$artisan = 'Illuminate\\Support\\Facades\\Artisan';
$artisan::command('inspire', function () {
    $this->comment('Keep going — you are doing great!');
})->purpose('Display an inspiring quote');
