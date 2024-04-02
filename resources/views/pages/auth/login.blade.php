@section('title')
    {{ __('Login') }}
@endsection

<x-auth-layout>
    <form action="{{ route('auth.doLogin') }}" method="POST"
        class="bg-black/85 relative flex w-96 flex-col items-center justify-center overflow-hidden rounded-md border border-gray-900 px-7 py-5 shadow-2xl">
        @csrf

        {{-- Logo --}}
        <img src="{{ asset('images/filerial.png') }}" alt="logo" class="mb-8 w-24">

        {{-- Input --}}
        <div class="flex w-full flex-col items-end">
            <x-floating-input type="text" label="Email Address" name="email" />
            <x-floating-input type="password" label="Password" name="password" />
        </div>

        {{-- Remember me & Forgot Password --}}
        <div class="-mt-3 mb-8 flex w-full flex-row items-center justify-between">
            {{-- Remember Me --}}
            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember"
                    class="h-4 w-4 rounded border-gray-600 bg-gray-700 ring-offset-gray-800 focus:ring-2 focus:ring-blue-600">
                <label for="remember" class="ms-2 text-sm font-medium text-gray-500">Remember Me</label>
            </div>

            {{-- Forgot Password --}}
            <a href="#" class="text-sm font-semibold text-blue-500 underline transition-all hover:text-blue-600">
                Forgot password?
            </a>
        </div>

        {{-- Sign in Button --}}
        <button type="submit" class="w-full rounded-lg bg-blue-800 p-2.5 text-sm font-medium text-white transition-all hover:bg-blue-900 active:scale-95">
            Sign In
        </button>

        {{-- Or --}}
        <div class="my-5 flex flex-row items-center gap-4">
            <span class="h-0.5 w-20 rounded-full bg-gray-700"></span>
            <p class="text-sm font-bold text-gray-500">Or</p>
            <span class="h-0.5 w-20 rounded-full bg-gray-700"></span>
        </div>

        {{-- Sign in With Github or Google --}}
        <div class="flex w-full flex-col gap-1.5">
            {{-- Github --}}
            <button type="button"
                class="flex w-full items-center justify-center rounded-lg bg-[#24292F] p-2.5 text-center text-sm font-medium text-white transition-all hover:bg-[#24292F]/90 active:scale-95">
                <svg class="me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                        clip-rule="evenodd" />
                </svg>
                Continue with Github
            </button>

            {{-- Google --}}
            <button type="button"
                class="flex w-full items-center justify-center rounded-lg bg-red-600 p-2.5 text-center text-sm font-medium text-white transition-all hover:bg-red-600/90 active:scale-95">
                <svg class="me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                    <path fill-rule="evenodd"
                        d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z"
                        clip-rule="evenodd" />
                </svg>
                Continue with Google
            </button>
        </div>

        {{-- Are you new --}}
        <div class="mt-5 flex flex-row items-center gap-1.5">
            <p class="text-sm text-gray-500">
                Are you new?
            </p>
            <a href="{{ route('auth.register') }}" class="text-sm font-semibold text-blue-500 underline transition-all hover:text-blue-600">
                Create an Account
            </a>
        </div>
    </form>

    {{-- Alert --}}
    @session('message')
        <div class="bg-black/85 fixed top-16 flex flex-row items-center justify-center gap-2 rounded-lg border border-gray-900 px-3 py-2 shadow-2xl"
            x-data="{ isOpen: true }" x-show="isOpen">
            <h1 class="text-sm font-medium text-white">
                {{ session('message') }}
            </h1>
            <button type="button" class="transition-all hover:text-white/75" @click="isOpen = false" x-transition>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" class="h-5 w-5">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endSession
</x-auth-layout>
