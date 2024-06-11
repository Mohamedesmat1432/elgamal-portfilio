<?php

namespace App\Livewire\Trash\Roles;

use App\Livewire\Forms\RoleForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleRestore extends Component
{
    use NotifyTrait;
    public RoleForm $form;

    public function render()
    {
        return view('livewire.trash.roles.role-restore');
    }

    #[On('restore-modal')]
    public function restoreModal($id, $name)
    {
        $this->dispatch('open-modal', 'restore-role-modal');
        $this->dispatch('refresh-role-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function restore()
    {
        $this->form->restore($this->form->id);
        $this->dispatch('refresh-role-trash-list');
        $this->dispatch('close-modal', 'restore-role-modal');
        $this->successNotify(__('trans.message_restore_role'));
        $this->dispatch('refresh-partials');
    }
}
