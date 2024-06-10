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

    <div class="p-6 my-2">
        <x-text-input type="search" wire:model.live.debounce.500ms="search" id="userSearch" name="search"
            placeholder="{{ __('trans.search') }}..." />

        <div class="mt-2">
            @can('user-create')
                <x-primary-button x-on:click.prevent="$dispatch('create-modal')">
                    <x-icon name="plus" class="w-4 h-4 text-white inline-block" />
                    {{ __('trans.create') }}
                </x-primary-button>
            @else
                <x-primary-button class="cursor-not-allowed bg-gray-500">
                    <x-icon name="plus" class="w-4 h-4 text-white inline-block" />
                    {{ __('trans.create') }}
                </x-primary-button>
            @endcan

            @can('user-bulk-delete')
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
                @can('user-bulk-delete')
                    <th class="px-6 py-4">
                        <x-text-input class="cursor-pointer" type="checkbox" wire:model="form.select_all"
                            wire:click="selectAll" id="userSelectAll" name="select_all" />
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
            @forelse ($this->users() as $user)
                <tr wire:key="user-{{ $user->id }}" class="border-b border-neutral-200">
                    @can('user-bulk-delete')
                        <td class="px-6 py-4">
                            <x-text-input class="cursor-pointer" type="checkbox" wire:model.live="form.ids"
                                value="{{ $user->id }}" id="userIds" name="ids" />
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
    </x-table>

    {{-- pagination --}}
    <div class="p-6 min-w-full">
        {{ $this->users()->withQueryString()->links() }}
    </div>
</div>
