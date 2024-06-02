<div>
    <div x-cloak x-data="{ sidebarOpen: false }">
        <aside :class="sidebarOpen ? 'w-72' : 'w-12'"
            class="absolute bg-slate-200 h-screen p-5 transition-all duration-300 flex flex-col text-md font-semibold ">
            <!-- Toggle button -->
            <button @click="sidebarOpen = !sidebarOpen"
                class="absolute ltr:-right-3 rtl:-left-3 top-9 cursor-pointer rounded-full border-2 border-black bg-white p-1">
                <!-- SVG icon -->
                <svg :class="sidebarOpen ? 'rotate-270' : 'rotate-90'"
                    class="h-6 w-6 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24"
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
                    My Portiflio
                </p>
            </div>
            <!-- Sidebar menu -->
            <ul class="flex flex-col space-y-1 overflow-y-auto overflow-x-hidden scrollbar">
                <li x-show="sidebarOpen || !sidebarOpen" class="group">
                    <a href="#"
                        class="flex items-center space-x-2 py-2 px-4 rounded-md text-black hover:bg-sky-300 transition-colors duration-300">
                        <!-- Icon -->
                        <span>🏠</span>
                        <!-- Text -->
                        <span x-show="sidebarOpen" x-cloak>{{ __('trans.home') }}</span>
                    </a>
                    <hr class="border-t border-black" x-show="sidebarOpen" x-cloak />
                </li>
            </ul>
            <!-- Sidebar Footer -->
            <div class="mt-auto py-4 px-2 bg-mint-green-400 rounded-lg shadow-sm" x-show="sidebarOpen" x-cloak>
                <!-- User Profile -->
                <hr class=" mt-2 border-t border-black" x-show="sidebarOpen" x-cloak />
                <!-- Logout Button -->
                <button wire:click="logout"
                    class="mt-1 w-full bg-blue-600 text-black py-2 px-4 rounded hover:bg-sky-300 focus:outline-none focus:bg-sky-300 transition-colors duration-300">
                    {{ __('trans.logout') }}
                </button>
            </div>

        </aside>
    </div>
</div>
