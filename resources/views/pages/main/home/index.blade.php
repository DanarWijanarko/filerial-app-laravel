@section('title')
    {{ __('Home') }}
@endsection

<x-main-layout>
    {{-- Latest Korean Tv Shows --}}
    <x-swiper title="Latest Korean Tv Shows" :items="$shows" class="pt-8" />

    {{-- Latest Korean Movies --}}
    <x-swiper title="Latest Korean Tv Shows" :items="$movies" class="pt-8" />

    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</x-main-layout>
