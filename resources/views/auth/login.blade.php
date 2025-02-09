<x-guest-layout>
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-session-error class="mb-4" :error="session('error')" />
        <x-input-error :messages="$errors->get('social_login')" class="my-2" />
            
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-start mt-4 gap-2">
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
                <div class="flex items-center gap-2 align-bottom justify-end">
                    <p class="text-sm">Or login by:</p>
                    <x-social-links />
                </div>
            </div>
            <div class="flex items-center justify-start mt-4 gap-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('register') }}">
                        {{ __('Register new') }}
                    </a>
                @endif
            </div>
        </form>

    </div>

</x-guest-layout>
