<div>
    <x-modal name="update-user-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="update" class="p-6">
            @csrf
            <h2 class="text-2xl font-medium text-gray-900">
                <x-icon name="pencil-square" class="w-10 h-10 inline-block" />
                {{ __('trans.update') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('trans.name') }}" class="sr-only" />

                <x-text-input wire:model="form.name" id="updateUserName" name="name" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('trans.name') }}" autocomplete="user_name" />

                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="email" value="{{ __('trans.email') }}" class="sr-only" />

                <x-text-input wire:model="form.email" id="updateUserEmail" name="email" type="email"
                    class="mt-1 block w-full" placeholder="{{ __('trans.email') }}" autocomplete="off" />

                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="role" value="{{ __('trans.role') }}" class="sr-only" />

                <x-select wire:model="form.role" id="updateUserRole" name="role" multiple>
                    <option value="">{{ __('trans.choose') }}</option>
                    @forelse ($roles as $val)
                        <option value="{{ $val }}">{{ $val }}</option>
                    @empty
                        <option value="">{{ __('trans.empty_data') }}</option>
                    @endforelse
                </x-select>

                <x-input-error :messages="$errors->get('form.role')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="branch_id" value="{{ __('trans.branch') }}" class="sr-only" />

                <x-select wire:model="form.branch_id" id="updateUserBranch" name="branch_id">
                    <option value="">{{ __('trans.choose') }}</option>
                    @forelse ($branches as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @empty
                        <option value="">{{ __('trans.empty_data') }}</option>
                    @endforelse
                </x-select>

                <x-input-error :messages="$errors->get('form.branch_id')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-start">
                <x-primary-button>
                    {{ __('trans.update') }}
                </x-primary-button>

                <x-secondary-button class="ms-3" x-on:click="$dispatch('close')">
                    {{ __('trans.cancel') }}
                </x-secondary-button>
            </div>
        </form>
    </x-modal>
</div>
