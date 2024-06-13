<?php

namespace App\Livewire\Branches;

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class BranchList extends Component
{
    use SortableTrait, WithPagination;
    public BranchForm $form;

    public function render()
    {
        $this->authorize('branch-list');

        return view('livewire.branches.branch-list');
    }

    #[Computed, On('refresh-branch-list')]
    public function branches()
    {
        return Branch::withoutTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-branch-list')]
    public function refreshBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->branches());
    }
}
