<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <x-slot name='slot'>
        <div class="grid grid-cols-2">
            <div class="flex flex-col items-center text-center bg-white pt-7">
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" width="150">
                <div class="mt-3">
                    <h4>{{ $user->name }}</h4>
                </div>
            </div>
            <div class="col-md-8 bg-white pb-7">
                <div class="flex mt-7 gap-5">
                    <div class="w-36">
                        <h6>{{ __('Fullname') }}</h6>
                    </div>
                    <div class=" text-secondary">
                        {{ $user->name }}
                    </div>
                </div>
                <hr>
                <div class="flex mt-7 gap-5">
                    <div class="w-36">
                        <h6>{{ __('Email') }}</h6>
                    </div>
                    <div class=" text-secondary">
                        {{ $user->email }}
                    </div>
                </div>
                <hr>
                <div class="flex mt-7 gap-5">
                    <div class="w-36">
                        <h6>{{ __('Phone') }}</h6>
                    </div>
                    <div class=" text-secondary">
                        {{ $user->phone }}
                    </div>
                </div>
                <hr>
                <div class="flex mt-7 gap-5">
                    <div class="w-36">
                        <h6>{{ __('Address') }}</h6>
                    </div>
                    <div class=" text-secondary">
                        {{ $user->address }}
                    </div>
                </div>
                <hr>
                <div class="flex mt-7">
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded-full" href="">{{ __('Edit') }}</a>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
