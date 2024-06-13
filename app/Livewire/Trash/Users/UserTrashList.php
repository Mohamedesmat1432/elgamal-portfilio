<?php

namespace App\Livewire\Trash\Users;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class UserTrashList extends Component
{
    use SortableTrait, WithPagination;
    public UserForm $form;

    public function render()
    {
        $this->authorize('user-trash-list');

        return view('livewire.trash.users.user-trash-list');
    }

    #[Computed, On('refresh-user-trash-list')]
    public function users()
    {
        return User::onlyTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-user-trash-list')]
    public function refreshForceBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->users());
    }
}
