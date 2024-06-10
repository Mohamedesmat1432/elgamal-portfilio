<?php

namespace App\Livewire\Forms;

use App\Traits\HelperTrait;
use App\Models\Permission;
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

    public function delete($id)
    {
        $permission = Permission::withoutTrashed()->findOrFail($id);
        $permission->delete();
        $this->refresh();
    }

    public function deleteAll($ids)
    {
        $permissions = Permission::withoutTrashed()->whereIn('id', $ids);
        $permissions->delete();
        $this->refresh();
    }

    public function restore($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->restore();
        $this->refresh();
    }

    public function restoreAll($ids)
    {
        $permissions = Permission::onlyTrashed()->whereIn('id', $ids);
        $permissions->restore();
        $this->refresh();
    }

    public function forceDelete($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->forceDelete();
        $this->refresh();
    }

    public function forceDeleteAll($ids)
    {
        $permissions = Permission::onlyTrashed()->whereIn('id', $ids);
        $permissions->forceDelete();
        $this->refresh();
    }
}
