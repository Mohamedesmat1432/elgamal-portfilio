<?php

namespace App\Livewire\Forms;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    public ?array $ids = [];
    public ?bool $select_all = false;

    public ?string $id = '';
    public ?string $name = '';
    public ?string $email = '';
    public ?string $password = '';
    public ?string $password_confirmation = '';
    public ?array $role = [];

    public function rules()
    {
        $pass_rule = $this->id ? 'sometimes|string' : 'required|string|confirmed|' . Password::defaults();

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $this->id,
            'role' => 'required|array',
            'password' => $pass_rule,
        ];
    }

    public function roles()
    {
        return Role::withoutTrashed()->pluck('name')->toArray();
    }

    public function refresh()
    {
        $this->reset();
        $this->resetValidation();
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
    }

    public function update()
    {
        $validated = $this->validate();
        if($this->password){
            $validated['password'] = Hash::make($validated['password']);
        }
        $this->user->update($validated);
        $this->user->syncRoles($this->role);
        $this->refresh();
    }

    public function destroy($id)
    {
        $user = User::withoutTrashed()->findOrFail($id);
        $user->delete();
        $this->refresh();
    }

    public function selectAll($model)
    {
        $this->select_all ? ($this->ids = $model->pluck('id')->toArray()) : $this->refresh();
    }

    public function destroyAll($ids)
    {
        $users = User::withoutTrashed()->whereIn('id', $ids);
        $users->delete();
        $this->refresh();
    }
}
