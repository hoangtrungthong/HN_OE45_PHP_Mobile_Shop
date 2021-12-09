<footer class="bg-white">
    <div class="container mx-auto px-8">
        <div class="w-full flex flex-col md:flex-row py-6">
            <div class="flex-1 mb-6 text-black">
                <a class="text-pink-600 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="#">
                    <img class="h-8 fill-current inline" src="{{ asset('images/logo.png') }}" alt="">
                    {{ __('Mobile') }}
                </a>
            </div>
            <div class="flex-1">
                <p class="uppercase text-gray-500 md:mb-6">{{ __('Links') }}</p>
                <ul class="list-reset mb-6">
                    <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                        <a href="#"
                            class="no-underline hover:underline text-gray-800 hover:text-pink-500">{{ __('FAQ') }}</a>
                    </li>
                    <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                        <a href="#"
                            class="no-underline hover:underline text-gray-800 hover:text-pink-500">{{ __('Help') }}</a>
                    </li>
                    <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                        <a href="#"
                            class="no-underline hover:underline text-gray-800 hover:text-pink-500">{{ __('Support') }}</a>
                    </li>
                </ul>
            </div>
            <div class="flex-1">
                <p class="uppercase text-gray-500 md:mb-6">{{ __('Social') }}</p>
                <ul class="list-reset mb-6">
                    <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                        <a href="#"
                            class="no-underline hover:underline text-gray-800 hover:text-pink-500">{{ __('Facebook') }}</a>
                    </li>
                    <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                        <a href="#"
                            class="no-underline hover:underline text-gray-800 hover:text-pink-500">{{ __('Linkedin') }}</a>
                    </li>
                    <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                        <a href="#"
                            class="no-underline hover:underline text-gray-800 hover:text-pink-500">{{ __('Twitter') }}</a>
                    </li>
                </ul>
            </div>
            <div class="flex-1">
                <p class="uppercase text-gray-500 md:mb-6">{{ __('Company') }}</p>
                <ul class="list-reset mb-6">
                    <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                        <a href="#"
                            class="no-underline hover:underline text-gray-800 hover:text-pink-500">{{ __('Contact') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

