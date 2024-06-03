<div>
    <aside x-data="{ sidebarOpen: false }"
        class="fixed bg-gray-700 min-h-screen transition-all duration-300 flex flex-col text-md font-semibold z-50"
        :class="sidebarOpen ? 'w-80 p-5' : 'w-12'" @click.outside="sidebarOpen = false" x-cloak>
        <!-- Toggle button -->
        <button @click="sidebarOpen = !sidebarOpen"
            class="absolute ltr:-right-3 rtl:-left-3 top-20 mt-1.5 cursor-pointer rounded-full border-2 border-black bg-white p-1">
            <!-- SVG icon -->
            <svg :class="sidebarOpen ? 'rotate-270' : 'rotate-90'"
                class="h-4 w-4 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <!-- Sidebar header -->
        <div class="inline-block py-2 mb-2">
            <h1 class=" text-black transition-opacity duration-300 font-bold text-2xl" x-show="sidebarOpen" x-cloak>
                Elgamal
            </h1>
            <p class="text-black transition-opacity duration-300 font-medium text-md" x-show=" sidebarOpen" x-cloak>
                {{ auth()->user()->email ?? '' }}
            </p>
        </div>
        <!-- Sidebar menu -->
        <ul class="flex flex-col space-y-2 overflow-y-auto overflow-x-hidden scrollbar">
            <li x-show="sidebarOpen || !sidebarOpen" class="group">
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                    <!-- Icon -->
                    <x-icon class="w-5 h-5" name="home" />
                    <!-- Text -->
                    <span x-show="sidebarOpen" x-cloak>{{ __('trans.dashboard') }}</span>

                </x-sidebar-link>
                <hr class="mt-2 border-t border-black" x-show="sidebarOpen" x-cloak />
            </li>
            <li x-show="sidebarOpen || !sidebarOpen" class="group">
                <x-sidebar-link :href="route('permissions')" :active="request()->routeIs('permissions')" wire:navigate>
                    <!-- Icon -->
                    <x-icon class="w-5 h-5" name="lock-open" />
                    <!-- Text -->
                    <span x-show="sidebarOpen" x-cloak>{{ __('trans.permissions') }}</span>

                </x-sidebar-link>
                <hr class="mt-2 border-t border-black" x-show="sidebarOpen" x-cloak />
            </li>
        </ul>
        <!-- Sidebar Footer -->
        <div class="mt-auto bg-mint-green-400 rounded-lg shadow-sm" x-show="sidebarOpen || !sidebarOpen" x-cloak>
            <!-- User Profile -->
            <hr class="mt-2 border-t border-black" x-show="sidebarOpen" x-cloak />
            <!-- Logout Button -->
            <x-sidebar-link href="#" wire:click="logout" class="my-3">
                <!-- Icon -->
                <x-icon name="arrow-left-start-on-rectangle" class="w-5 h-5 text-2xl" />
                <!-- Text -->
                <span x-show="sidebarOpen" x-cloak>{{ __('trans.logout') }}</span>
            </x-sidebar-link>
        </div>

    </aside>
</div>
