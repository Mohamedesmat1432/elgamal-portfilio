<?php

namespace App\Livewire\Roles;

use App\Livewire\Forms\RoleForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleDelete extends Component
{
    use WithNotify;

    public RoleForm $form;

    public function render()
    {
        return view('livewire.roles.role-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('refresh-role-list');
        $this->dispatch('open-modal', 'delete-role-modal');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->destroy($this->form->id);
        $this->dispatch('refresh-role-list');
        $this->dispatch('close-modal', 'delete-role-modal');
        $this->successNotify(__('trans.message_delete_role'));
    }
}
