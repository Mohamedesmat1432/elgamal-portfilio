<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use Livewire\Form;

class PermissionForm extends Form
{
    public ?Permission $permission;

    public ?bool $selected_all = false;
    public ?array $ids = [];
    public ?string $id = '';
    public ?string $name = '';

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:permissions,name,' . $this->id],
        ];
    }

    public function store()
    {
        $validated = $this->validate();
        Permission::withoutTrashed()->create($validated);
    }

    public function setPermission($id)
    {
        $this->permission = Permission::withoutTrashed()->findOrFail($id);
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
        $permission = Permission::withoutTrashed()->findOrFail($id);
        $permission->delete();
    }

    public function destroyAll($ids)
    {
        $permissions = Permission::withoutTrashed()->whereIn('id', $ids);
        $permissions->delete();
    }
}
