<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('trans.delete_account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('trans.info_for_delete_account') }}
        </p>
    </header>

    <x-danger-button x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('trans.delete_account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('trans.confirm_delete_account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('trans.info_for_delete_account') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('trans.password') }}" class="sr-only" />

                <x-text-input wire:model="password" id="password" name="password" type="password"
                    class="mt-1 block w-full" placeholder="{{ __('trans.password') }}" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex ltr:justify-start rtl:justify-end">
                <x-danger-button>
                    {{ __('trans.delete_account') }}
                </x-danger-button>

                <x-secondary-button class="ms-3" x-on:click="$dispatch('close')">
                    {{ __('trans.cancel') }}
                </x-secondary-button>
            </div>
        </form>
    </x-modal>
</section>
