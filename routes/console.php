<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('livewire:init {name}', function (string $name) {
    Artisan::call("livewire:form {$name}Form");
    Artisan::call("make:livewire {$name}.List{$name}");
    Artisan::call("make:livewire {$name}.Create{$name}");
    Artisan::call("make:livewire {$name}.Update{$name}");
    // Artisan::call("make:livewire {$name}.Show{$name}");
    Artisan::call("make:livewire {$name}.Delete{$name}");
    Artisan::call("make:livewire {$name}.BulkDelete{$name}");
    // Artisan::call("make:livewire {$name}.ImportExport{$name}");
    // Artisan::call("make:import {$name}sImport --model={$name}");
    // Artisan::call("make:export {$name}sExport --model={$name}");
    Artisan::call("make:livewire Trash.{$name}.List{$name}");
    Artisan::call("make:livewire Trash.{$name}.Restore{$name}");
    Artisan::call("make:livewire Trash.{$name}.Restore{$name}");
    Artisan::call("make:livewire Trash.{$name}.ForceDelete{$name}");
    Artisan::call("make:livewire Trash.{$name}.ForceBulkDelete{$name}");
})->description('Running commands');