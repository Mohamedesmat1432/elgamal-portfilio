<?php

namespace App\Livewire\Trash\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class SubcategoryForceBulkDelete extends Component
{
    use NotifyTrait;
    public SubcategoryForm $form;

    public function render()
    {
        return view('livewire.trash.subcategories.subcategory-force-bulk-delete');
    }

    #[On('force-bulk-delete-modal')]
    public function forceBulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'force-bulk-delete-subcategory-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function forceBulkDelete()
    {
        $this->form->forceDeleteAll($this->form->ids);
        $this->dispatch('refresh-subcategory-trash-list');
        $this->dispatch('close-modal', 'force-bulk-delete-subcategory-modal');
        $this->successNotify(__('trans.message_bulk_delete_subcategory'));
        $this->dispatch('refresh-partials');
    }
}
