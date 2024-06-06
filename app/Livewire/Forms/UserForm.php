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
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'. $this->id],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'role' => ['required', 'array'],
        ];
    }

    public  function roles()
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
        $users = User::withoutTrashed()->whereIn('id', $ids);
        $users->delete();
        $this->refresh();
    }
}
