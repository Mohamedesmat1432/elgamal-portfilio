<div>
    <x-table>
        {{-- tsearch --}}
        <x-slot name="search">
            <x-text-input type="search" wire:model.live.debounce.500ms="search"
                placeholder="{{ __('trans.search') }}..." />
        </x-slot>
        {{-- thead --}}
        <x-slot name="thead">
            <tr>
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
                    <td class="px-6 py-4 font-medium">
                        {{ $permission->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $permission->name }}
                    </td>
                    <td class="px-6 py-4">
                        edit
                    </td>
                    <td class="px-6 py-4">
                        delete
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
