<x-guest-layout>
    <x-slot name="slot">
        <div class="pt-24">
            <div class="container px-3 mb-14 mx-auto flex flex-wrap flex-col md:flex-row items-center">
                <div class="carousel w-full relative overflow-hidden">
                    <div class="carousel-inner relative overflow-hidden w-full">
                        <!--Slide 1-->
                        <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true"
                            hidden="" checked="checked" />
                        <div class="carousel-item absolute opacity-0 inline h-96">
                            <img class="m-auto h-96 rounded-2xl"
                                src="{{ asset('images/banners/830-300-830x300-24.png') }}" alt="">
                        </div>
                        <label for="carousel-3"
                            class=" control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto flex justify-center content-center">
                            <i class="fas fa-angle-left mt-3"></i>
                        </label>
                        <label for="carousel-2"
                            class=" next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">
                            <i class="fas fa-angle-right mt-3"></i>
                        </label>

                        <!--Slide 2-->
                        <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true"
                            hidden="" />
                        <div class="carousel-item absolute opacity-0 inline h-96">
                            <img class="m-auto h-96 rounded-2xl"
                                src="{{ asset('images/banners/Aseri-830-300-830x300-2.png') }}" alt="">
                        </div>
                        <label for="carousel-1"
                            class=" control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">
                            <i class="fas fa-angle-left mt-3"></i>
                        </label>
                        <label for="carousel-3"
                            class=" next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointe  hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">
                            <i class="fas fa-angle-right mt-3"></i>
                        </label>

                        <!--Slide 3-->
                        <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true"
                            hidden="" />
                        <div class="carousel-item absolute opacity-0 inline h-96">
                            <img class="m-auto h-96 rounded-2xl"
                                src="{{ asset('images/banners/renno6-seri-830-300-830x300-3.png') }}" alt="">
                        </div>
                        <label for="carousel-2"
                            class=" control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">
                            <i class="fas fa-angle-left mt-3"></i>
                        </label>
                        <label for="carousel-1"
                            class=" next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">
                            <i class="fas fa-angle-right mt-3"></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="relative -mt-12 lg:-mt-24">
                <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <path
                                d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                                opacity="0.100000001"></path>
                            <path
                                d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                                opacity="0.100000001"></path>
                            <path
                                d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                                id="Path-4" opacity="0.200000003"></path>
                        </g>
                        <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <path
                                d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z">
                            </path>
                        </g>
                    </g>
                </svg>
            </div>

            <section class="bg-white border-b">
                <div class="suggest container mx-auto px-16 phone relative">
                    <div class="container mx-auto pt-4 ">
                        <h1 class="text-3xl pl-4 w-1/4 rounded-tr-3xl font-bold leading-tight text-gray-800 gradient">
                            {{ __('common.suggest') }}
                        </h1>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper swiper-container border-2 border-pink-500 ">
                        <div class="swiper-wrapper phone_menu">
                            @foreach ($products as $product)
                                <div class="swiper-slide">
                                    <div>
                                        <a href="{{ route('showProduct', $product->slug) }}">
                                            <img class="max-w-full h-52"
                                                src="{{ Storage::url($product->productImages[0]->path) }}" alt="">
                                        </a>
                                        <a href="" class="mt-3">{{ $product->name }}</a>
                                    </div>
                                    <div class="price mt-3">
                                        <p>{{ number_format($product->productAttributes[0]->price) }}$</p>
                                    </div>
                                    <div>
                                        <span class="sale">{{ config('const.five_stars') }}%</span>
                                        <div class="ico">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-white">
                <div class="px-16 ">
                    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                        <div class="container mx-auto pt-4 border-b-2 border-pink-500">
                            <h2
                                class="text-4xl pl-4 w-1/4 rounded-tr-3xl font-bold leading-tight text-gray-800 gradient">
                                {{ __('common.product') }}</h2>
                        </div>
                        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                            @foreach ($products as $product)
                                <div class="group relative">
                                    <div
                                        class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                        <img src="{{ Storage::url($product->productImages[0]->path) }}" alt="image"
                                            class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                                    </div>
                                    <div class="mt-4 flex justify-between">
                                        <div>
                                            <h3 class="text-sm text-gray-700">
                                                <a href="{{ route('showProduct', $product->slug) }}">
                                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                                    {{ $product->name }}
                                                </a>
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-500"></p>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ number_format($product->productAttributes[0]->price) }}$</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-white pt-3">
                <div class="news container mx-auto px-16 suggest text-black">
                    <div class="border-b-2 border-pink-500">
                        <h2 class="text-3xl pl-4 w-1/4 rounded-tr-3xl font-bold leading-tight text-gray-800 gradient"></h2>
                    </div>
                    <div class="grid grid-cols-4">
                        <div class="col-spans-3">
                            <div>
                                <a href=""><img src="" alt=""></a>
                                <a href=""></a>
                            </div>
                            <p></p>
                            <span></span>
                        </div>
                        <div class="col-spans-3">
                            <div>
                                <a href=""><img src="" alt=""></a>
                                <a href=""></a>
                            </div>
                            <p></p>
                            <span></span>
                        </div>
                        <div class="col-spans-3">
                            <div>
                                <a href=""><img src="" alt=""></a>
                                <a href=""></a>
                            </div>
                            <p></p>
                            <span></span>
                        </div>
                        <div class="col-spans-3">
                            <div>
                                <a href=""><img src="" alt=""></a>
                                <a href=""></a>
                            </div>
                            <p></p>
                            <span></span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-gray-100 py-8">
                <div class="container mx-auto px-2 pt-4 pb-12 text-gray-800">
                    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">

                    </h1>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4">
                        <div
                            class="flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4">
                            <div class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow">
                                <div class="p-8 text-3xl font-bold text-center border-b-4">

                                </div>
                                <ul class="w-full text-center text-sm">
                                    <li class="border-b py-4"></li>
                                    <li class="border-b py-4"></li>
                                    <li class="border-b py-4"></li>
                                </ul>
                            </div>
                            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                                <div class="w-full pt-6 text-3xl text-gray-600 font-bold text-center">

                                    <span class="text-base"></span>
                                </div>
                                <div class="flex items-center justify-center">
                                    <button
                                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">

                                    </button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-col w-5/6 lg:w-1/3 mx-auto lg:mx-0 rounded-lg bg-white mt-4 sm:-mt-6 shadow-lg z-10">
                            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                                <div class="w-full p-8 text-3xl font-bold text-center"></div>
                                <div class="h-1 w-full gradient my-0 py-0 rounded-t"></div>
                                <ul class="w-full text-center text-base font-bold">
                                    <li class="border-b py-4"></li>
                                    <li class="border-b py-4"></li>
                                    <li class="border-b py-4"></li>
                                    <li class="border-b py-4"></li>
                                </ul>
                            </div>
                            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                                <div class="w-full pt-6 text-4xl font-bold text-center">

                                    <span class="text-base"></span>
                                </div>
                                <div class="flex items-center justify-center">
                                    <button
                                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">

                                    </button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4">
                            <div class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow">
                                <div class="p-8 text-3xl font-bold text-center border-b-4">
                                    
                                </div>
                                <ul class="w-full text-center text-sm">
                                    <li class="border-b py-4"></li>
                                    <li class="border-b py-4"></li>
                                    <li class="border-b py-4"></li>
                                </ul>
                            </div>
                            <div
                                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                                <div class="w-full pt-6 text-3xl text-gray-600 font-bold text-center">
                                    
                                    <span class="text-base"></span>
                                </div>
                                <div class="flex items-center justify-center">
                                    <button
                                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                        
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Change the colour #f8fafc to match the previous section colour -->
            <svg class="wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                        <g class="wave" fill="#f8fafc">
                            <path
                                d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z">
                            </path>
                        </g>
                        <g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
                            <g
                                transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
                                <path
                                    d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                                    opacity="0.100000001"></path>
                                <path
                                    d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                                    opacity="0.100000001"></path>
                                <path
                                    d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                                    opacity="0.200000003"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <section class="container mx-auto text-center py-6 mb-12">
                <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">
                </h1>
                <div class="w-full mb-4">
                    <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
                </div>
                <h3 class="my-4 text-3xl leading-tight">
                </h3>
                <button
                    class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                </button>
            </section>
            <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
            <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
            <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <script>
                var swiper =
                    new Swiper(
                        '.swiper-container', {
                            slidesPerView: '1',
                            spaceBetween: 0,
                            autoplay: false,
                            slidesPerView: 'auto',
                            grabCursor: true,
                            grabbingCursor: true,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        }
                    );

                function reinitSwiper(swiper) {
                    setTimeout(function() {
                        swiper.update();
                    }, 500);
                }
            </script>
    </x-slot>
</x-guest-layout>
