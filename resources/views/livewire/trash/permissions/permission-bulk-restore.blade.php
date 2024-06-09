<div>
    <x-modal name="bulk-restore-permission-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="bulkRestore" class="p-6">
            @csrf
            <h2 class="text-2xl font-medium text-gray-900">
                <x-icon name="arrow-uturn-left" class="w-10 h-10 inline-block" />
                {{ __('trans.restore') }}
            </h2>

            <div class="my-6">
                <b>{{ __('trans.are_you_sure_to_want_restore') . json_encode($this->form->ids) }}</b>
            </div>

            <div class="mt-6 flex justify-start">
                <x-primary-button>
                    {{ __('trans.restore') }}
                </x-primary-button>

                <x-secondary-button class="ms-3" x-on:click="$dispatch('close')">
                    {{ __('trans.cancel') }}
                </x-secondary-button>
            </div>
        </form>
    </x-modal>
</div>
