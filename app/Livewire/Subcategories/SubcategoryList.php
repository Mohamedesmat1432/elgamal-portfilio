<?php

namespace App\Livewire\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Models\Subcategory;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoryList extends Component
{
    use SortableTrait, WithPagination;
    public SubcategoryForm $form;

    public function render()
    {
        $this->authorize('subcategory-list');

        return view('livewire.subcategories.subcategory-list');
    }

    #[Computed, On('refresh-subcategory-list')]
    public function subcategories()
    {
        return Subcategory::withoutTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-subcategories-list')]
    public function refreshBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->subcategories());
    }
}
