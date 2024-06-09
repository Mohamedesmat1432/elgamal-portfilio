<?php

namespace App\Livewire\Forms;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class ConfirmPasswordForm extends Form
{
    public ?string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (
            !Auth::guard('web')->validate([
                'email' => Auth::user()->email,
                'password' => $this->password,
            ])
        ) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);
    }
}
