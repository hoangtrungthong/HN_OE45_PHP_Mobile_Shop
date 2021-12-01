<x-app-layout>
    <x-slot name="slot">
        <div class="mt-10">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('admin.categories.update', $category->slug) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                                        <input type="text" name="name" value="{{ $category->name }}" id="name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    @error('name')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="country" class="block text-sm font-medium text-gray-700">{{ __('Current') }}</label>
                                        <select id="country" name="parent" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="0">{{ __('Parent') }}</option>
                                            @foreach ($categories as $category)
                                                @include('admin.category.category',[
                                                        'category' => $category,
                                                        'text' => '',
                                                    ])
                                            @endforeach
                                        </select>
                                    @error('parent')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    </div>
                                </div>
                                <div class="flex justify-between px-4 py-3 text-right sm:px-1">
                                    <a href="{{ route('admin.categories.index') }}" class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-arrow-circle-left"></i>
                                        {{ __('Back') }}
                                    </a>
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Save') }}
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
