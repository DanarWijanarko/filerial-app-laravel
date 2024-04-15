@section('title')
    {{ __('Register') }}
@endsection

<x-auth-layout>
    <form action="{{ route('auth.doRegister') }}" method="POST"
        class="bg-black/85 relative flex w-96 flex-col items-center justify-center overflow-hidden rounded-md border border-gray-900 px-7 py-5 shadow-2xl">
        @csrf

        {{-- Logo --}}
        <img src="{{ asset('images/filerial.png') }}" alt="logo" class="mb-8 w-24">

        {{-- Input --}}
        <div class="flex w-full flex-col items-end">
            <x-floating-input type="text" label="Full Name" name="name" />
            <x-floating-input type="text" label="Username" name="username" />
            <x-floating-input type="text" label="Email Address" name="email" />
            <x-floating-input type="password" label="Password" name="password" />
            <x-floating-input type="password" label="Confirm Password" name="password_confirmation" />
        </div>

        {{-- Sign in Button --}}
        <button type="submit" class="w-full rounded-lg bg-blue-800 p-2.5 text-sm font-medium text-white transition-all hover:bg-blue-900 active:scale-95">
            Sign Up
        </button>

        {{-- Or --}}
        <div class="my-5 flex flex-row items-center gap-4">
            <span class="h-0.5 w-20 rounded-full bg-gray-700"></span>
            <p class="text-sm font-bold text-gray-500">Or</p>
            <span class="h-0.5 w-20 rounded-full bg-gray-700"></span>
        </div>

        {{-- Are you new --}}
        <div class="flex flex-row items-center gap-1.5">
            <p class="text-sm text-gray-500">
                Have an Account?
            </p>
            <a href="{{ route('auth.login') }}" class="text-sm font-semibold text-blue-500 underline transition-all hover:text-blue-600">
                Sign in
            </a>
        </div>
    </form>
</x-auth-layout>
