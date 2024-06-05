<div>
    <x-modal name="bulk-delete-permission-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="bulkDelete" class="p-6">
            
            <h2 class="text-2xl font-medium text-gray-900">
                <x-icon name="exclamation-triangle" class="w-10 h-10 text-red-600 inline-block" />
                {{ __('trans.delete_all') }}
            </h2>

            <div class="my-6">
                <b>{{ __('trans.are_you_sure_to_want_delete') . json_encode($this->form->ids) }}</b>
            </div>

            <div class="mt-6 flex justify-start">
                <x-danger-button>
                    {{ __('trans.delete_all') }}
                </x-danger-button>

                <x-secondary-button class="ms-3" x-on:click="$dispatch('close')">
                    {{ __('trans.cancel') }}
                </x-secondary-button>
            </div>
        </form>
    </x-modal>
</div>
