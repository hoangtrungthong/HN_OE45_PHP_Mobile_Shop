<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update profile') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="container mx-auto mt-5 w-full max-w-lg">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                action="{{ route('user.update', ['user' => $user]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-36" for="name">{{ __('Name') }}</label>
                    <input type="text"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="name" id="name" value="{{ $user->name }}" required />
                </div>
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-36"
                        for="email">{{ __('Email') }}</label>
                    <input type="text"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="email" id="email" value="{{ $user->email }}" required />
                </div>
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-36"
                        for="phone">{{ __('Phone') }}</label>
                    <input type="text"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="phone" id="phone" value="{{ $user->phone }}" required />
                </div>
                @error('phone')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center border-b border-teal-500 py-2 gap-5">
                    <label class="block text-gray-700 text-sm font-bold mr-5 w-36"
                        for="address">{{ __('Address') }}</label>
                    <input type="text"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:ring-transparent"
                        name="address" id="address" value="{{ $user->address }}" required />
                </div>
                @error('address')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center justify-between mt-5">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('Update') }}</button>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        href="{{ route('user.profile') }}">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </x-slot>
</x-guest-layout>
