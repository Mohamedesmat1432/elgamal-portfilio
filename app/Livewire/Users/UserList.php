<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use App\Traits\WithSortable;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithSortable, WithPagination;

    public UserForm $form;

    public function render()
    {
        return view('livewire.users.user-list');
    }

    #[Computed(), On('refresh-user-list')]
    public function users()
    {
        // $this->authorize('user-list');
        return User::withoutTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-user-list')]
    public function refreshBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->users());
    }
}
