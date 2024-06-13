<?php

namespace App\Livewire\Trash\Branches;

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class BranchTrashList extends Component
{
    use SortableTrait, WithPagination;
    public BranchForm $form;

    public function render()
    {
        $this->authorize('branch-trash-list');

        return view('livewire.trash.branches.branch-trash-list');
    }

    #[Computed, On('refresh-branch-trash-list')]
    public function branches()
    {
        return Branch::onlyTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-branch-trash-list')]
    public function refreshForceBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->branches());
    }
}
