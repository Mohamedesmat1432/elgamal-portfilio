<?php

namespace App\Livewire\Branches;

use App\Livewire\Forms\BranchForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchUpdate extends Component
{
    use NotifyTrait;
    public BranchForm $form;

    public function render()
    {
        return view('livewire.branches.branch-update');
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->dispatch('open-modal', 'update-branch-modal');
        $this->dispatch('refresh-branch-list');
        $this->form->setBranch($id);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('refresh-branch-list');
        $this->dispatch('close-modal', 'update-branch-modal');
        $this->successNotify(__('trans.message_update_branch'));
        $this->dispatch('refresh-partials');
    }
}
