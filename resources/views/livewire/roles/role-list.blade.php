<div>
    <livewire:roles.role-create />
    <livewire:roles.role-update />
    <livewire:roles.role-delete />
    <livewire:roles.role-bulk-delete />

    <div class="p-6 my-3 flex-1">
        <x-text-input type="search" wire:model.live.debounce.500ms="search"
                placeholder="{{ __('trans.search') }}..." />

            <x-primary-button x-on:click.prevent="$dispatch('create-modal')">
                {{ __('trans.create') }}
            </x-primary-button>

            @if (count($this->form->ids) > 0)
                <x-danger-button class="mt-2"
                    x-on:click.prevent="$dispatch('bulk-delete-modal', {ids: '{{ json_encode($this->form->ids) }}'})">
                    {{ __('trans.delete_all') }} {{ count($this->form->ids) }}
                </x-danger-button>
            @endif
    </div>

    <x-table>
        {{-- thead --}}
        <x-slot name="thead">
            <tr>
                <th class="px-6 py-4">
                    <x-text-input class="cursor-pointer" type="checkbox" wire:model="form.select_all"
                        wire:click="selectAll" />
                </th>
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
                    <td class="px-6 py-4">
                        <x-text-input class="cursor-pointer" type="checkbox" wire:model.live="form.ids"
                            value="{{ $role->id }}" />
                    </td>
                    <td class="px-6 py-4 font-medium">
                        {{ $role->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $role->name }}
                    </td>
                    <td class="px-6 py-4">
                        <x-icon name="pencil-square" class="w-10 h-10 inline-block cursor-pointer"
                            x-on:click.prevent="$dispatch('edit-modal', {id: '{{ $role->id }}'})" />

                        <x-icon name="trash" class="w-10 h-10 text-red-600 inline-block cursor-pointer"
                            x-on:click.prevent="$dispatch('delete-modal', {id: '{{ $role->id }}', name: '{{ $role->name }}'})" />
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
        {{-- pagination --}}
    </x-table>
    <div class="p-6 min-w-full">
        {{ $this->roles->withQueryString()->links() }}
    </div>

</div>
