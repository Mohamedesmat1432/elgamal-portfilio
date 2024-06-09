<?php

namespace App\Livewire\Trash\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionRestore extends Component
{
    use NotifyTrait;
    public PermissionForm $form;
    
    public function render()
    {
        return view('livewire.trash.permissions.permission-restore');
    }

    #[On('restore-modal')]
    public function restoreModal($id, $name)
    {
        $this->dispatch('open-modal', 'restore-permission-modal');
        $this->dispatch('refresh-permission-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function restore()
    {
        $this->form->restore($this->form->id);
        $this->dispatch('refresh-permission-trash-list');
        $this->dispatch('close-modal', 'restore-permission-modal');
        $this->successNotify(__('trans.message_restore_permission'));
        $this->dispatch('refresh-partials');
    }
}
