<div>
    @can('product-create')
        <livewire:products.product-create />
    @endcan

    @can('product-update')
        <livewire:products.product-update />
    @endcan

    @can('product-delete')
        <livewire:products.product-delete />
    @endcan

    @can('product-bulk-delete')
        <livewire:products.product-bulk-delete />
    @endcan

    <div class="px-8 py-6 mx-8 mt-8">
        <div class="flex">
            <x-text-input type="search" wire:model.live.debounce.500ms="search" placeholder="{{ __('trans.search') }}..."
                id="productSearch" name="search" />

            @can('product-create')
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
            @can('product-bulk-delete')
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
                @can('product-bulk-delete')
                    <th class="px-6 py-4">
                        <x-text-input class="cursor-pointer" type="checkbox" wire:model="form.select_all"
                            wire:click="selectAll" id="productSelectAll" name="select_all" />
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
                    <button wire:click="sortBy('description')" class="flex justify-center w-full">
                        {{ __('trans.description') }}
                        <x-sort-icon field="description" :sort_by="$sort_by" :sort_dir="$sort_dir" />
                    </button>
                </th>
                <th class="px-6 py-4">
                    <button wire:click="sortBy('price')" class="flex justify-center w-full">
                        {{ __('trans.price') }}
                        <x-sort-icon field="price" :sort_by="$sort_by" :sort_dir="$sort_dir" />
                    </button>
                </th>
                <th class="px-6 py-4">
                    <button wire:click="sortBy('subcategory_id')" class="flex justify-center w-full">
                        {{ __('trans.subcategory') }}
                        <x-sort-icon field="subcategory_id" :sort_by="$sort_by" :sort_dir="$sort_dir" />
                    </button>
                </th>
                <th class="px-6 py-4">
                    {{ __('trans.action') }}
                </th>
            </tr>
        </x-slot>
        {{-- tbody --}}
        <x-slot name="tbody">
            @forelse ($this->products() as $product)
                <tr wire:key="product-{{ $product->id }}" class="border-b border-neutral-200">
                    @can('product-bulk-delete')
                        <td class="px-6 py-4">
                            <x-text-input class="cursor-pointer" type="checkbox" wire:model.live="form.ids"
                                value="{{ $product->id }}" id="productIds" name="ids" />
                        </td>
                    @endcan
                    <td class="px-6 py-4 font-medium">
                        {{ $product->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->price }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->subcategory->name ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        @can('product-update')
                            <x-icon name="pencil-square" class="w-10 h-10 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('edit-modal', {id: '{{ $product->id }}'})" />
                        @else
                            <x-icon name="pencil-square" class="w-10 h-10 inline-block cursor-not-allowed" />
                        @endcan

                        @can('product-delete')
                            <x-icon name="trash" class="w-10 h-10 text-red-600 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('delete-modal', {id: '{{ $product->id }}', name: '{{ $product->name }}'})" />
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
        {{ $this->products()->withQueryString()->links() }}
    </div>
</div>
