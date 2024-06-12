<?php

namespace App\Livewire\Trash\Categorys;

use App\Livewire\Forms\CategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryBulkRestore extends Component
{
    use NotifyTrait;
    public CategoryForm $form;

    public function render()
    {
        return view('livewire.trash.categorys.category-bulk-restore');
    }

    #[On('bulk-restore-modal')]
    public function bulkRestoreModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-restore-category-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkRestore()
    {
        $this->form->restoreAll($this->form->ids);
        $this->dispatch('refresh-category-trash-list');
        $this->dispatch('close-modal', 'bulk-restore-category-modal');
        $this->successNotify(__('trans.message_bulk_restore_category'));
        $this->dispatch('refresh-partials');
    }
}
