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

    public function render()
    {
        return view('livewire.permissions.permission-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('refresh-permission-list');
        $this->dispatch('open-modal', 'delete-permission-modal');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->destroy($this->form->id);
        $this->dispatch('refresh-permission-list');
        $this->dispatch('close-modal', 'delete-permission-modal');
        $this->successNotify(__('trans.message_delete_permission'));
    }
}
