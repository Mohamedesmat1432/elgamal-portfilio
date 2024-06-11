<div>
    <aside x-data="{ show: false }">
        <!-- Background Light -->
        <div x-show="show" class="fixed inset-0 transform transition-all z-40" x-on:click="show = false"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-400 opacity-75 z-40"></div>
        </div>

        <div class="fixed bg-gray-900 min-h-screen transition-all duration-300 flex flex-col text-md font-semibold z-50"
            :class="show ? 'w-80 p-5' : 'w-12'" x-on:click.outside="show = false" x-cloak>
            <!-- Toggle button -->
            <button x-on:click="show = !show"
                class="absolute ltr:-right-10 rtl:-left-10 top-32 mt-3 cursor-pointer shadow-lg border-1 border-black bg-gray-200 p-1">
                <x-icon name="cog-6-tooth"
                    class="h-8 w-8 transform transition-transform duration-300 animate-spin fill-gray-300" />
                <!-- SVG icon -->
                {{-- <svg :class="show ? 'rotate-270' : 'rotate-90'"
                    class="h-4 w-4 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg> --}}
            </button>
            <!-- Sidebar header -->
            <div class="inline-block py-2 mb-2">
                <h1 class="text-white transition-opacity duration-300 font-bold text-2xl" x-show="show" x-cloak>
                    {{ auth()->user()->name ?? '' }}
                </h1>
                <p class="text-white transition-opacity duration-300 font-medium text-md" x-show=" show" x-cloak>
                    {{ auth()->user()->email ?? '' }}
                </p>
            </div>

            <hr class="my-2 border-t border-black" x-show="show" x-cloak />

            <div class="my-5" x-show="!show"></div>

            <!-- Sidebar menu -->
            <ul class="flex flex-col space-y-2 overflow-y-auto overflow-x-hidden scrollbar">
                {{-- sidebar links --}}
                @foreach ($this->sidebarLinks() as $link)
                    @can($link['permission'])
                        <li x-show="show || !show" class="group">
                            <x-sidebar-link :href="route($link['name'])" :active="request()->routeIs($link['name'])" wire:navigate>
                                <!-- Icon -->
                                <x-icon class="w-5 h-5" name="{{ $link['icon'] }}" />
                                <!-- Text -->
                                <span x-show="show" x-cloak>
                                    {{ $link['trans'] . ' ' . $link['count'] }}
                                </span>
                            </x-sidebar-link>

                            <hr class="mt-2 border-t border-black" x-show="show" x-cloak />
                        </li>
                    @endcan
                @endforeach

                {{-- sidebar trash links --}}
                <li x-data="{ showTrash: false }" x-on:click="showTrash = !showTrash" x-show="show || !show" class="group">
                    <x-sidebar-link class="cursor-pointer mb-2">
                        <!-- Icon -->
                        <x-icon name="trash" />
                        <!-- Text -->
                        <span x-show="show" x-cloak class="flex">
                            {{ __('trans.trash_list') }}
                            <x-icon class="w-4 h-4 m-1" name="chevron-down" x-show="!showTrash" />
                            <x-icon class="w-4 h-4 m-1" name="chevron-up" x-show="showTrash" />
                        </span>
                    </x-sidebar-link>

                    <hr class="my-2 border-t border-black" x-show="show" x-cloak />

                    <ul class="flex flex-col space-y-2 overflow-y-auto overflow-x-hidden scrollbar" x-show="showTrash">
                        @foreach ($this->sidebarTrashLinks() as $link)
                            @can($link['permission'])
                                <li x-show="show || !show" class="group">
                                    <x-sidebar-link :href="route($link['name'])" :active="request()->routeIs($link['name'])" wire:navigate>
                                        <!-- Icon -->
                                        <x-icon class="w-5 h-5" name="{{ $link['icon'] }}" />
                                        <!-- Text -->
                                        <span x-show="show" x-cloak>
                                            {{ $link['trans'] . ' ' . $link['count'] }}
                                        </span>
                                    </x-sidebar-link>

                                    <hr class="mt-2 border-t border-black" x-show="show" x-cloak />
                                </li>
                            @endcan
                        @endforeach
                    </ul>
                </li>

                {{-- language links --}}
                <li x-data="{ showLang: false }" x-on:click="showLang = !showLang" x-show="show || !show" class="group">
                    <x-sidebar-link class="cursor-pointer mb-2">
                        <!-- Icon -->
                        <x-icon name="language" />
                        <!-- Text -->
                        <span x-show="show" x-cloak class="flex">
                            {{ __('trans.lang') }}
                            <x-icon class="w-4 h-4 m-1" name="chevron-down" x-show="!showLang" />
                            <x-icon class="w-4 h-4 m-1" name="chevron-up" x-show="showLang" />
                        </span>
                    </x-sidebar-link>

                    <hr class="my-2 border-t border-black" x-show="show" x-cloak />

                    <ul class="flex flex-col space-y-2 overflow-y-auto overflow-x-hidden scrollbar" x-show="showLang">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li x-show="show || !show" class="group">
                                <x-sidebar-link :href="LaravelLocalization::getLocalizedURL($localeCode, null, [], true)" :active="$localeCode === LaravelLocalization::getCurrentLocale()">
                                    <!-- Icon -->
                                    @if ($localeCode == 'ar')
                                        <x-icon-ar />
                                    @else
                                        <x-icon-en />
                                    @endif
                                    <!-- Text -->
                                    <span x-show="show" x-cloak>
                                        {{ $properties['native'] }}
                                    </span>
                                </x-sidebar-link>

                                <hr class="mt-2 border-t border-black" x-show="show" x-cloak />
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Footer -->
            <div class="mt-auto bg-mint-green-400 rounded-lg shadow-sm" x-show="show || !show" x-cloak>
                <!-- User Profile -->
                <hr class="mt-2 border-t border-black" x-show="show" x-cloak />
                <!-- Logout Button -->
                <x-sidebar-link href="#" wire:click="logout" class="my-3">
                    <!-- Icon -->
                    <x-icon name="arrow-left-start-on-rectangle" class="w-5 h-5 text-2xl" />
                    <!-- Text -->
                    <span x-show="show" x-cloak>
                        {{ __('trans.logout') }}
                    </span>
                </x-sidebar-link>
            </div>

        </div>
    </aside>
</div>
