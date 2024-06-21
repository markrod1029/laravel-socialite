<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <div class="text-center my-4">
        <hr class="my-2">
        <span class="text-center font-bold"> Or</span>
        <div class="w-3/5 mx-auto mt-4">
            <a href="{{ route('google-auth')}}" class="focus:ring-2 focus:ring-red-800 focus:ring-offset-4 bg-gray-200 flex items-center justify-center px-4 py-2 rounded-md">

                <svg viewBox="0 0 48 48">
                    <title>Google Logo</title>
                    <clipPath id="g">
                      <path d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/>
                    </clipPath>
                    <g class="colors" clip-path="url(#g)">
                      <path fill="#FBBC05" d="M0 37V11l17 13z"/>
                      <path fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/>
                      <path fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/>
                      <path fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/>
                    </g>
                  </svg>

                <span> Continue with Google</span>
            </a>
        </div>
    </div>
</x-guest-layout>


<style>
    svg {
  max-height: 35vh;
  max-width: 2vw;
}
</style>
