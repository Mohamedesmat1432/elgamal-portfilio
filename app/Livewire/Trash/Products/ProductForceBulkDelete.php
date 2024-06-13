<?php

namespace App\Livewire\Trash\Products;

use App\Livewire\Forms\ProductForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductForceBulkDelete extends Component
{
    use NotifyTrait;
    public ProductForm $form;

    public function render()
    {
        return view('livewire.trash.products.product-force-bulk-delete');
    }

    #[On('force-bulk-delete-modal')]
    public function forceBulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'force-bulk-delete-product-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function forceBulkDelete()
    {
        $this->form->forceDeleteAll($this->form->ids);
        $this->dispatch('refresh-product-trash-list');
        $this->dispatch('close-modal', 'force-bulk-delete-product-modal');
        $this->successNotify(__('trans.message_bulk_delete_product'));
        $this->dispatch('refresh-partials');
    }
}
