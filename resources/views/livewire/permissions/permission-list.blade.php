<div class="flex flex-col overflow-x-auto">
    <div class="sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="table-fixed min-w-full text-center text-sm font-light text-surface dark:text-white">
                    <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th class="px-6 py-4">
                                #
                            </th>
                            <th class="px-6 py-4">
                                {{ __('trans.name') }}
                            </th>
                            <th class="px-6 py-4" colspan="2">
                                {{ __('trans.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr wire:key="permission-{{ $permission->id }}"
                                class="border-b border-neutral-200 dark:border-white/10">
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
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="px-6 py-4" colspan="3">
                                    {{ __('trans.empty_data') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
