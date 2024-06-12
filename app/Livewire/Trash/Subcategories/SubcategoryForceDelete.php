<?php

namespace App\Livewire\Trash\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class SubcategoryForceDelete extends Component
{
    use NotifyTrait;
    public SubcategoryForm $form;

    public function render()
    {
        return view('livewire.trash.subcategories.subcategory-force-delete');
    }

    #[On('force-delete-modal')]
    public function forceDeleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'force-delete-subcategory-modal');
        $this->dispatch('refresh-subcategory-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function forceDelete()
    {
        $this->form->forceDelete($this->form->id);
        $this->dispatch('refresh-subcategory-trash-list');
        $this->dispatch('close-modal', 'force-delete-subcategory-modal');
        $this->successNotify(__('trans.message_delete_subcategory'));
        $this->dispatch('refresh-partials');
    }
}
