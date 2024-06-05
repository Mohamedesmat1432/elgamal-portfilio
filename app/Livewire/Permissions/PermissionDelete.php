<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionDelete extends Component
{
    use WithNotify;

    public PermissionForm $form;

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->form->id = $id;
        $this->form->name = $name;
        $this->dispatch('open-modal', 'delete-permission-modal');
    }

    public function delete()
    {
        $this->form->destroy($this->form->id);
        $this->dispatch('close-modal', 'delete-permission-modal');
        $this->dispatch('refresh-permission-list');
        $this->successNotify(__('trans.message_delete_permission'));
        $this->dispatch('reset-form');
    }

    public function render()
    {
        return view('livewire.permissions.permission-delete');
    }
}
