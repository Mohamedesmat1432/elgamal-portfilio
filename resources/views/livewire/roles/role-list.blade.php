<div>
    @can('role-create')
        <livewire:roles.role-create />
    @endcan

    @can('role-update')
        <livewire:roles.role-update />
    @endcan

    @can('role-delete')
        <livewire:roles.role-delete />
    @endcan

    @can('role-bulk-delete')
        <livewire:roles.role-bulk-delete />
    @endcan

    <div class="p-6 my-3 flex-1">
        <x-text-input type="search" wire:model.live.debounce.500ms="search" placeholder="{{ __('trans.search') }}..." />

        @can('role-create')
            <x-primary-button x-on:click.prevent="$dispatch('create-modal')">
                {{ __('trans.create') }}
            </x-primary-button>
        @else
            <x-primary-button class="cursor-not-allowed bg-gray-500">
                {{ __('trans.create') }}
            </x-primary-button>
        @endcan

        @can('role-bulk-delete')
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
                @can('role-bulk-delete')
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
            @forelse ($this->roles as $role)
                <tr wire:key="role-{{ $role->id }}" class="border-b border-neutral-200">
                    @can('role-bulk-delete')
                        <td class="px-6 py-4">
                            <x-text-input class="cursor-pointer" type="checkbox" wire:model.live="form.ids"
                                value="{{ $role->id }}" />
                        </td>
                    @endcan
                    <td class="px-6 py-4 font-medium">
                        {{ $role->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $role->name }}
                    </td>
                    <td class="px-6 py-4">
                        @can('role-update')
                            <x-icon name="pencil-square" class="w-10 h-10 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('edit-modal', {id: '{{ $role->id }}'})" />
                        @else
                            <x-icon name="pencil-square" class="w-10 h-10 text-gray-500 inline-block cursor-not-allowed" />
                        @endcan

                        @can('role-delete')
                            <x-icon name="trash" class="w-10 h-10 text-red-600 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('delete-modal', {id: '{{ $role->id }}', name: '{{ $role->name }}'})" />
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
        {{ $this->roles->withQueryString()->links() }}
    </div>
</div>
