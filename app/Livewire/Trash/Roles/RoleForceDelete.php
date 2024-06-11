<?php

namespace App\Livewire\Trash\Roles;

use App\Livewire\Forms\RoleForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleForceDelete extends Component
{
    use NotifyTrait;
    public RoleForm $form;

    public function render()
    {
        return view('livewire.trash.roles.role-force-delete');
    }

    #[On('force-delete-modal')]
    public function forceDeleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'force-delete-role-modal');
        $this->dispatch('refresh-role-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function forceDelete()
    {
        $this->form->forceDelete($this->form->id);
        $this->dispatch('refresh-role-trash-list');
        $this->dispatch('close-modal', 'force-delete-role-modal');
        $this->successNotify(__('trans.message_delete_role'));
        $this->dispatch('refresh-partials');
    }
}
