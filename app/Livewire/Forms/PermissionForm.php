<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use App\Traits\HelperTrait;
use Livewire\Form;

class PermissionForm extends Form
{
    use HelperTrait;

    public ?Permission $permission;
    public ?int $id = null;
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
        $this->refresh();
    }

    public function setPermission($id)
    {
        $this->refresh();
        $this->permission = Permission::withoutTrashed()->findOrFail($id);
        $this->id = $this->permission->id;
        $this->name = $this->permission->name;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->permission->update($validated);
        $this->refresh();
    }

    public function destroy($id)
    {
        $permission = Permission::withoutTrashed()->findOrFail($id);
        $permission->delete();
        $this->refresh();
    }

    public function destroyAll($ids)
    {
        $permissions = Permission::withoutTrashed()->whereIn('id', $ids);
        $permissions->delete();
        $this->refresh();
    }
}
