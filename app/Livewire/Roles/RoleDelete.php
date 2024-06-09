<?php

namespace App\Livewire\Roles;

use App\Livewire\Forms\RoleForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleDelete extends Component
{
    use NotifyTrait;
    public RoleForm $form;

    public function render()
    {
        return view('livewire.roles.role-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'delete-role-modal');
        $this->dispatch('refresh-role-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->delete($this->form->id);
        $this->dispatch('refresh-role-list');
        $this->dispatch('close-modal', 'delete-role-modal');
        $this->successNotify(__('trans.message_delete_role'));
        $this->dispatch('refresh-partials');
    }
}
