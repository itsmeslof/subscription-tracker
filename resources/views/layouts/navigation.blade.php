<nav x-data="{ open: false }" class="bg-white border-b border-slate-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between py-4">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:flex">
                    <x-nav-link :href="route('subscriptions.index')" :active="request()->routeIs('subscriptions.index')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.settings')" :active="request()->routeIs('user.settings')">
                        Account Settings
                    </x-nav-link>
                    @if(auth()->user()->is_admin)
                    <x-admin-nav-link :href="route('admin.site_settings')" :active="request()->routeIs('admin.site_settings')" class="group">
                        Site Settings
                    </x-admin-nav-link>
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="hidden sm:flex">
                @csrf

                <button class="rounded-full inline-flex items-center px-5 py-2 text-sm font-medium leading-5 bg-white text-slate-500 border border-slate-300 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:border-slate-600 hover:text-white focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-600 transition ease-in-out duration-150">
                    Logout
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ml-2">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 10C2 9.80109 2.07902 9.61032 2.21967 9.46967C2.36032 9.32902 2.55109 9.25 2.75 9.25H15.34L13.24 7.3C13.1678 7.23302 13.1094 7.15248 13.0683 7.06296C13.0272 6.97345 13.0042 6.87671 13.0005 6.77828C12.9968 6.67985 13.0125 6.58165 13.0467 6.4893C13.0809 6.39694 13.133 6.31222 13.2 6.24C13.3353 6.09413 13.5229 6.00797 13.7217 6.00046C13.8201 5.99675 13.9183 6.01246 14.0107 6.0467C14.1031 6.08093 14.1878 6.13302 14.26 6.2L17.76 9.45C17.8357 9.52021 17.8961 9.6053 17.9375 9.69994C17.9788 9.79458 18.0001 9.89673 18.0001 10C18.0001 10.1033 17.9788 10.2054 17.9375 10.3001C17.8961 10.3947 17.8357 10.4798 17.76 10.55L14.26 13.8C14.1141 13.9353 13.9205 14.007 13.7217 13.9995C13.5229 13.992 13.3353 13.9059 13.2 13.76C13.0647 13.6141 12.993 13.4205 13.0005 13.2217C13.008 13.0229 13.0941 12.8353 13.24 12.7L15.34 10.75H2.75C2.55109 10.75 2.36032 10.671 2.21967 10.5303C2.07902 10.3897 2 10.1989 2 10Z" />
                    </svg>
                </button>
            </form>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('subscriptions.index')" :active="request()->routeIs('subscriptions.index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
