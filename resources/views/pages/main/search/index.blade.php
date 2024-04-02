@section('title')
    {{ __('Find Something') }}
@endsection

<x-main-layout>
    {{-- Search --}}
    <section class="relative mr-10 mt-10" x-data="{ isHistoryOpen: false }">
        {{-- Search Form Section --}}
        <form action="{{ route('search.query') }}" method="GET" class="flex">
            <div class="relative h-14 w-full">
                {{-- Select Type --}}
                <select name="type"
                    class="absolute left-0 top-0 z-10 flex h-14 w-[7.5rem] items-center justify-between rounded-s-lg border border-e-0 border-gray-500 bg-gray-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-gray-700 focus:ring-1 focus:ring-purple-500">
                    <option selected value="shows">Shows</option>
                    <option value="movies">Movies</option>
                    <option value="person">Person</option>
                    <option value="company">Companis</option>
                </select>

                {{-- Query Search --}}
                <input type="search" autocomplete="off" name="query" @click="isHistoryOpen = ! isHistoryOpen" :class="(open) && 'ring-purple-500'"
                    class="z-20 block h-full w-full rounded-lg border border-gray-600 bg-gray-700 py-4 pl-[8.5rem] text-sm text-white placeholder-gray-400 outline-none focus:border-none focus:ring-1 focus:ring-purple-500"
                    placeholder="Search" />

                {{-- Button Search --}}
                <button type="submit"
                    class="absolute end-0 top-0 flex h-full w-16 items-center justify-center rounded-e-lg bg-purple-600 p-2.5 text-sm font-medium hover:bg-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-500">
                    <svg viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                        <path stroke-width="1.7759999999999998" stroke-linecap="round" stroke="currentColor" stroke-linejoin="round"
                            d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" />
                    </svg>
                </button>
            </div>
        </form>

        {{-- History Section --}}
        <div class="w-sm absolute top-16 z-20 w-full rounded-lg bg-gray-700 py-2" x-show="isHistoryOpen" @click.outside="isHistoryOpen = false">
            @if ($histories->count())
                @foreach ($histories as $history)
                    <a href="{{ route('search.query', ['type' => $history->type, 'query' => $history->body]) }}"
                        class="flex w-full flex-row items-center transition-all hover:bg-gray-600">
                        {{-- Type --}}
                        <p class="w-[140.5px] py-2 text-center">{{ $history->type }}</p>
                        {{-- Vertical Line --}}
                        <span class="h-6 w-0.5 bg-gray-500"></span>
                        <div class="flex w-full flex-row items-center justify-between pl-4">
                            {{-- Body --}}
                            <p class="">{{ $history->body }}</p>

                            {{-- Delete --}}
                            <form action="{{ route('search.delete', ['id' => $history->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="transition-all00 flex justify-center px-3 py-2 text-white hover:text-purple-400">
                                    delete
                                </button>
                            </form>
                        </div>
                    </a>
                @endforeach
            @else
                <h1 class="flex w-full items-center justify-center py-3 text-xl text-white">
                    No Search History
                </h1>
            @endif
        </div>
    </section>

    <h1 class="mt-10 text-3xl font-bold">Trending Today</h1>
    <section class="mr-10 mt-3 grid grid-cols-5 gap-5">
        @foreach ($allTrending as $trending)
            <x-card :item="$trending"></x-card>
        @endforeach
    </section>
</x-main-layout>
