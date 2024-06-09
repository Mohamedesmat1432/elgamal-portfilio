<div>
    <x-modal name="create-role-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="create" class="p-6">
            @csrf
            <h2 class="text-2xl font-medium text-gray-900">
                <x-icon name="plus-circle" class="w-10 h-10 inline-block" />
                {{ __('trans.create') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('trans.name') }}" class="sr-only" />

                <x-text-input wire:model="form.name" id="name" name="name" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.name') }}" />

                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="permission" value="{{ __('trans.permission') }}" class="sr-only" />

                <x-select wire:model="form.permission" id="permission" name="permission" multiple>
                    @forelse ($permissions as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @empty
                        <option value="">{{ __('trans.empty_data') }}</option>
                    @endforelse
                </x-select>

                <x-input-error :messages="$errors->get('form.permission')" class="mt-2" />
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
