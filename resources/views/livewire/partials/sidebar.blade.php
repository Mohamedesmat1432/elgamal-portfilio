<div>
    <aside x-data="{ show: false }">
        <!-- Background -->
        <div x-show="show" class="fixed inset-0 transform transition-all z-40" x-on:click="show = false"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 opacity-75 z-40"></div>
        </div>

        <div class="fixed bg-gray-700 min-h-screen transition-all duration-300 flex flex-col text-md font-semibold z-50"
            :class="show ? 'w-80 p-5' : 'w-12'" x-on:click.outside="show = false" x-cloak>
            <!-- Toggle button -->
            <button x-on:click="show = !show"
                class="absolute ltr:-right-3 rtl:-left-3 top-20 mt-1.5 cursor-pointer rounded-full border-2 border-black bg-white p-1">
                <!-- SVG icon -->
                <svg :class="show ? 'rotate-270' : 'rotate-90'"
                    class="h-4 w-4 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <!-- Sidebar header -->
            <div class="inline-block py-2 mb-2">
                <h1 class=" text-black transition-opacity duration-300 font-bold text-2xl" x-show="show" x-cloak>
                    {{ auth()->user()->name ?? '' }}
                </h1>
                <p class="text-black transition-opacity duration-300 font-medium text-md" x-show=" show" x-cloak>
                    {{ auth()->user()->email ?? '' }}
                </p>
            </div>
            <!-- Sidebar menu -->
            <ul class="flex flex-col space-y-2 overflow-y-auto overflow-x-hidden scrollbar">
                @foreach ($this->sidebarLinks() as $link)
                    @can($link['permission'])
                        <li x-show="show || !show" class="group">
                            <x-sidebar-link :href="route($link['name'])" :active="request()->routeIs($link['name'])" wire:navigate>
                                <!-- Icon -->
                                <x-icon class="w-5 h-5" name="{{ $link['icon'] }}" />
                                <!-- Text -->
                                <span x-show="show" x-cloak>{{ $link['trans'] . ' ' . $link['count'] }}</span>

                            </x-sidebar-link>
                            <hr class="mt-2 border-t border-black" x-show="show" x-cloak />
                        </li>
                    @endcan
                @endforeach

                <li x-data="{ lang: false }" x-on:click="lang = !lang" x-show="show || !show" class="group">
                    <x-sidebar-link class="cursor-pointer">
                        <!-- Icon -->
                        <x-icon name="language" />
                        <!-- Text -->
                        <span x-show="show" x-cloak>{{ __('trans.lang') }}</span>

                    </x-sidebar-link>
                    <hr class="mt-2 border-t border-black" x-show="show" x-cloak />
                    <ul class="flex flex-col space-y-2 overflow-y-auto overflow-x-hidden scrollbar" x-show="lang">
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
                                    <span x-show="show" x-cloak>{{ $properties['native'] }}</span>

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
                    <span x-show="show" x-cloak>{{ __('trans.logout') }}</span>
                </x-sidebar-link>
            </div>

        </div>
    </aside>
</div>
