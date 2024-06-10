<div>
    <x-modal name="create-user-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="create" class="p-6">
            @csrf
            <h2 class="text-2xl font-medium text-gray-900">
                <x-icon name="plus-circle" class="w-10 h-10 inline-block" />
                {{ __('trans.create') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('trans.name') }}" class="sr-only" />

                <x-text-input wire:model="form.name" id="createUserName" name="name" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.name') }}" autocomplete="user-name" />

                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="email" value="{{ __('trans.email') }}" class="sr-only" />

                <x-text-input wire:model="form.email" id="createUserEmail" name="email" type="email"
                    class="mt-1 block w-full" placeholder="{{ __('trans.email') }}" autocomplete="off" />

                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('trans.password') }}" class="sr-only" />

                <x-text-input wire:model="form.password" id="createUserPassword" name="password" type="password"
                    class="mt-1 block w-full" placeholder="{{ __('trans.password') }}" autocomplete="off" />

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="password_confirmation" value="{{ __('trans.password_confirmation') }}"
                    class="sr-only" />

                <x-text-input wire:model="form.password_confirmation" id="createUserPasswordConfirmation"
                    name="password_confirmation" type="password" class="mt-1 block w-full"
                    placeholder="{{ __('trans.password_confirmation') }}" autocomplete="off" />

                <x-input-error :messages="$errors->get('form.password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="role" value="{{ __('trans.role') }}" class="sr-only" />

                <x-select wire:model="form.role" id="createUserRole" name="role" multiple>
                    @forelse ($roles as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @empty
                        <option value="">{{ __('trans.empty_data') }}</option>
                    @endforelse
                </x-select>

                <x-input-error :messages="$errors->get('form.role')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-start">
                <x-primary-button>
                    {{ __('trans.create') }}
                </x-primary-button>

                <x-secondary-button class="ms-3" x-on:click="$dispatch('close')">
                    {{ __('trans.cancel') }}
                </x-secondary-button>
            </div>
        </form>
    </x-modal>
</div>
