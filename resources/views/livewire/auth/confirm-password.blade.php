<div>
    <x-slot name="title">
        {{ __('trans.confirm_password') }}
    </x-slot>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('trans.confirm_password_before_continue') }}
    </div>

    <form wire:submit="confirmPassword">
        @csrf
        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('trans.password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('trans.confirm') }}
            </x-primary-button>
        </div>
    </form>
</div>
