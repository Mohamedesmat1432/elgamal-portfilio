<?php

namespace App\Livewire\Trash\Categories;

use App\Livewire\Forms\CategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryForceDelete extends Component
{
    use NotifyTrait;
    public CategoryForm $form;

    public function render()
    {
        return view('livewire.trash.categories.category-force-delete');
    }

    #[On('force-delete-modal')]
    public function forceDeleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'force-delete-category-modal');
        $this->dispatch('refresh-category-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function forceDelete()
    {
        $this->form->forceDelete($this->form->id);
        $this->dispatch('refresh-category-trash-list');
        $this->dispatch('close-modal', 'force-delete-category-modal');
        $this->successNotify(__('trans.message_delete_category'));
        $this->dispatch('refresh-partials');
    }
}
