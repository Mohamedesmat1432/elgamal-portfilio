<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductUpdate extends Component
{
    use NotifyTrait;
    public ProductForm $form;

    public function render()
    {
        return view('livewire.products.product-update', [
            'subcategories' => $this->form->subcategories(),
        ]);
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->dispatch('open-modal', 'update-product-modal');
        $this->dispatch('refresh-product-list');
        $this->form->setProduct($id);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('refresh-product-list');
        $this->dispatch('close-modal', 'update-product-modal');
        $this->successNotify(__('trans.message_update_product'));
        $this->dispatch('refresh-partials');
    }
}
