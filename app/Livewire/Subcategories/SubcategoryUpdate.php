<?php

namespace App\Livewire\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class SubcategoryUpdate extends Component
{
    use NotifyTrait;
    public SubcategoryForm $form;

    public function render()
    {
        return view('livewire.subcategories.subcategory-update', [
            'catgeories' => $this->form->categories(),
        ]);
    }

    public function slugName()
    {
        $this->form->slugName();
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->dispatch('open-modal', 'update-subcategory-modal');
        $this->dispatch('refresh-category-list');
        $this->form->setSubcategory($id);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('refresh-subcategory-list');
        $this->dispatch('close-modal', 'update-subcategory-modal');
        $this->successNotify(__('trans.message_update_subcategory'));
        $this->dispatch('refresh-partials');
    }
}
