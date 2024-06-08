<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Forms\Auth\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class Login extends Component
{
    public LoginForm $form;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}
