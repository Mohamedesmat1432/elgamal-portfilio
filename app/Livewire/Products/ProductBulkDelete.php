<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductBulkDelete extends Component
{
    use NotifyTrait;
    public ProductForm $form;

    public function render()
    {
        return view('livewire.products.product-bulk-delete');
    }

    #[On('bulk-delete-modal')]
    public function bulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-delete-product-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkDelete()
    {
        $this->form->deleteAll($this->form->ids);
        $this->dispatch('close-modal', 'bulk-delete-product-modal');
        $this->dispatch('refresh-product-list');
        $this->successNotify(__('trans.message_bulk_delete_product'));
        $this->dispatch('refresh-partials');
    }
}
