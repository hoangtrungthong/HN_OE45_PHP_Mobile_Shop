<nav x-data="{ open: false }" id="header" class="fixed w-full z-30 top-0 text-white border-b border-gray-100 border-opacity-25">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0">
        <div class="pl-4 flex items-center">
            <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                href="{{ route('home') }}">
                <img class="h-8 fill-current inline" src="{{ asset('images/logo.png') }}" alt="">
                {{ __('Mobile') }}
            </a>
        </div>
        <div class="block lg:hidden pr-4">
            <button id="nav-toggle"
                class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>{{ __('Menu') }}</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20"
            id="nav-content">
            <div class="list-reset lg:flex justify-end flex-1 items-center">
                <x-home-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('common.home') }}
                </x-home-nav-link>
                <x-home-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                    <i class="fas fa-shopping-cart"></i>
                    @if(session('cart'))
                        {{ count(session('cart')) }}
                    @endif
                </x-home-nav-link>
                @if (Route::has('login'))
                    @auth
                        <div
                            class="user relative cursor-pointer block mr-3 text-white font-bold inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-4 px-4">
                            Hi, {{ Auth::user()->name }}
                            <div class="sub-user absolute w-full top-full">
                                <a class="block pl-3 pr-4 py-4 text-base font-medium text-gray-200 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                                href="{{ route('user.profile') }}">{{ __('common.profile') }}</a>
                                <x-home-nav-link :href="route('user.historyOrder')" :active="request()->routeIs('user.historyOrder')">
                                    {{ __('common.purchase') }}
                                </x-home-nav-link>
                                <form
                                    class="block pl-3 pr-4 py-4 text-base font-medium text-gray-200 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                                    method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" href="{{ route('logout') }}">
                                        {{ __('common.logout') }} &raquo;
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <x-home-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('common.login') }}
                        </x-home-nav-link>
                        @if (Route::has('register'))
                            <x-home-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                {{ __('common.register') }}
                            </x-home-nav-link>
                        @endif
                    @endauth
                @endif
                <div class="uppercase position-absolute top-0 left-0 font-semibold text-gray-800 dark:text-white">
                    <a class="hover:underline text-gray-600" href="{!! route('user.lang', ['vi']) !!}">{{ __('vi') }} |</a>
                    <a class="hover:underline text-gray-600" href="{!! route('user.lang', ['en']) !!}">{{ __('en') }}</a>
                </div>
            </div>
        </div>
    </div>
</nav>
