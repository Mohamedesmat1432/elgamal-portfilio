<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionDelete extends Component
{
    use NotifyTrait;
    public PermissionForm $form;

    public function render()
    {
        return view('livewire.permissions.permission-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'delete-permission-modal');
        $this->dispatch('refresh-permission-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->delete($this->form->id);
        $this->dispatch('refresh-permission-list');
        $this->dispatch('close-modal', 'delete-permission-modal');
        $this->successNotify(__('trans.message_delete_permission'));
        $this->dispatch('refresh-partials');
    }
}
