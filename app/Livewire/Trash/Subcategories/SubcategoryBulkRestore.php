<?php

namespace App\Livewire\Trash\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class SubcategoryBulkRestore extends Component
{
    use NotifyTrait;
    public SubcategoryForm $form;

    public function render()
    {
        return view('livewire.trash.subcategories.subcategory-bulk-restore');
    }

    #[On('bulk-restore-modal')]
    public function bulkRestoreModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-restore-subcategory-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkRestore()
    {
        $this->form->restoreAll($this->form->ids);
        $this->dispatch('refresh-subcategory-trash-list');
        $this->dispatch('close-modal', 'bulk-restore-subcategory-modal');
        $this->successNotify(__('trans.message_bulk_restore_subcategory'));
        $this->dispatch('refresh-partials');
    }
}
