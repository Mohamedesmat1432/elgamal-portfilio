<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\Auth\ForgetPasswordForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class ForgotPassword extends Component
{
    public ForgetPasswordForm $form;

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }

    public function sendPasswordResetLink()
    {
        $this->form->sendPasswordResetLink();
    }
}
