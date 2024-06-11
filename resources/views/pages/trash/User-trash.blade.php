<x-app-layout>
    <x-slot name="title">
        {{ __('trans.trash_users') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('trans.trash_users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" text-gray-900">
                    <livewire:trash.users.user-trash-list />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
