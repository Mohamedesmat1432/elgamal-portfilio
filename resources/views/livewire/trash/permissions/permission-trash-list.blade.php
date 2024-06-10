<div>
    @can('permission-restore')
        <livewire:trash.permissions.permission-restore />
    @endcan

    @can('permission-bulk-restore')
        <livewire:trash.permissions.permission-bulk-restore />
    @endcan

    @can('permission-force-delete')
        <livewire:trash.permissions.permission-force-delete />
    @endcan

    @can('permission-force-bulk-delete')
        <livewire:trash.permissions.permission-force-bulk-delete />
    @endcan

    <div class="p-6 my-2">
        <x-text-input type="search" wire:model.live.debounce.500ms="search" placeholder="{{ __('trans.search') }}..."
            id="permissionSearch" name="search" />

        <div class="mt-2">
            @can('permission-bulk-restore')
                @if (count($this->form->ids) > 0)
                    <x-primary-button
                        x-on:click.prevent="$dispatch('bulk-restore-modal', {ids: '{{ json_encode($this->form->ids) }}'})">
                        <x-icon name="arrow-uturn-left" class="w-4 h-4 text-white inline-block" />
                        {{ __('trans.restore') }}
                    </x-primary-button>
                @endif
            @endcan

            @can('permission-force-bulk-delete')
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
                @can('permission-force-bulk-delete')
                    <th class="px-6 py-4">
                        <x-text-input class="cursor-pointer" type="checkbox" wire:model="form.select_all"
                            wire:click="selectAll" id="permissionSelectAll" name="select_all" />
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
                <tr wire:key="trash-permission-{{ $permission->id }}" class="border-b border-neutral-200">
                    @can('permission-bulk-delete')
                        <td class="px-6 py-4">
                            <x-text-input class="cursor-pointer" type="checkbox" wire:model.live="form.ids"
                                value="{{ $permission->id }}" id="permissionIds" name="ids" />
                        </td>
                    @endcan
                    <td class="px-6 py-4 font-medium">
                        {{ $permission->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $permission->name }}
                    </td>
                    <td class="px-6 py-4">
                        @can('permission-restore')
                            <x-icon name="arrow-uturn-left" class="w-10 h-10 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('restore-modal', {id: '{{ $permission->id }}', name: '{{ $permission->name }}'})" />
                        @else
                            <x-icon name="arrow-uturn-left"
                                class="w-10 h-10 text-gray-500 inline-block cursor-not-allowed" />
                        @endcan

                        @can('permission-force-delete')
                            <x-icon name="trash" class="w-10 h-10 text-red-600 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('force-delete-modal', {id: '{{ $permission->id }}', name: '{{ $permission->name }}'})" />
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
