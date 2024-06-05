<div>
    <x-modal name="create-permission-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="create" class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('trans.create') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('trans.name') }}" class="sr-only" />

                <x-text-input wire:model="form.name" id="name" name="form.name" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.name') }}" />

                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
            </div>

            <div class="mt-6 flex ltr:justify-start rtl:justify-end">
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
