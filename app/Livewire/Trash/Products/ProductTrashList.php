<?php

namespace App\Livewire\Trash\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ProductTrashList extends Component
{
    use SortableTrait, WithPagination;
    public ProductForm $form;

    public function render()
    {
        $this->authorize('product-trash-list');

        return view('livewire.trash.products.product-trash-list');
    }

    #[Computed, On('refresh-product-trash-list')]
    public function products()
    {
        return Product::onlyTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-product-trash-list')]
    public function refreshForceBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->products());
    }
}
