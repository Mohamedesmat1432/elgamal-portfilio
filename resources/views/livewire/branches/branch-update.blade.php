<div>
    <x-modal name="update-branch-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="update" class="p-6">
            @csrf
            <h2 class="text-2xl font-medium text-gray-900">
                <x-icon name="pencil-square" class="w-10 h-10 inline-block" />
                {{ __('trans.update') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('trans.name') }}" class="sr-only" />

                <x-text-input wire:model="form.name" id="updateBranchName" name="name" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.name') }}" autocomplete="branch-name" />

                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="address" value="{{ __('trans.address') }}" class="sr-only" />

                <x-text-input wire:model="form.address" id="updateBranchAddress" name="address" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.address') }}" />

                <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-start">
                <x-primary-button>
                    {{ __('trans.update') }}
                </x-primary-button>

                <x-secondary-button class="ms-3" x-on:click="$dispatch('close')">
                    {{ __('trans.cancel') }}
                </x-secondary-button>
            </div>
        </form>
    </x-modal>
</div>
