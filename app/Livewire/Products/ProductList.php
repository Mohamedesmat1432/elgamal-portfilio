<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ProductList extends Component
{
    use SortableTrait, WithPagination;
    public ProductForm $form;

    public function render()
    {
        $this->authorize('product-list');

        return view('livewire.products.product-list');
    }

    #[Computed, On('refresh-product-list')]
    public function products()
    {
        return Product::withoutTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-product-list')]
    public function refreshBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->products());
    }
}
