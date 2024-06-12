<?php

namespace App\Livewire\Trash\Categorys;

use App\Livewire\Forms\CategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryRestore extends Component
{
    use NotifyTrait;
    public CategoryForm $form;

    public function render()
    {
        return view('livewire.trash.categorys.category-restore');
    }

    #[On('restore-modal')]
    public function restoreModal($id, $name)
    {
        $this->dispatch('open-modal', 'restore-category-modal');
        $this->dispatch('refresh-category-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function restore()
    {
        $this->form->restore($this->form->id);
        $this->dispatch('refresh-category-trash-list');
        $this->dispatch('close-modal', 'restore-category-modal');
        $this->successNotify(__('trans.message_restore_category'));
        $this->dispatch('refresh-partials');
    }
}
