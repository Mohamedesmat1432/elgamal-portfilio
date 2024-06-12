<?php

namespace App\Livewire\Categorys;

use App\Livewire\Forms\CategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryCreate extends Component
{
    use NotifyTrait;
    public CategoryForm $form;

    public function render()
    {
        return view('livewire.categorys.category-create');
    }

    public function slugName()
    {
        $this->form->slugName();
    }

    #[On('create-modal')]
    public function createModal()
    {
        $this->dispatch('open-modal', 'create-category-modal');
        $this->dispatch('refresh-category-list');
        $this->form->refresh();
    }

    public function create()
    {
        $this->form->store();
        $this->dispatch('refresh-category-list');
        $this->dispatch('close-modal', 'create-category-modal');
        $this->successNotify(__('trans.message_create_category'));
        $this->dispatch('refresh-partials');
    }
}
