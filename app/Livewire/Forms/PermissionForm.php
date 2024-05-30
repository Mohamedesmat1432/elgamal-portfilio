<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use App\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PermissionForm extends Form
{
    use WithNotify, WithModal;

    public ?Permission $permission;

    #[Validate(['required', 'string'])]
    public $name;

    public function store()
    {
        $validated = $this->validate();
        Permission::create($validated);
    }

}
