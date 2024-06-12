<?php

namespace App\Livewire\Subcategories;

use App\Livewire\Forms\SubcategoryForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class SubcategoryCreate extends Component
{
    use NotifyTrait;
    public SubcategoryForm $form;

    public function render()
    {
        return view('livewire.subcategories.subcategory-create', [
            'catgeories' => $this->form->categories(),
        ]);
    }

    public function slugName()
    {
        $this->form->slugName();
    }

    #[On('create-modal')]
    public function createModal()
    {
        $this->dispatch('open-modal', 'create-subcategory-modal');
        $this->dispatch('refresh-subcategory-list');
        $this->form->refresh();
    }

    public function create()
    {
        $this->form->store();
        $this->dispatch('refresh-subcategory-list');
        $this->dispatch('close-modal', 'create-subcategory-modal');
        $this->successNotify(__('trans.message_create_subcategory'));
        $this->dispatch('refresh-partials');
    }
}
