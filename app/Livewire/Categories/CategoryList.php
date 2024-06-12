<?php

namespace App\Livewire\Categories;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CategoryList extends Component
{
    use SortableTrait, WithPagination;
    public CategoryForm $form;

    public function render()
    {
        $this->authorize('category-list');

        return view('livewire.categories.category-list');
    }

    #[Computed, On('refresh-category-list')]
    public function categories()
    {
        return Category::withoutTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-category-list')]
    public function refreshBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->categories());
    }
}
