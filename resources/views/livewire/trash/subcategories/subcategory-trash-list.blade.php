<div>
    @can('subcategory-restore')
        <livewire:trash.subcategories.subcategory-restore />
    @endcan

    @can('subcategory-bulk-restore')
        <livewire:trash.subcategories.subcategory-bulk-restore />
    @endcan

    @can('subcategory-force-delete')
        <livewire:trash.subcategories.subcategory-force-delete />
    @endcan

    @can('subcategory-force-bulk-delete')
        <livewire:trash.subcategories.subcategory-force-bulk-delete />
    @endcan

    <div class="px-8 py-6 mx-8 mt-8">
        <div class="flex">
            <x-text-input type="search" wire:model.live.debounce.500ms="search" placeholder="{{ __('trans.search') }}..."
                id="subcategorySearch" name="search" />

            @can('subcategory-bulk-restore')
                @if (count($this->form->ids) > 0)
                    <x-primary-button class="mx-2"
                        x-on:click.prevent="$dispatch('bulk-restore-modal', {ids: '{{ json_encode($this->form->ids) }}'})">
                        <x-icon name="arrow-uturn-left" class="w-4 h-4 text-white inline-block" />
                        {{ __('trans.restore') }}
                    </x-primary-button>
                @endif
            @endcan
        </div>

        <div class="mt-2">
            @can('subcategory-force-bulk-delete')
                @if (count($this->form->ids) > 0)
                    <x-danger-button
                        x-on:click.prevent="$dispatch('force-bulk-delete-modal', {ids: '{{ json_encode($this->form->ids) }}'})">
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
                @can('subcategory-force-bulk-delete')
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
                <tr wire:key="trash-subcategory-{{ $subcategory->id }}" class="border-b border-neutral-200">
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
                        @can('subcategory-restore')
                            <x-icon name="arrow-uturn-left" class="w-10 h-10 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('restore-modal', {id: '{{ $subcategory->id }}', name: '{{ $subcategory->name }}'})" />
                        @else
                            <x-icon name="arrow-uturn-left" class="w-10 h-10 inline-block cursor-not-allowed" />
                        @endcan

                        @can('subcategory-force-delete')
                            <x-icon name="trash" class="w-10 h-10 text-red-600 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('force-delete-modal', {id: '{{ $subcategory->id }}', name: '{{ $subcategory->name }}'})" />
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
