<?php

namespace App\Livewire\Trash\Categorys;

use App\Livewire\Forms\CategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryForceBulkDelete extends Component
{
    use NotifyTrait;
    public CategoryForm $form;

    public function render()
    {
        return view('livewire.trash.categorys.category-force-bulk-delete');
    }

    #[On('force-bulk-delete-modal')]
    public function forceBulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'force-bulk-delete-category-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function forceBulkDelete()
    {
        $this->form->forceDeleteAll($this->form->ids);
        $this->dispatch('refresh-category-trash-list');
        $this->dispatch('close-modal', 'force-bulk-delete-category-modal');
        $this->successNotify(__('trans.message_bulk_delete_category'));
        $this->dispatch('refresh-partials');
    }
}
