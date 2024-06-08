<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\Auth\ConfirmPasswordForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class ConfirmPassword extends Component
{
    public ConfirmPasswordForm $form;

    public function render()
    {
        return view('livewire.auth.confirm-password');
    }

    public function confirmPassword()
    {
        $this->form->confirmPassword();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}
