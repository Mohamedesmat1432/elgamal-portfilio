<div>
    @can('permission-create')
        <livewire:permissions.permission-create />
    @endcan

    @can('permission-update')
        <livewire:permissions.permission-update />
    @endcan

    @can('permission-delete')
        <livewire:permissions.permission-delete />
    @endcan

    @can('permission-bulk-delete')
        <livewire:permissions.permission-bulk-delete />
    @endcan

    <div class="p-6 my-3 flex-1">
        <x-text-input type="search" wire:model.live.debounce.500ms="search" placeholder="{{ __('trans.search') }}..." />

        @can('permission-create')
            <x-primary-button x-on:click.prevent="$dispatch('create-modal')">
                {{ __('trans.create') }}
            </x-primary-button>
        @else
            <x-primary-button class="cursor-not-allowed bg-gray-500">
                {{ __('trans.create') }}
            </x-primary-button>
        @endcan

        @can('permission-bulk-delete')
            @if (count($this->form->ids) > 0)
                <x-danger-button class="mt-2"
                    x-on:click.prevent="$dispatch('bulk-delete-modal', {ids: '{{ json_encode($this->form->ids) }}'})">
                    {{ __('trans.delete_all') }} {{ count($this->form->ids) }}
                </x-danger-button>
            @endif
        @endcan
    </div>

    <x-table>
        {{-- thead --}}
        <x-slot name="thead">
            <tr>
                @can('permission-bulk-delete')
                    <th class="px-6 py-4">
                        <x-text-input class="cursor-pointer" type="checkbox" wire:model="form.select_all"
                            wire:click="selectAll" />
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
                    {{ __('trans.action') }}
                </th>
            </tr>
        </x-slot>
        {{-- tbody --}}
        <x-slot name="tbody">
            @forelse ($this->permissions as $permission)
                <tr wire:key="permission-{{ $permission->id }}" class="border-b border-neutral-200">
                    @can('permission-bulk-delete')
                        <td class="px-6 py-4">
                            <x-text-input class="cursor-pointer" type="checkbox" wire:model.live="form.ids"
                                value="{{ $permission->id }}" />
                        </td>
                    @endcan
                    <td class="px-6 py-4 font-medium">
                        {{ $permission->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $permission->name }}
                    </td>
                    <td class="px-6 py-4">
                        @can('permission-update')
                            <x-icon name="pencil-square" class="w-10 h-10 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('edit-modal', {id: '{{ $permission->id }}'})" />
                        @else
                            <x-icon name="pencil-square" class="w-10 h-10 text-gray-500 inline-block cursor-not-allowed" />
                        @endcan

                        @can('permission-delete')
                            <x-icon name="trash" class="w-10 h-10 text-red-600 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('delete-modal', {id: '{{ $permission->id }}', name: '{{ $permission->name }}'})" />
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
    <div class="p-6 min-w-full">
        {{ $this->permissions->withQueryString()->links() }}
    </div>
</div>
