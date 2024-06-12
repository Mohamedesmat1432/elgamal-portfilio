<?php

namespace App\Livewire\Categories;

use App\Livewire\Forms\CategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryDelete extends Component
{
    use NotifyTrait;
    public CategoryForm $form;

    public function render()
    {
        return view('livewire.categories.category-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'delete-category-modal');
        $this->dispatch('refresh-category-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->delete($this->form->id);
        $this->dispatch('refresh-category-list');
        $this->dispatch('close-modal', 'delete-category-modal');
        $this->successNotify(__('trans.message_delete_category'));
        $this->dispatch('refresh-partials');
    }
}
