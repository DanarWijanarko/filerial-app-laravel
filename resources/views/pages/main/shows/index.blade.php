@section('title')
    {{ __('Shows') }}
@endsection

<x-main-layout>
    <section class="flex items-center justify-between border-b border-gray-700 pb-3 pt-5">
        {{-- Buttons Navigate --}}
        <div class="flex flex-row gap-1.5">
            <a href="{{ route('shows.index', ['type' => 'popular']) }}"
                class="rounded-md bg-purple-600 px-3 py-1 text-sm font-bold transition-all hover:bg-purple-700 active:scale-95">
                Popular
            </a>
            <a href="{{ route('shows.index', ['type' => 'top_rated']) }}"
                class="rounded-md bg-purple-600 px-3 py-1 text-sm font-bold transition-all hover:bg-purple-700 active:scale-95">
                Top Rated
            </a>
            <a href="{{ route('shows.index', ['type' => 'on_the_air']) }}"
                class="rounded-md bg-purple-600 px-3 py-1 text-sm font-bold transition-all hover:bg-purple-700 active:scale-95">
                On The Air
            </a>
            <a href="{{ route('shows.index', ['type' => 'airing_today']) }}"
                class="rounded-md bg-purple-600 px-3 py-1 text-sm font-bold transition-all hover:bg-purple-700 active:scale-95">
                Airing Today
            </a>
        </div>

        {{-- Button Sorting --}}
        <div class="relative" x-data="{ isOpen: false }">
            <button class="flex flex-row items-center justify-center gap-2 text-sm" @click="isOpen = ! isOpen">
                Sort
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" class="h-4 w-4">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 9l6 6l6 -6" />
                </svg>
            </button>
            <div x-show="isOpen" @click.outside="isOpen = false" x-transition.scale.origin.top.right
                class="absolute right-0 top-7 flex w-32 flex-col overflow-hidden rounded-lg border border-gray-600 bg-gray-700 py-1 text-sm text-gray-400">
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'popularity.desc']) }}" @class([
                    'px-4 py-1 hover:bg-gray-800',
                    'text-white font-bold' => true,
                ])>
                    Most Popular
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'vote_average.desc']) }}" class="px-4 py-1 hover:bg-gray-800">
                    Best Rating
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'first_air_date.desc']) }}" class="px-4 py-1 hover:bg-gray-800">
                    Newest
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name.desc']) }}" class="px-4 py-1 hover:bg-gray-800">
                    Name (A - Z)
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name.asc']) }}" class="px-4 py-1 hover:bg-gray-800">
                    Name (Z - A)
                </a>
            </div>
        </div>
    </section>
    <section class="flex gap-5 pt-5">
        <div class="w-10/12">
            {{-- <h1 class="mb-2 text-3xl font-bold">{{ Str::ucfirst($type) }} Drama</h1> --}}
            <div class="grid grid-cols-5 gap-2">
                @foreach ($results as $item)
                    <a href="{{ route($item->mediaType . '.detail', ['name' => $item->slug, 'id' => $item->id]) }}" class="group relative h-full">
                        @if ($item->poster !== null)
                            <img src="{{ $item->poster }}" alt="{{ $item->name }}" class="h-full w-full rounded-lg object-cover">
                        @else
                            <div class="flex h-[450px] w-full items-center justify-center rounded-lg bg-gray-800 text-3xl font-bold">No Image</div>
                        @endif
                        <div
                            class="absolute left-0 top-0 h-full w-full overflow-hidden rounded-lg bg-gray-800 opacity-0 transition-all duration-300 group-hover:opacity-100">
                            <img src="{{ $item->backdrop }}" alt="{{ $item->name }}" class="h-1/2 w-full rounded-t-lg object-cover">
                            <div class="flex flex-col gap-2 overflow-hidden px-4 py-3">
                                <h1 class="text-nowrap overflow-clip overflow-ellipsis text-3xl font-bold">{{ $item->name }}</h1>
                                <div class="flex w-full flex-row items-center gap-4 font-medium text-gray-300">
                                    <p>{{ $item->release_date }}</p>
                                    <span class="h-2 w-2 rounded-full bg-gray-600"></span>
                                    <p>{{ $item->origin_country }}</p>
                                    <span class="h-2 w-2 rounded-full bg-gray-600"></span>
                                    <p>{{ $item->vote_average }}</p>
                                </div>
                                <p class="line-clamp-4 text-xl">{{ $item->overview }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="">
            <form action="{{ route('shows.filter') }}" method="POST">
                @csrf
                <input type="text" name="test" value="{{ old('test') }}" class="bg-gray-600">

                <button type="submit">
                    Find
                </button>
            </form>
        </div>
    </section>
</x-main-layout>
