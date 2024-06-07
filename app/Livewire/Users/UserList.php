<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use App\Traits\WithSortable;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class UserList extends Component
{
    use WithSortable, WithPagination;

    public UserForm $form;

    public function render()
    {
        $this->authorize('user-list');

        return view('livewire.users.user-list');
    }

    #[Computed, On('refresh-user-list')]
    public function users()
    {
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
