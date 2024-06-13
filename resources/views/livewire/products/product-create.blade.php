<div>
    <x-modal name="create-product-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="create" class="p-6">
            @csrf
            @method('POST')
            <h2 class="text-2xl font-medium text-gray-900">
                <x-icon name="plus-circle" class="w-10 h-10 inline-block" />
                {{ __('trans.create') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('trans.name') }}" class="sr-only" />

                <x-text-input wire:model="form.name" id="createProductName" name="name" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.name') }}" autocomplete="product-name" />

                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="{{ __('trans.description') }}" class="sr-only" />

                <x-text-input wire:model="form.description" id="createProductDescription" name="description" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.description') }}" />

                <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="price" value="{{ __('trans.price') }}" class="sr-only" />

                <x-text-input wire:model="form.price" id="createProductPrice" name="price" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.price') }}" />

                <x-input-error :messages="$errors->get('form.price')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="subcategory_id" value="{{ __('trans.subcategory') }}" class="sr-only" />

                <x-select wire:model="form.subcategory_id" id="createProductSubcategory" name="subcategory_id">
                    <option value="">{{ __('trans.choose') }}</option>
                    @forelse ($subcategories as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @empty
                        <option value="">{{ __('trans.empty_data') }}</option>
                    @endforelse
                </x-select>

                <x-input-error :messages="$errors->get('form.subcategory_id')" class="mt-2" />
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
