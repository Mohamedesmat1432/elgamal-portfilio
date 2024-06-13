<?php

namespace App\Livewire\Trash\Products;

use App\Livewire\Forms\ProductForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductBulkRestore extends Component
{
    use NotifyTrait;
    public ProductForm $form;

    public function render()
    {
        return view('livewire.trash.products.product-bulk-restore');
    }

    #[On('bulk-restore-modal')]
    public function bulkRestoreModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-restore-product-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkRestore()
    {
        $this->form->restoreAll($this->form->ids);
        $this->dispatch('refresh-product-trash-list');
        $this->dispatch('close-modal', 'bulk-restore-product-modal');
        $this->successNotify(__('trans.message_bulk_restore_product'));
        $this->dispatch('refresh-partials');
    }
}
