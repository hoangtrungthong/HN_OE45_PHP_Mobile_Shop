<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('common.name')" />
                <x-input id="name" class="block mt-1 w-full text-black" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('common.email')" />
                <x-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone Address -->
            <div class="mt-4">
                <x-label for="phone" :value="__('common.phone')" />
                <x-input id="phone" class="block mt-1 w-full text-black" type="number" name="phone" :value="old('phone')" required />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-label for="address" :value="__('common.address')" />
                <x-input id="address" class="block mt-1 w-full text-black" type="text" name="address" :value="old('address')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('common.password')" />
                <x-input id="password" class="block mt-1 w-full text-black" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('common.confirm_password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full text-black" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('common.login') }}
                </a>
                <x-button class="ml-4">
                    {{ __('common.register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
