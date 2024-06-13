<?php

namespace App\Livewire\Trash\Branches;

use App\Livewire\Forms\BranchForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchForceBulkDelete extends Component
{
    use NotifyTrait;
    public BranchForm $form;

    public function render()
    {
        return view('livewire.trash.branches.branch-force-bulk-delete');
    }

    #[On('force-bulk-delete-modal')]
    public function forceBulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'force-bulk-delete-branch-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function forceBulkDelete()
    {
        $this->form->forceDeleteAll($this->form->ids);
        $this->dispatch('refresh-branch-trash-list');
        $this->dispatch('close-modal', 'force-bulk-delete-branch-modal');
        $this->successNotify(__('trans.message_bulk_delete_branch'));
        $this->dispatch('refresh-partials');
    }
}
