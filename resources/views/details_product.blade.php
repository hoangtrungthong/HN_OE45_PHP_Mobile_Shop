<x-guest-layout>
    <x-slot name="slot">
        <div class="bg-white mt-10">
            <div class="pt-6">
                <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
                    @foreach ($product->productImages as $img)
                        <div class="aspect-w-4 aspect-h-5 sm:rounded-lg sm:overflow-hidden lg:aspect-w-3 lg:aspect-h-4">
                            <img src="{{ Storage::url($img->path) }}"
                                alt="Two each of gray, white, and black shirts laying flat."
                                class="w-full h-full object-center object-cover">
                        </div>
                    @endforeach
                </div>
                <div class="lg:col-span-2 w-1/4 p-5 ml-28 mt-10 shadow overflow-hidden sm:rounded-md">
                    @if (count($product->ratings))
                        <div>
                            <div>
                                <p class="text-yellow-600">{{ count($product->ratings) . ' ' . __('common.ratings') }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-yellow-500" for="star5">
                                    5 <i class="fas fa-star"></i>
                                </p>
                                <div class="w-3/5 bg-gray-200 h-1">
                                    <div class="bg-yellow-500 h-1"
                                        style="width: {{ floor($star5 / count($product->ratings)) }}%">
                                        {{ floor($star5 / count($product->ratings)) }}%</div>
                                </div>
                                <div>
                                    <p class="text-indigo-400">{{ floor($star5 / count($product->ratings)) }}%</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-yellow-500" for="star5">
                                    4 <i class="fas fa-star"></i>
                                </p>
                                <div class="w-3/5 bg-gray-200 h-1">
                                    <div class="bg-yellow-500 h-1"
                                        style="width: {{ floor($star4 / count($product->ratings)) }}%">
                                        {{ floor($star4 / count($product->ratings)) }}%</div>
                                </div>
                                <div>
                                    <p class="text-indigo-400">{{ floor($star4 / count($product->ratings)) }}%</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-yellow-500" for="star5">
                                    3 <i class="fas fa-star"></i>
                                </p>
                                <div class="w-3/5 bg-gray-200 h-1">
                                    <div class="bg-yellow-500 h-1"
                                        style="width: {{ floor($star3 / count($product->ratings)) }}%">
                                        {{ floor($star3 / count($product->ratings)) }}%</div>
                                </div>
                                <div>
                                    <p class="text-indigo-400">{{ floor($star3 / count($product->ratings)) }}%</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-yellow-500" for="star5">
                                    2 <i class="fas fa-star"></i>
                                </p>
                                <div class="w-3/5 bg-gray-200 h-1">
                                    <div class="bg-yellow-500 h-1"
                                        style="width: {{ floor($star2 / count($product->ratings)) }}%">
                                        {{ floor($star2 / count($product->ratings)) }}%</div>
                                </div>
                                <div>
                                    <p class="text-indigo-400">{{ floor($star2 / count($product->ratings)) }}%</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-yellow-500" for="star5">
                                    1 <i class="fas fa-star"></i>
                                </p>
                                <div class="w-3/5 bg-gray-200 h-1">
                                    <div class="bg-yellow-500 h-1"
                                        style="width: {{ floor($star1 / count($product->ratings)) }}%">
                                        {{ floor($star1 / count($product->ratings)) }}%</div>
                                </div>
                                <div>
                                    <p class="text-indigo-400">{{ floor($star1 / count($product->ratings)) }}%</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-600 capitalize">{{ __('common.not_ratings') }}</p>
                    @endif
                </div>
                <div
                    class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
                    <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                            {{ $product->name }}
                        </h1>
                    </div>
                    <div class="mt-4 lg:mt-0 lg:row-span-3">
                        <h2 class="sr-only">Product information</h2>
                        @php
                            $price = array_unique($product->productAttributes->pluck('price')->toArray());
                        @endphp
                        @foreach ($price as $p)
                            <p class="text-3xl text-gray-900">${{ number_format($p) }}</p>
                        @endforeach

                        <form action="{{ route('user.addCart', $product->slug) }}" method="post"
                            class="mt-10">
                            @csrf
                            <div>
                                <h3 class="text-sm text-gray-900 font-medium">{{ __('common.color') }}</h3>
                                <fieldset class="mt-4">
                                    <div class="flex items-center space-x-3">
                                        @foreach ($product->productAttributes as $items)
                                            @foreach ($items->colors as $color)
                                                <label
                                                    class="-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-400">
                                                    <input type="radio" name="color" value="{{ $color->id }}"
                                                        class="absolute form-radio h-5 w-5">
                                                    <p id="color-0-label" class="sr-only">
                                                        {{ $color->name }}
                                                    </p>
                                                    <span aria-hidden="true"
                                                        class="h-8 w-8 border border-black border-opacity-10 rounded-full"
                                                        style="background: {{ $color->name }}">
                                                    </span>
                                                </label>
                                            @endforeach
                                        @endforeach
                                </fieldset>
                            </div>
                            <div class="mt-10">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm text-gray-900 font-medium">{{ __('common.memory') }}</h3>
                                </div>
                                <fieldset class="mt-4">
                                    <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                                        @foreach ($product->productAttributes as $items)
                                            @foreach ($items->memories as $memory)
                                                <label id="memory_id" for="mem{{ $memory->id }}"
                                                    class="text-black">
                                                    <p id="mem{{ $memory->id }}">
                                                        {{ $memory->rom }}
                                                        <input type="radio" id="memory{{ $memory->id }}"
                                                            name="memory" value="{{ $memory->id }}">
                                                    </p>
                                                </label>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>
                            <button type="submit"
                                class="gradient mt-10 bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                    </div>
                    <div
                        class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <div>
                            <h3 class="sr-only">{{ __('common.content') }}</h3>

                            <div class="space-y-6">
                                <p class="text-base text-gray-900">{{ $product->content }}</p>
                            </div>
                        </div>

                        <div class="mt-10">
                            <h3 class="text-sm font-medium text-gray-900">{{ __('common.specifications') }}</h3>

                            <div class="mt-4">
                                <p class="text-gray-400">
                                    <span class="text-gray-600">{{ $product->specifications }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white">
            <div class="">
                <div class="pl-20 md:mt-0 md:col-span-2 w-2/3">
                    <form action="{{ route('user.comments.store') }}" method="POST">
                        @csrf
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <div class="flex text-sm font-medium text-gray-700">
                                            <h3>{{ __('common.ratings') }}</h3>
                                            <div class="rating">
                                                <input type="radio" id="star5" name="vote" value="5" />
                                                <label class="relative" for="star5">
                                                    <i class="fas fa-star"></i>
                                                </label>
                                                <input type="radio" id="star4" name="vote" value="4" />
                                                <label for="star4">
                                                    <i class="fas fa-star"></i>
                                                </label>
                                                <input type="radio" id="star3" name="vote" value="3" />
                                                <label for="star3">
                                                    <i class="fas fa-star"></i>
                                                </label>
                                                <input type="radio" id="star2" name="vote" value="2" />
                                                <label for="star2">
                                                    <i class="fas fa-star"></i>
                                                </label>
                                                <input type="radio" id="star1" name="vote" value="1" />
                                                <label for="star1">
                                                    <i class="fas fa-star"></i>
                                                </label>
                                            </div>
                                        </div>
                                        @error('vote')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="content"
                                            class="block text-sm font-medium text-gray-700">{{ __('common.content') }}</label>
                                        <textarea cols="30" rows="5" name="content" id="content"
                                            class="resize-none mt-1 text-black block w-full shadow-sm border-gray-300 rounded-md"></textarea>
                                        @error('content')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </div>

                                <div class="px-4 py-3 text-right sm:px-1">
                                    <button type="submit"
                                        class="gradient inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('common.comment') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-white text-gray-500 py-10">
            <div class="pl-20">
                @foreach ($product->comments as $comment)
                    <div class="mt-10">
                        <div class="flex items-center gap-1">
                            <img class="h-10 w-10"
                                src="{{ $comment->user->image ? Storage::url($comment->user->image) : asset('images/avatar_default.png') }}"
                                alt="" srcset="">
                            <p>{{ $comment->user->name }}</p>
                        </div>
                        <div class="pl-10 mt-2 text-black">{{ $comment->content }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <script>
            {!! $product->productAttributes !!}.forEach(el => {
                el.memories.forEach(element => {
                    $(document).ready(function() {
                        $("#memory_id").attr('for', function(index, value) {
                            console.log(this, $("#mem" + element.id), value, 'memory' + element
                                .id, element);
                            if (value == 'mem' + element.id) {
                                $("#mem" + element.id).remove();

                                return $("#memory_id").attr('style', 'display: none');
                            }

                            return value = 'mem' + element.id
                        });
                    });
                });
            });
        </script>
        @if (session()->has('alert'))
            <script type="text/javascript">
                alert('{{ session()->get('alert') }}')
            </script>
        @endif
    </x-slot>
</x-guest-layout>
