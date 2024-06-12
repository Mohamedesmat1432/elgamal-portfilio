<?php

namespace App\Livewire\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class SubcategoryBulkDelete extends Component
{
    use NotifyTrait;
    public SubcategoryForm $form;

    public function render()
    {
        return view('livewire.subcategories.subcategory-bulk-delete');
    }

    #[On('bulk-delete-modal')]
    public function bulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-delete-subcategory-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkDelete()
    {
        $this->form->deleteAll($this->form->ids);
        $this->dispatch('close-modal', 'bulk-delete-subcategory-modal');
        $this->dispatch('refresh-subcategory-list');
        $this->successNotify(__('trans.message_bulk_delete_subcategory'));
        $this->dispatch('refresh-partials');
    }
}
