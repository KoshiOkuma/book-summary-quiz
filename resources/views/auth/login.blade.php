<x-guest-layout>
    <x-auth-card>
        <div class="flex justify-between mb-2">
            <div></div>
            <div>
                <a href="{{route('admin.login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">管理者はこちら</a>
            </div>
        </div>

        <x-slot name="logo">
            <div class="inline-flex">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                <span class="ml-3 text-3xl self-center">BookOutput</span>
            </div>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" value="メールアドレス*" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Email" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="パスワード*" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="Password" />
            </div>

            <!-- Remember Me -->
            {{-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}

            <div class="flex items-center justify-between mt-4 mb-2">
                @if (Route::has('password.request'))
                    <a></a>
                    {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a> --}}
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                @endif

            </div>
            <div class="flex justify-between">
                <button>
                    <a href="{{route('guestLogin')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">ゲストログイン</a>
                </button>
                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
