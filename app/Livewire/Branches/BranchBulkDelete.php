<?php

namespace App\Livewire\Branches;

use App\Livewire\Forms\BranchForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchBulkDelete extends Component
{
    use NotifyTrait;
    public BranchForm $form;

    public function render()
    {
        return view('livewire.branches.branch-bulk-delete');
    }

    #[On('bulk-delete-modal')]
    public function bulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-delete-branch-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkDelete()
    {
        $this->form->deleteAll($this->form->ids);
        $this->dispatch('close-modal', 'bulk-delete-branch-modal');
        $this->dispatch('refresh-branch-list');
        $this->successNotify(__('trans.message_bulk_delete_branch'));
        $this->dispatch('refresh-partials');
    }
}
