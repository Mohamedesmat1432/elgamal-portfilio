<?php

namespace App\Livewire\Branches;

use App\Livewire\Forms\BranchForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchDelete extends Component
{
    use NotifyTrait;
    public BranchForm $form;

    public function render()
    {
        return view('livewire.branches.branch-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'delete-branch-modal');
        $this->dispatch('refresh-branch-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->delete($this->form->id);
        $this->dispatch('refresh-branch-list');
        $this->dispatch('close-modal', 'delete-branch-modal');
        $this->successNotify(__('trans.message_delete_branch'));
        $this->dispatch('refresh-partials');
    }
}
