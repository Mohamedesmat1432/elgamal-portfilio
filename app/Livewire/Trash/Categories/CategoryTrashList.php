<?php

namespace App\Livewire\Trash\Categories;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CategoryTrashList extends Component
{
    use SortableTrait, WithPagination;
    public CategoryForm $form;

    public function render()
    {
        $this->authorize('category-trash-list');

        return view('livewire.trash.categories.category-trash-list');
    }

    #[Computed, On('refresh-category-trash-list')]
    public function categories()
    {
        return Category::onlyTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-category-trash-list')]
    public function refreshForceBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->categories());
    }
}
