<?php

namespace App\Traits;

trait WithNotify
{
    public function successNotify($message, $style = 'success')
    {
        $this->dispatch('notify', message: $message, style: $style);
    }

    public function errorNotify($message, $style = 'danger')
    {
        $this->dispatch('notify', message: $message, style: $style);
    }
}
