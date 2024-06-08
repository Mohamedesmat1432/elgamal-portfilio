<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\Auth\ResetPasswordForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class ResetPassword extends Component
{
    public ResetPasswordForm $form;

    public function mount(string $token): void
    {
        $this->form->token = $token;

        $this->form->email = request()->string('email');
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }

    public function resetPassword()
    {
        $this->form->resetPassword();
        $this->redirectRoute('login', navigate: true);
    }
}
