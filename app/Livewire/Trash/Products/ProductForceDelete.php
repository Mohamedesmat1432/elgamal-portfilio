<?php

namespace App\Livewire\Trash\Products;

use App\Livewire\Forms\ProductForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductForceDelete extends Component
{
    use NotifyTrait;
    public ProductForm $form;

    public function render()
    {
        return view('livewire.trash.products.product-force-delete');
    }

    #[On('force-delete-modal')]
    public function forceDeleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'force-delete-product-modal');
        $this->dispatch('refresh-product-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function forceDelete()
    {
        $this->form->forceDelete($this->form->id);
        $this->dispatch('refresh-product-trash-list');
        $this->dispatch('close-modal', 'force-delete-product-modal');
        $this->successNotify(__('trans.message_delete_product'));
        $this->dispatch('refresh-partials');
    }
}
