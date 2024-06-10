<?php

namespace App\Livewire\Forms;

use App\Traits\HelperTrait;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Form;

class RoleForm extends Form
{
    use HelperTrait;

    public ?Role $role;
    public ?int $id = null;
    public ?string $name = '';
    public ?array $permission = [];

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:roles,name,' . $this->id],
            'permission' => ['sometimes', 'array', 'exists:permissions,name'],
        ];
    }

    public function permissions()
    {
        return Permission::withoutTrashed()->pluck('name')->toArray();
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

    public function delete($id)
    {
        $role = Role::withoutTrashed()->findOrFail($id);
        $role->delete();
        $this->refresh();
    }

    public function deleteAll($ids)
    {
        $roles = Role::withoutTrashed()->whereIn('id', $ids);
        $roles->delete();
        $this->refresh();
    }

    public function restore($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();
        $this->refresh();
    }

    public function restoreAll($ids)
    {
        $roles = Role::onlyTrashed()->whereIn('id', $ids);
        $roles->restore();
        $this->refresh();
    }

    public function forceDelete($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->forceDelete();
        $this->refresh();
    }

    public function forceDeleteAll($ids)
    {
        $roles = Role::onlyTrashed()->whereIn('id', $ids);
        $roles->forceDelete();
        $this->refresh();
    }
}
