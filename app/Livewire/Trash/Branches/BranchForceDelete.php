<?php

namespace App\Livewire\Trash\Branches;

use App\Livewire\Forms\BranchForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchForceDelete extends Component
{
    use NotifyTrait;
    public BranchForm $form;

    public function render()
    {
        return view('livewire.trash.branches.branch-force-delete');
    }

    #[On('force-delete-modal')]
    public function forceDeleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'force-delete-branch-modal');
        $this->dispatch('refresh-branch-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function forceDelete()
    {
        $this->form->forceDelete($this->form->id);
        $this->dispatch('refresh-branch-trash-list');
        $this->dispatch('close-modal', 'force-delete-branch-modal');
        $this->successNotify(__('trans.message_delete_branch'));
        $this->dispatch('refresh-partials');
    }
}
