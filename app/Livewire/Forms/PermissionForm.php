<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use App\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Form;

class PermissionForm extends Form
{
    use WithNotify, WithModal;

    public ?Permission $permission;

    public ?string $name = '';

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:permissions,name,' . $this->permission->id]
        ];
    }

    public function store()
    {
        $validated = $this->validate();
        Permission::create($validated);
    }

}
