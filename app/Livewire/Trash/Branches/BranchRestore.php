<?php

namespace App\Livewire\Trash\Branches;

use App\Livewire\Forms\BranchForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchRestore extends Component
{
    use NotifyTrait;
    public BranchForm $form;

    public function render()
    {
        return view('livewire.trash.branches.branch-restore');
    }

    #[On('restore-modal')]
    public function restoreModal($id, $name)
    {
        $this->dispatch('open-modal', 'restore-branch-modal');
        $this->dispatch('refresh-branch-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function restore()
    {
        $this->form->restore($this->form->id);
        $this->dispatch('refresh-branch-trash-list');
        $this->dispatch('close-modal', 'restore-branch-modal');
        $this->successNotify(__('trans.message_restore_branch'));
        $this->dispatch('refresh-partials');
    }
}
