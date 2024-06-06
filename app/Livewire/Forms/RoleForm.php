<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Form;

class RoleForm extends Form
{
    public ?Role $role;

    public ?array $ids = [];
    public ?bool $select_all = false;

    public ?string $id = '';
    public ?string $name = '';
    public ?array $permission = [];

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:roles,name,' . $this->id],
            'permission' => ['required', 'array'],
        ];
    }

    public  function permissions()
    {
        return Permission::withoutTrashed()->pluck('name')->toArray();
    }

    public function refresh()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function store()
    {
        $validated = $this->validate();
        $role = Role::withoutTrashed()->create($validated);
        $role->syncPermissions($this->permission);
        $this->refresh();
    }

    public function setRole($id)
    {
        $this->refresh();
        $this->role = Role::withoutTrashed()->findOrFail($id);
        $this->id = $this->role->id;
        $this->name = $this->role->name;
        $this->permission = $this->role->permissions->pluck('name')->toArray();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->role->update($validated);
        $this->role->syncPermissions($this->permission);
        $this->refresh();
    }

    public function destroy($id)
    {
        $role = Role::withoutTrashed()->findOrFail($id);
        $role->delete();
        $this->refresh();
    }

    public function selectAll($model_data)
    {
        if ($this->select_all) {
            $this->select_all = true;
            $this->ids = $model_data->pluck('id')->toArray();
        } else {
            $this->refresh();
        }
    }

    public function destroyAll($ids)
    {
        $roles = Role::withoutTrashed()->whereIn('id', $ids);
        $roles->delete();
        $this->refresh();
    }
}
