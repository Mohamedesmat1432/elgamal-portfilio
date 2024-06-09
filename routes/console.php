<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('livewire:init {name}', function (string $name) {
    Artisan::call("livewire:form {$name}Form");
    Artisan::call("make:livewire {$name}s.{$name}List");
    Artisan::call("make:livewire {$name}s.{$name}Create");
    Artisan::call("make:livewire {$name}s.{$name}Update");
    // Artisan::call("make:livewire {$name}s.{$name}Show");
    Artisan::call("make:livewire {$name}s.{$name}Delete");
    Artisan::call("make:livewire {$name}s.{$name}BulkDelete");
    // Artisan::call("make:livewire {$name}s.{$name}ImportExport");
    // Artisan::call("make:import {$name}sImport --model=");
    // Artisan::call("make:export {$name}sExport --model=");
    Artisan::call("make:livewire Trash.{$name}s.{$name}List");
    Artisan::call("make:livewire Trash.{$name}s.{$name}Restore");
    Artisan::call("make:livewire Trash.{$name}s.{$name}BulkRestore");
    Artisan::call("make:livewire Trash.{$name}s.{$name}ForceDelete");
    Artisan::call("make:livewire Trash.{$name}s.{$name}ForceBulkDelete");
})->description('Running commands');