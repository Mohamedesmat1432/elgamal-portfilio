<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use Livewire\Form;

class PermissionForm extends Form
{
    public ?Permission $permission;

    public ?string $id = '';
    public ?string $name = '';
    public ?array $ids = [];
    public ?bool $selected_all = false;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:permissions,name,' . $this->id],
        ];
    }

    public function store()
    {
        $validated = $this->validate();
        Permission::create($validated);
    }

    public function setPermission($id)
    {
        $this->permission = Permission::findOrFail($id);
        $this->id = $this->permission->id;
        $this->name = $this->permission->name;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->permission->update($validated);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
    }

    public function destroyAll($ids)
    {
        $permissions = Permission::whereIn('id', $ids);
        $permissions->delete();
    }
}
