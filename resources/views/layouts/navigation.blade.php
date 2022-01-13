<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="flex flex-col w-64 h-screen px-4 py-8 bg-white border-r dark:bg-gray-800 dark:border-gray-600">
        <div class="uppercase position-absolute top-0 left-0 font-semibold text-gray-800 dark:text-white">
            <a class="hover:underline text-gray-600" href="{!! route('admin.lang', ['vi']) !!}">{{ __('vi') }} |</a>
            <a class="hover:underline text-gray-600" href="{!! route('admin.lang', ['en']) !!}">{{ __('en') }}</a>
        </div>
        <h2 class="uppercase text-center text-3xl font-semibold text-gray-800 dark:text-white">
            {{ Auth::user()->name }}
        </h2>
        <form action="{{ route('search') }}" method="get">
            <input type="text" name="key"
                class=" w-full py-3 pl-10 pr-4 text-white bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none"
                placeholder="{{ __('common.search') }}" />
            <button type="submit" class="relative -top-10">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>
                </span>
            </button>
        </form>
        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav>
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('common.dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link id="open_notify" class="cursor-pointer relative">
                        {{ __('common.notifications') }}
                    <p data-count="{{ $data['read'] && count($data['read']) > 0 ? count($data['read']) : 0 }}" id="count-notify" class="absolute bg-red-500 text-white px-2 rounded-full absolute top-1 text-bold">
                        <span class="notify-count">{{ $data['read'] && count($data['read']) > 0 ? count($data['read']) : '' }}</span>
                    </p>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.manageUser')"
                    :active="request()->routeIs('admin.manageUser')">
                    {{ __('common.users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.categories.index')"
                    :active="request()->routeIs(['admin.categories.index','admin.categories.create','admin.categories.edit'])">
                    {{ __('common.category') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.products.index')"
                    :active="request()->routeIs(['admin.products.index','admin.products.create','admin.products.edit'])">
                    {{ __('common.product') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.orders.index')"
                    :active="request()->routeIs('admin.orders.index')">
                    {{ __('common.order') }}
                </x-responsive-nav-link>
                <hr class="my-6 dark:border-gray-600" />
            </nav>
            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-gray-300 hover:bg-gray-200 text-gray-600 text-center py-2 px-4 rounded"
                        type="submit" href="{{ route('logout') }}">
                        {{ __('common.logout') }} &raquo;
                    </button>
                </form>
            </div>
        </div>
        <div id="notification"
            class="w-2/5 z-50 bg-gray-50 h-screen p-8 shadow-2xl fixed top-0 -left-full transition-all ease-in-out duration-700">
            <div class="tabs">
                <div class="flex items-center justify-between">
                    <p tabindex="0" class="focus:outline-none text-2xl font-semibold leading-6 text-gray-800">
                        {{ __('common.notifications') }}
                    </p>
                    <a href="{{ route('admin.notifications.index') }}" class="underline text-blue-500 italic">
                        {{ __('common.all_notify') }}
                    </a>
                    <button role="button" aria-label="close modal"
                        class="focus:outline-none text-red-500 text-2xl cursor-pointer"
                        id="close_notify">
                        <i class="fas fa-window-close"></i>
                    </button>
                </div>
                <div class="mt-5 flex items-center justify-center gap-5">
                    <div data-target="panel-1" class="active tab cursor-pointer opacity-70 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('common.all') }}
                    </div>
                    <div data-target="panel-2" class="tab cursor-pointer opacity-70 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('common.unread') }}
                    </div>
                    <a class="opacity-70 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('admin.markAllRead') }}">
                        {{ __('common.mark_read') }}
                    </a>
                </div>
            </div>
            <div id="panels" class="relative w-full h-full top-0 overflow-y-auto overflow-x-hidden pb-40">
                <div class="tab-content panel-1 list-notification active">
                    @forelse ($data['notifications'] as $notify)
                        <form action="{{ route('admin.notifications.update', $notify->id) }}" method="post" class="flex items-center justify-between {{ $notify->read_at == null ? 'bg-blue-50' : 'bg-white' }}  p-3 mt-8">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full rounded flex items-center">
                                <div tabindex="0" aria-label="heart icon" role="img"
                                    class="text-green-400 focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                    <i class="fas fa-donate"></i>
                                </div>
                                <div class="pl-3">
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none capitalize">
                                        {{ __('common.new_order') . $notify->data['content'] }}
                                    </p>
                                    <p tabindex="0" class="focus:outline-none float-left text-xs pt-1 text-gray-500">
                                        {{ $notify->created_at->diffForHumans($data['now']) }}
                                    </p>
                                </div>
                            </button>
                            @if ($notify->read_at == null)
                                <i class="fas fa-circle text-red-500" style="font-size: 6px"></i>
                            @endif
                        </form>
                    @empty
                        <div class="mt-20 text-center text-gray-500">
                            <p class="">{{ __('common.empty_notify') }}</p>
                            <i class="fas fa-bell-slash mt-5 text-6xl"></i>
                        </div>
                    @endforelse
                </div>
                <div class="tab-content panel-2 list-notification">
                    @forelse ($data['read'] as $notify)
                        <form action="{{ route('admin.notifications.update', $notify->id) }}" method="post" class="flex items-center justify-between {{ $notify->read_at == null ? 'bg-blue-50' : 'bg-white' }}  p-3 mt-8">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full rounded flex items-center">
                                <div tabindex="0" aria-label="heart icon" role="img"
                                    class="text-green-400 focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                    <i class="fas fa-donate"></i>
                                </div>
                                <div class="pl-3">
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none capitalize">
                                        {{ __('common.new_order') . $notify->data['content'] }}
                                    </p>
                                    <p tabindex="0" class="focus:outline-none float-left text-xs pt-1 text-gray-500">
                                        {{ $notify->created_at->diffForHumans($data['now']) }}
                                    </p>
                                </div>
                            </button>
                            <i class="fas fa-circle text-red-500" style="font-size: 6px"></i>
                        </form>
                    @empty
                        <div class="mt-20 text-center text-gray-500">
                            <p class="">{{ __('common.empty_notify') }}</p>
                            <i class="fas fa-bell-slash mt-5 text-6xl"></i>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</nav>
