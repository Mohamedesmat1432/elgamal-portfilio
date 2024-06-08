<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\Auth\RegisterForm;

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
