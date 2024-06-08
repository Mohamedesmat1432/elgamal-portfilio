<div>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('trans.forget_password_message') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('trans.email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autofocus />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('trans.email_password_reset_link') }}
            </x-primary-button>
        </div>
    </form>
</div>
