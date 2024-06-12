<div>
    @can('subcategory-create')
        <livewire:subcategories.subcategory-create />
    @endcan

    @can('subcategory-update')
        <livewire:subcategories.subcategory-update />
    @endcan

    @can('subcategory-delete')
        <livewire:subcategories.subcategory-delete />
    @endcan

    @can('subcategory-bulk-delete')
        <livewire:subcategories.subcategory-bulk-delete />
    @endcan

    <div class="px-8 py-6 mx-8 mt-8">
        <div class="flex">
            <x-text-input type="search" wire:model.live.debounce.500ms="search" placeholder="{{ __('trans.search') }}..."
                id="subcategorySearch" name="search" />

            @can('subcategory-create')
                <x-primary-button class="mx-2" x-on:click.prevent="$dispatch('create-modal')">
                    <x-icon name="plus" class="w-4 h-4 text-white inline-block" />
                    {{ __('trans.create') }}
                </x-primary-button>
            @else
                <x-primary-button class="cursor-not-allowed bg-gray-500 mx-2">
                    <x-icon name="plus" class="w-4 h-4 text-white inline-block" />
                    {{ __('trans.create') }}
                </x-primary-button>
            @endcan
        </div>

        <div class="mt-2">
            @can('subcategory-bulk-delete')
                @if (count($this->form->ids) > 0)
                    <x-danger-button
                        x-on:click.prevent="$dispatch('bulk-delete-modal', {ids: '{{ json_encode($this->form->ids) }}'})">
                        <x-icon name="trash" class="w-4 h-4 text-white inline-block" />
                        <span>{{ __('trans.delete_all') }} {{ count($this->form->ids) }}</span>
                    </x-danger-button>
                @endif
            @endcan
        </div>
    </div>

    <x-table>
        {{-- thead --}}
        <x-slot name="thead">
            <tr>
                @can('subcategory-bulk-delete')
                    <th class="px-6 py-4">
                        <x-text-input class="cursor-pointer" type="checkbox" wire:model="form.select_all"
                            wire:click="selectAll" id="subcategorySelectAll" name="select_all" />
                    </th>
                @endcan
                <th class="px-6 py-4">
                    <button wire:click="sortBy('id')" class="flex justify-center w-full">
                        #
                        <x-sort-icon field="id" :sort_by="$sort_by" :sort_dir="$sort_dir" />
                    </button>
                </th>
                <th class="px-6 py-4">
                    <button wire:click="sortBy('name')" class="flex justify-center w-full">
                        {{ __('trans.name') }}
                        <x-sort-icon field="name" :sort_by="$sort_by" :sort_dir="$sort_dir" />
                    </button>
                </th>
                <th class="px-6 py-4">
                    <button wire:click="sortBy('slug')" class="flex justify-center w-full">
                        {{ __('trans.slug') }}
                        <x-sort-icon field="slug" :sort_by="$sort_by" :sort_dir="$sort_dir" />
                    </button>
                </th>
                <th class="px-6 py-4">
                    {{ __('trans.action') }}
                </th>
            </tr>
        </x-slot>
        {{-- tbody --}}
        <x-slot name="tbody">
            @forelse ($this->subcategories() as $subcategory)
                <tr wire:key="subcategory-{{ $subcategory->id }}" class="border-b border-neutral-200">
                    @can('subcategory-bulk-delete')
                        <td class="px-6 py-4">
                            <x-text-input class="cursor-pointer" type="checkbox" wire:model.live="form.ids"
                                value="{{ $subcategory->id }}" id="subcategoryIds" name="ids" />
                        </td>
                    @endcan
                    <td class="px-6 py-4 font-medium">
                        {{ $subcategory->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $subcategory->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $subcategory->slug }}
                    </td>
                    <td class="px-6 py-4">
                        @can('subcategory-update')
                            <x-icon name="pencil-square" class="w-10 h-10 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('edit-modal', {id: '{{ $subcategory->id }}'})" />
                        @else
                            <x-icon name="pencil-square" class="w-10 h-10 inline-block cursor-not-allowed" />
                        @endcan

                        @can('subcategory-delete')
                            <x-icon name="trash" class="w-10 h-10 text-red-600 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('delete-modal', {id: '{{ $subcategory->id }}', name: '{{ $subcategory->name }}'})" />
                        @else
                            <x-icon name="trash" class="w-10 h-10 text-red-300 inline-block cursor-not-allowed" />
                        @endcan
                    </td>
                </tr>
            @empty
                <tr class="border-b border-neutral-200">
                    <td class="px-6 py-4" colspan="3">
                        {{ __('trans.empty_data') }}
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>

    {{-- pagination --}}
    <div class="px-8 mx-8 my-3 py-3">
        {{ $this->subcategories()->withQueryString()->links() }}
    </div>
</div>
