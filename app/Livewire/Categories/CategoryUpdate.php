<?php

namespace App\Livewire\Categories;

use App\Livewire\Forms\CategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryUpdate extends Component
{
    use NotifyTrait;
    public CategoryForm $form;

    public function render()
    {
        return view('livewire.categories.category-update');
    }

    public function slugName()
    {
        $this->form->slugName();
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->dispatch('open-modal', 'update-category-modal');
        $this->dispatch('refresh-category-list');
        $this->form->setCategory($id);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('refresh-category-list');
        $this->dispatch('close-modal', 'update-category-modal');
        $this->successNotify(__('trans.message_update_category'));
        $this->dispatch('refresh-partials');
    }
}
