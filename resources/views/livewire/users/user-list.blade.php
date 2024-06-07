<div>
    @can('user-create')
        <livewire:users.user-create />
    @endcan

    @can('user-update')
        <livewire:users.user-update />
    @endcan

    @can('user-delete')
        <livewire:users.user-delete />
    @endcan

    @can('user-bulk-delete')
        <livewire:users.user-bulk-delete />
    @endcan

    <div class="p-6 my-3 flex-1">
        <x-text-input type="search" wire:model.live.debounce.500ms="search" placeholder="{{ __('trans.search') }}..." />

        @can('user-create')
            <x-primary-button x-on:click.prevent="$dispatch('create-modal')">
                {{ __('trans.create') }}
            </x-primary-button>
        @else
            <x-primary-button class="cursor-not-allowed bg-gray-500">
                {{ __('trans.create') }}
            </x-primary-button>
        @endcan

        @can('user-bulk-delete')
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
                @can('user-bulk-delete')
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
                    <button wire:click="sortBy('email')" class="flex justify-center w-full">
                        {{ __('trans.email') }}
                        <x-sort-icon field="email" :sort_by="$sort_by" :sort_dir="$sort_dir" />
                    </button>
                </th>
                <th class="px-6 py-4">
                    {{ __('trans.action') }}
                </th>
            </tr>
        </x-slot>
        {{-- tbody --}}
        <x-slot name="tbody">
            @forelse ($this->users as $user)
                <tr wire:key="user-{{ $user->id }}" class="border-b border-neutral-200">
                    @can('user-bulk-delete')
                        <td class="px-6 py-4">
                            <x-text-input class="cursor-pointer" type="checkbox" wire:model.live="form.ids"
                                value="{{ $user->id }}" />
                        </td>
                    @endcan
                    <td class="px-6 py-4 font-medium">
                        {{ $user->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        @can('user-update')
                            <x-icon name="pencil-square" class="w-10 h-10 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('edit-modal', {id: '{{ $user->id }}'})" />
                        @else
                            <x-icon name="pencil-square" class="w-10 h-10 text-gray-500 inline-block cursor-not-allowed" />
                        @endcan

                        @can('user-delete')
                            <x-icon name="trash" class="w-10 h-10 text-red-600 inline-block cursor-pointer"
                                x-on:click.prevent="$dispatch('delete-modal', {id: '{{ $user->id }}', name: '{{ $user->name }}'})" />
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
        {{-- pagination --}}
    </x-table>
    <div class="p-6 min-w-full">
        {{ $this->users->withQueryString()->links() }}
    </div>

</div>
