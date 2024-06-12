<?php

namespace App\Livewire\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class SubcategoryDelete extends Component
{
    use NotifyTrait;
    public SubcategoryForm $form;

    public function render()
    {
        return view('livewire.subcategories.subcategory-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'delete-subcategory-modal');
        $this->dispatch('refresh-category-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->delete($this->form->id);
        $this->dispatch('refresh-subcategory-list');
        $this->dispatch('close-modal', 'delete-subcategory-modal');
        $this->successNotify(__('trans.message_delete_subcategory'));
        $this->dispatch('refresh-partials');
    }
}
