<?php

namespace App\Livewire\Trash\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class SubcategoryRestore extends Component
{
    use NotifyTrait;
    public SubcategoryForm $form;

    public function render()
    {
        return view('livewire.trash.subcategories.subcategory-restore');
    }

    #[On('restore-modal')]
    public function restoreModal($id, $name)
    {
        $this->dispatch('open-modal', 'restore-subcategory-modal');
        $this->dispatch('refresh-subcategory-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function restore()
    {
        $this->form->restore($this->form->id);
        $this->dispatch('refresh-subcategory-trash-list');
        $this->dispatch('close-modal', 'restore-subcategory-modal');
        $this->successNotify(__('trans.message_restore_subcategory'));
        $this->dispatch('refresh-partials');
    }
}
