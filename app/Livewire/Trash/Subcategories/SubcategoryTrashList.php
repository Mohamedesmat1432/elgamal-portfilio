<?php

namespace App\Livewire\Trash\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Models\Subcategory;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class SubcategoryTrashList extends Component
{
    use SortableTrait, WithPagination;
    public SubcategoryForm $form;

    public function render()
    {
        $this->authorize('subcategory-trash-list');

        return view('livewire.trash.subcategories.subcategory-trash-list');
    }

    #[Computed, On('refresh-subcategory-trash-list')]
    public function subcategories()
    {
        return Subcategory::onlyTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-subcategory-trash-list')]
    public function refreshForceBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->subcategories());
    }
}
