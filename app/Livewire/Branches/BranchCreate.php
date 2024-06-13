<?php

namespace App\Livewire\Branches;

use App\Livewire\Forms\BranchForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchCreate extends Component
{
    use NotifyTrait;
    public BranchForm $form;

    public function render()
    {
        return view('livewire.branches.branch-create');
    }

    #[On('create-modal')]
    public function createModal()
    {
        $this->dispatch('open-modal', 'create-branch-modal');
        $this->dispatch('refresh-branch-list');
        $this->form->refresh();
    }

    public function create()
    {
        $this->form->store();
        $this->dispatch('refresh-branch-list');
        $this->dispatch('close-modal', 'create-branch-modal');
        $this->successNotify(__('trans.message_create_branch'));
        $this->dispatch('refresh-partials');
    }
}
