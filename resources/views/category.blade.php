<x-guest-layout>
    <x-slot name="slot">
        <div class="bg-white pt-20">
            <div class="container mx-32">
                @if (count($category->childrenCategory) || count($category->products))
                    <div class="bg-white grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @if (count($category->childrenCategory))
                            @foreach ($category->childrenCategory as $child)
                                @foreach ($child->products as $product)
                                    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
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
                                                    {{ $product->productAttributes[0]->price . '$' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endif
                        @if (count($category->products))
                            @foreach ($category->products as $product)
                                <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
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
                                                {{ $product->productAttributes[0]->price . '$' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @else
                    <div class="bg-white flex justify-center items-center py-20 px-20 w-full mx-auto">
                        <img src="{{ asset('images/notFound.png') }}" alt="" srcset="">
                        <p class="text-black w-1/5">
                            {{ __('common.fail_search') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
</x-guest-layout>
