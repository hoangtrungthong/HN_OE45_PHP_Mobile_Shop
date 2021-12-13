<x-guest-layout>
    <x-slot name="slot">
        <div class="bg-white mt-10">
            <div class="pt-6">
                <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
                    @foreach ($images as $img)
                        <div class="aspect-w-4 aspect-h-5 sm:rounded-lg sm:overflow-hidden lg:aspect-w-3 lg:aspect-h-4">
                            <img src="{{ Storage::url($img->path) }}"
                                alt="Two each of gray, white, and black shirts laying flat."
                                class="w-full h-full object-center object-cover">
                        </div>
                    @endforeach
                </div>
                <div
                    class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
                    <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                            {{ $product->name }}
                        </h1>
                    </div>
                    <div class="mt-4 lg:mt-0 lg:row-span-3">
                        <h2 class="sr-only">Product information</h2>
                        @foreach ($attr as $item)
                            <p class="text-3xl text-gray-900">${{ number_format($item->price) }}</p>
                        @endforeach

                        <form action="{{ route('user.addCart', $product->slug) }}" method="post" class="mt-10">
                            @csrf
                            <div>
                                <h3 class="text-sm text-gray-900 font-medium">{{ 'Color' }}</h3>

                                <fieldset class="mt-4">
                                    <div class="flex items-center space-x-3">
                                        @foreach ($attr as $items)
                                            @foreach ($items->colors as $color)
                                                <label
                                                    class="-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-400">
                                                    <input type="radio"  name="color" value="{{ $color->id }}" class="absolute form-radio h-5 w-5">
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
                                    <h3 class="text-sm text-gray-900 font-medium">{{ 'Size' }}</h3>
                                </div>
                                <fieldset class="mt-4">
                                    <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                                        @foreach ($attr as $items)
                                            @foreach ($items->memories as $memory)
                                                <label for="memory{{ $memory->id }}" class="text-black">
                                                    {{ $memory->rom }}
                                                    <input type="radio" id="memory{{ $memory->id }}" name="memory" value="{{ $memory->id }}">
                                                </label>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>

                            <button type="submit"
                                class="mt-10 bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                    </div>

                    <div
                        class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <div>
                            <h3 class="sr-only">{{ 'Content' }}</h3>

                            <div class="space-y-6">
                                <p class="text-base text-gray-900">{{ $product->content }}</p>
                            </div>
                        </div>

                        <div class="mt-10">
                            <h3 class="text-sm font-medium text-gray-900">{{ 'Specifications' }}</h3>

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
    </x-slot>
</x-guest-layout>
