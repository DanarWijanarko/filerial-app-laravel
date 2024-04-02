@section('title')
    {{ __('Movies') }}
@endsection

<x-main-layout>
    {{-- Marvels Movies --}}
    <x-swiper title="Marvels" :items="$marvels" class="pt-8" />
</x-main-layout>
