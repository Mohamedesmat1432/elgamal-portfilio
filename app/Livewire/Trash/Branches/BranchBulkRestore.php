<?php

namespace App\Livewire\Trash\Branches;

use App\Livewire\Forms\BranchForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchBulkRestore extends Component
{
    use NotifyTrait;
    public BranchForm $form;

    public function render()
    {
        return view('livewire.trash.branches.branch-bulk-restore');
    }

    #[On('bulk-restore-modal')]
    public function bulkRestoreModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-restore-branch-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkRestore()
    {
        $this->form->restoreAll($this->form->ids);
        $this->dispatch('refresh-branch-trash-list');
        $this->dispatch('close-modal', 'bulk-restore-branch-modal');
        $this->successNotify(__('trans.message_bulk_restore_branch'));
        $this->dispatch('refresh-partials');
    }
}
