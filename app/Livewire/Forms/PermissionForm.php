<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use Livewire\Form;

class PermissionForm extends Form
{
    public ?Permission $permission;

    public ?bool $select_all = false;
    public ?array $ids = [];
    public ?string $id = '';
    public ?string $name = '';

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:permissions,name,' . $this->id],
        ];
    }

    public function refresh()
    {
        $this->reset();
        $this->resetValidation();
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
        $permissions = Permission::withoutTrashed()->whereIn('id', $ids);
        $permissions->delete();
        $this->refresh();
    }
}
