<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductDelete extends Component
{
    use NotifyTrait;
    public ProductForm $form;

    public function render()
    {
        return view('livewire.products.product-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'delete-product-modal');
        $this->dispatch('refresh-product-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->delete($this->form->id);
        $this->dispatch('refresh-product-list');
        $this->dispatch('close-modal', 'delete-product-modal');
        $this->successNotify(__('trans.message_delete_product'));
        $this->dispatch('refresh-partials');
    }
}
