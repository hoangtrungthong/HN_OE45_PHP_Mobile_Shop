<x-guest-layout>
    <x-slot name="slot">
        <div class="container mx-auto mt-5 w-full max-w-lg text-black mt-40 my-40">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                action="{{ route('user.upload', ['user' => $user]) }}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-26"
                        for="image">{{ __('common.image') }}</label>
                    <input type="file"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="image" id="image" required />
                </div>
                <img id="preview" class="w-full">
                @error('image')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center justify-between mt-5">
                    <button type="submit"
                        class="gradient hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('common.update') }}</button>
                    <a class="gradient hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        href="{{ route('user.profile') }}">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
    </x-slot>
</x-guest-layout>
