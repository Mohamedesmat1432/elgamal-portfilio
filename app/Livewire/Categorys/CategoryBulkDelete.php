<?php

namespace App\Livewire\Categorys;

use App\Livewire\Forms\CategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryBulkDelete extends Component
{
    use NotifyTrait;
    public CategoryForm $form;

    public function render()
    {
        return view('livewire.categorys.category-bulk-delete');
    }

    #[On('bulk-delete-modal')]
    public function bulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-delete-category-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkDelete()
    {
        $this->form->deleteAll($this->form->ids);
        $this->dispatch('close-modal', 'bulk-delete-category-modal');
        $this->dispatch('refresh-category-list');
        $this->successNotify(__('trans.message_bulk_delete_category'));
        $this->dispatch('refresh-partials');
    }
}
