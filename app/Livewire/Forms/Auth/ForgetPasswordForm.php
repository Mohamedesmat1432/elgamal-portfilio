<?php

namespace App\Livewire\Forms\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Form;

class ForgetPasswordForm extends Form
{
    public ?string $email = '';

    public function sendPasswordResetLink()
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        $this->reset('email');
        session()->flash('status', __($status));
    }
}
