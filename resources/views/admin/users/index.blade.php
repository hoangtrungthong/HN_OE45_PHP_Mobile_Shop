<x-app-layout>
    <x-slot name="slot">
        <div class="mx-auto grid grid-cols-12 gap-6">
            @foreach ($users as $user)
                <div class="intro-y col-span-12 md:col-span-6">
                    <div class="box">
                        <div class="flex flex-col lg:flex-row items-center p-5">
                            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1 mb-4">
                                <img class="rounded-full"
                                    src="@if ($user->image)
                                            {{ Storage::url($user->image) }}
                                        @else
                                            {{ asset('images/avatar_default.png') }}
                                        @endif">
                                @if ($user->is_block === config('const.active'))
                                    <p class="text-green-800 font-black rounded-b-full text-center">
                                        {{ __('user.active') }}
                                    </p>
                                @else
                                    <p class="text-red-800 font-black rounded-b-full text-center">
                                        {{ __('user.block') }}
                                    </p>
                                @endif
                                </p>
                            </div>
                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                <p class="font-medium">
                                    {{ $user->name }}
                                </p>
                                <p class="text-gray-600 text-xs mt-0.5">
                                    {{ $user->phone }}
                                </p>
                            </div>
                            <div class="flex mt-4 lg:mt-0">
                                @if ($user->is_block === config('const.active'))
                                    <form action="{{ route('admin.blockUser', ['user' => $user]) }}" method="post">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-gray-200 rounded hover:bg-red-400 px-2 focus:outline-none">{{ __('user.block') }}</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.activeUser', ['user' => $user]) }}" method="post">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 text-gray-100 rounded hover:bg-green-400 px-2 focus:outline-none">{{ __('user.active') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-slot>
</x-app-layout>
