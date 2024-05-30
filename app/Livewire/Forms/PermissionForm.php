<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use App\Traits\WithNotify;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PermissionForm extends Form
{
    use WithNotify;

    public ?Permission $permission;

    public $create_modal = false;

    #[Validate(['required', 'string'])]
    public $name;

    public function createModal()
    {
        $this->reset();
        $this->create_modal = true;
    }

    public function store()
    {
        $validated = $this->validate();
        Permission::create($validated);
        $this->successNotify(__('trans.message_create_permission'));
    }

}
