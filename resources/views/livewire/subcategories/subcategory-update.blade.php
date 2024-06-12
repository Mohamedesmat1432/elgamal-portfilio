<div>
    <x-modal name="update-subcategory-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="update" class="p-6">
            @csrf
            <h2 class="text-2xl font-medium text-gray-900">
                <x-icon name="pencil-square" class="w-10 h-10 inline-block" />
                {{ __('trans.update') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('trans.name') }}" class="sr-only" />

                <x-text-input wire:model="form.name" id="updateCategoryName" name="name" type="text"
                    wire:keyup="slugName" class="mt-1 block w-full" placeholder="{{ __('trans.name') }}"
                    autocomplete="subcategory-name" />

                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="slug" value="{{ __('trans.slug') }}" class="sr-only" />

                <x-text-input wire:model="form.slug" id="updateCategorySlug" name="slug" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.slug') }}" />

                <x-input-error :messages="$errors->get('form.slug')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="category_id" value="{{ __('trans.category') }}" class="sr-only" />

                <x-select wire:model="form.category_id" id="updateSubcategoryCategoryId" name="category_id">
                    <option value="">{{ __('trans.choose') }}</option>
                    @forelse ($catgeories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                        <option value="">{{ __('trans.empty_data') }}</option>
                    @endforelse
                </x-select>

                <x-input-error :messages="$errors->get('form.category_id')" class="mt-2" />
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
