<?php

namespace App\Traits;

use App\Livewire\Actions\Logout;

trait WithLogout
{
    public function logout(Logout $logout)
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}
