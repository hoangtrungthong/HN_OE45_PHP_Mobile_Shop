<x-guest-layout>
    <x-slot name="slot">
        <div class="container mx-auto mt-5 w-full max-w-lg text-black mt-20">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                action="{{ route('user.update', ['user' => $user]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-36" for="name">{{ __('common.Name') }}</label>
                    <input type="text"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="name" id="name" value="{{ $user->name }}" required />
                </div>
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-36"
                        for="email">{{ __('common.email') }}</label>
                    <input type="text"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="email" id="email" value="{{ $user->email }}" required />
                </div>
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-36"
                        for="phone">{{ __('common.phone') }}</label>
                    <input type="text"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="phone" id="phone" value="{{ $user->phone }}" required />
                </div>
                @error('phone')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-36"
                        for="address">{{ __('common.address') }}</label>
                    <input type="text"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="address" id="address" value="{{ $user->address }}" required />
                </div>
                @error('address')
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
