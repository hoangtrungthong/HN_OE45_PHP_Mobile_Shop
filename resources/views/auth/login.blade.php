<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('common.email')" />

                <x-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('common.password')" />

                <x-input id="password" class="block mt-1 w-full text-black" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ route('register') }}">
                    {{ __('common.register') }}
                </a>

                <x-button class="ml-3">
                    {{ __('common.login') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
