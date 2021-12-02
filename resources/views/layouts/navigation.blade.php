<nav x-data="{ open: false }" class="border-b border-gray-100">
    <div class="flex flex-col w-64 h-screen px-4 py-8 bg-indigo-600 border-r dark:bg-gray-800 dark:border-gray-600">
        <h2 class="uppercase text-center text-3xl font-semibold text-gray-200 dark:text-white">
            {{ Auth::user()->name }}
        </h2>
        <div class="relative mt-6">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
            <input type="text"
                class=" w-full py-3 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                placeholder="Search..." />
        </div>
        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav>
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.manageUser')"
                    :active="request()->routeIs('admin.manageUser')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs(['admin.categories.index','admin.categories.create','admin.categories.edit'])">
                    {{ __('Category') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs(['admin.products.index', 'admin.products.create', 'admin.products.edit', 'admin.products.details'])">
                    {{ __('Products') }}
                </x-responsive-nav-link>
                <hr class="my-6 dark:border-gray-600" />
            </nav>
            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-gray-300 hover:bg-gray-200 text-gray-600 text-center py-2 px-4 rounded"
                        type="submit" href="{{ route('logout') }}">
                        {{ __('Log Out') }} &raquo;
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
