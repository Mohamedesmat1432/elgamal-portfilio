<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\RegisterForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Register extends Component
{
    public RegisterForm $form;

    public function register()
    {
        $this->form->register();
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
