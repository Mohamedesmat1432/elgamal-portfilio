<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCreate extends Component
{
    use NotifyTrait;
    public ProductForm $form;

    public function render()
    {
        return view('livewire.products.product-create', [
            'subcategories' => $this->form->subcategories(),
        ]);
    }

    #[On('create-modal')]
    public function createModal()
    {
        $this->dispatch('open-modal', 'create-product-modal');
        $this->dispatch('refresh-product-list');
        $this->form->refresh();
    }

    public function create()
    {
        $this->form->store();
        $this->dispatch('refresh-product-list');
        $this->dispatch('close-modal', 'create-product-modal');
        $this->successNotify(__('trans.message_create_product'));
        $this->dispatch('refresh-partials');
    }
}
