<?php

namespace App\Livewire\Trash\Products;

use App\Livewire\Forms\ProductForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductRestore extends Component
{
    use NotifyTrait;
    public ProductForm $form;

    public function render()
    {
        return view('livewire.trash.products.product-restore');
    }

    #[On('restore-modal')]
    public function restoreModal($id, $name)
    {
        $this->dispatch('open-modal', 'restore-product-modal');
        $this->dispatch('refresh-product-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function restore()
    {
        $this->form->restore($this->form->id);
        $this->dispatch('refresh-product-trash-list');
        $this->dispatch('close-modal', 'restore-product-modal');
        $this->successNotify(__('trans.message_restore_product'));
        $this->dispatch('refresh-partials');
    }
}
