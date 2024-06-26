<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Traits\HelperTrait;
use App\Models\Role;
use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{
    use HelperTrait;

    public ?User $user;
    public ?int $id = null;
    public ?string $name = '';
    public ?string $email = '';
    public ?string $password = '';
    public ?string $password_confirmation = '';
    public ?int $branch_id = null;
    public ?array $role = [];

    public function rules()
    {
        $pass_rule = $this->id ? ['sometimes', 'string'] : ['required', 'string', 'confirmed', Password::defaults()];

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $this->id],
            'role' => ['sometimes', 'array', 'exists:roles,name'],
            'password' => $pass_rule,
            'branch_id' => ['required', 'numeric', 'exists:branches,id'],
        ];
    }

    public function roles()
    {
        return Role::withoutTrashed()->pluck('name')->toArray();
    }

    public function branches()
    {
        return Branch::withoutTrashed()->pluck('name', 'id')->toArray();
    }

    public function store()
    {
        $validated = $this->validate();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::withoutTrashed()->create($validated);
        $user->syncRoles($this->role);
        $this->refresh();
    }

    public function setUser($id)
    {
        $this->refresh();
        $this->user = User::withoutTrashed()->findOrFail($id);
        $this->id = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->roles->pluck('name')->toArray();
        $this->branch_id = $this->user->branch_id;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->user->update($validated);
        $this->user->syncRoles($this->role);
        $this->refresh();
    }

    public function delete($id)
    {
        $user = User::withoutTrashed()->findOrFail($id);
        $user->delete();
        $this->refresh();
    }

    public function deleteAll($ids)
    {
        $users = User::withoutTrashed()->whereIn('id', $ids);
        $users->delete();
        $this->refresh();
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        $this->refresh();
    }

    public function restoreAll($ids)
    {
        $users = User::onlyTrashed()->whereIn('id', $ids);
        $users->restore();
        $this->refresh();
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        $this->refresh();
    }

    public function forceDeleteAll($ids)
    {
        $users = User::onlyTrashed()->whereIn('id', $ids);
        $users->forceDelete();
        $this->refresh();
    }
}
