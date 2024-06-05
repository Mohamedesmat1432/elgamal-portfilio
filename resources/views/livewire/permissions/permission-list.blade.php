<div>
    <x-table>
        <x-slot name="modal">
            <livewire:permissions.permission-create />
            <livewire:permissions.permission-update />
            <livewire:permissions.permission-delete />
            <livewire:permissions.permission-bulk-delete />
        </x-slot>

        {{-- tsearch --}}
        <x-slot name="search">
            <x-text-input type="search" wire:model.live.debounce.500ms="search"
                placeholder="{{ __('trans.search') }}..." />

            <x-primary-button x-on:click.prevent="$dispatch('create-modal')">
                {{ __('trans.create') }}
            </x-primary-button>

            @if (count($this->form->ids) > 0)
                <x-danger-button
                    x-on:click.prevent="$dispatch('bulk-delete-modal', {ids: '{{ json_encode($this->form->ids) }}'})">
                    {{ __('trans.delete_all') }}
                    {{ count($this->form->ids) }}
                </x-danger-button>
            @endif
        </x-slot>
        {{-- thead --}}
        <x-slot name="thead">
            <tr>
                <th class="px-6 py-4">
                    <x-text-input type="checkbox" wire:model="form.selected_all" wire:click="selectAll"/>
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
                <th class="px-6 py-4" colspan="2">
                    {{ __('trans.action') }}
                </th>
            </tr>
        </x-slot>
        {{-- tbody --}}
        <x-slot name="tbody">
            @forelse ($permissions as $permission)
                <tr wire:key="permission-{{ $permission->id }}" class="border-b border-neutral-200">
                    <td class="px-6 py-4">
                        <x-text-input type="checkbox" wire:model.live="form.ids" value="{{ $permission->id }}" />
                    </td>
                    <td class="px-6 py-4 font-medium">
                        {{ $permission->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $permission->name }}
                    </td>
                    <td class="px-6 py-4">
                        <x-primary-button x-on:click.prevent="$dispatch('edit-modal', {id: '{{ $permission->id }}'})">
                            {{ __('trans.edit') }}
                        </x-primary-button>
                    </td>
                    <td class="px-6 py-4">
                        <x-danger-button
                            x-on:click.prevent="$dispatch('delete-modal', {id: '{{ $permission->id }}', name: '{{ $permission->name }}'})">
                            {{ __('trans.delete') }}
                        </x-danger-button>
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
        <x-slot name="paginate">
            {{ $permissions->withQueryString()->links() }}
        </x-slot>
    </x-table>

</div>
