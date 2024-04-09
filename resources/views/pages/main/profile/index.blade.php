@section('title')
    {{ __('Profile') }}
@endsection

<x-main-layout>
    <section class="flex flex-row gap-3 pt-10">
        {{-- Left Section --}}
        <div class="w-[80%] overflow-hidden rounded-xl border border-gray-800 bg-gray-800">
            {{-- Backdrop Image --}}
            <img src="https://koreancapture.com/storage/images/blog/cphtLdOsWE7NY751GLILolylSuaPyZ4fz3FM45p1.jpg" alt="backdrop"
                class="h-80 w-full object-cover object-top">

            {{-- Profile Detail --}}
            <div class="relative flex w-full flex-row justify-end">
                {{-- Profile Picture --}}
                <div class="absolute -top-[59.5%] left-5 overflow-hidden rounded-full bg-gray-800 p-[4.8px] shadow-xl shadow-gray-800">
                    <img src="https://wallpapercave.com/wp/wp11098312.jpg" alt="profile picture" class="h-44 w-44 rounded-full object-cover">
                </div>

                {{-- Profile Text --}}
                <div class="w-full py-5 pl-56 pr-5">
                    {{-- Name & Buttons --}}
                    <div class="mb-2.5 flex flex-row items-center justify-between">
                        {{-- Profile Name --}}
                        <h1 class="text-3xl font-bold text-white">
                            {{ Auth::user()->name }}
                        </h1>

                        {{-- Buttons Profile --}}
                        <div class="flex flex-row gap-1.5">
                            {{-- Edit Profile --}}
                            <a href="{{ route('user.edit', ['user' => auth()->user()]) }}"
                                class="flex flex-row items-center justify-center gap-1.5 rounded-md bg-blue-700 px-2.5 py-1.5 text-sm font-medium transition-all hover:bg-blue-800 active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[22px] w-[22px]">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                                Edit Profile
                            </a>

                            {{-- Logout --}}
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex flex-row items-center justify-center gap-1.5 rounded-md bg-red-700 px-2.5 py-1.5 text-sm font-medium transition-all hover:bg-red-800 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[22px] w-[22px]">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Member since, Location --}}
                    <div class="mb-4 flex flex-col gap-1">
                        <p class="text-sm font-medium text-gray-400">
                            Member since {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('F d, Y') }}
                        </p>
                        <p class="text-sm font-medium text-gray-400">
                            {{ Auth::user()->address ?? 'Address not Set' }}
                        </p>
                    </div>

                    {{-- Liked Genres --}}
                    <div class="flex flex-row gap-2">
                        <a href="#" class="rounded-lg bg-gray-600 px-1.5 py-0.5 text-sm font-bold text-white">
                            Action
                        </a>
                        <a href="#" class="rounded-lg bg-gray-600 px-1.5 py-0.5 text-sm font-bold text-white">
                            Sci-Fi
                        </a>
                        <a href="#" class="rounded-lg bg-gray-600 px-1.5 py-0.5 text-sm font-bold text-white">
                            Comedy
                        </a>
                        <a href="#" class="rounded-lg bg-gray-600 px-1.5 py-0.5 text-sm font-bold text-white">
                            Thriller
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Section --}}
        <div class="h-96 w-[20%]">
            <div class="w-full rounded-xl bg-gray-800 px-5 py-3">
                <h1 class="font-bold text-white">
                    Connect
                </h1>
            </div>
        </div>
    </section>

    <section class="mt-5 w-full overflow-hidden rounded-xl border border-gray-800 bg-gray-800 px-5 pt-1">
        {{-- Tabs Menu --}}
        <div class="mb-4 border-b border-gray-600" x-data="{ trigBtn: null }">
            <ul class="-mb-px flex flex-wrap text-center text-sm font-medium">
                <li class="me-2">
                    <a href="{{ route('user.index', ['media_type' => 'shows']) }}"
                        @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                        @class([
                            'inline-block rounded-t-lg p-4 transition-all',
                            'border-b-2 border-blue-500 text-blue-500' =>
                                Request::input('media_type', 'shows') === 'shows',
                        ]) class="inline-block rounded-t-lg p-4 text-white transition-all hover:text-blue-300">
                        Favorite Drama
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ route('user.index', ['media_type' => 'movies']) }}"
                        @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                        @class([
                            'inline-block rounded-t-lg p-4 transition-all',
                            'border-b-2 border-blue-500 text-blue-500' =>
                                Request::input('media_type') === 'movies',
                        ]) class="inline-block rounded-t-lg p-4 text-white transition-all hover:text-blue-300">
                        Favorite Movies
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ route('user.index', ['media_type' => 'person']) }}"
                        @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                        @class([
                            'inline-block rounded-t-lg p-4 transition-all',
                            'border-b-2 border-blue-500 text-blue-500' =>
                                Request::input('media_type') === 'person',
                        ]) class="inline-block rounded-t-lg p-4 text-white transition-all hover:text-blue-300">
                        Favorite Person
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ route('user.index', ['media_type' => 'lists']) }}"
                        @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                        @class([
                            'inline-block rounded-t-lg p-4 transition-all',
                            'border-b-2 border-blue-500 text-blue-500' =>
                                Request::input('media_type') === 'lists',
                        ]) class="inline-block rounded-t-lg p-4 text-white transition-all hover:text-blue-300">
                        Lists
                    </a>
                </li>
                <li class="me-2">
                    <a href="{{ request()->fullUrlWithQuery(['media_type' => 'recently']) }}"
                        @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                        @class([
                            'inline-block rounded-t-lg p-4 transition-all',
                            'border-b-2 border-blue-500 text-blue-500' =>
                                Request::input('media_type') === 'recently',
                        ]) class="inline-block rounded-t-lg p-4 text-white transition-all hover:text-blue-300">
                        Recently Viewed
                    </a>
                </li>
            </ul>
        </div>

        {{-- Tabs Content --}}
        @if ($results->isNotEmpty())
            <div class="relative overflow-x-auto rounded-lg">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-black/40 text-left text-xs uppercase text-gray-400">
                        <tr>
                            @if ($type === 'shows' || $type === 'movies')
                                <th scope="col" class="w-16 px-4 py-3 md:w-32">
                                    Backdrop
                                </th>
                                <th scope="col" class="min-w-48 px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="min-w-52 px-6 py-3">
                                    Release Date
                                </th>
                                <th scope="col" class="min-w-48 px-6 py-3">
                                    Original Country
                                </th>
                                <th scope="col" class="bs-red-500 px-6 py-3 text-center">
                                    Vote Average
                                </th>
                                <th scope="col" class="min-w-96 w-[45rem] px-6 py-3">
                                    Overview
                                </th>
                                <th scope="col" class="py-3 pr-4 text-center">
                                    Action
                                </th>
                            @elseif ($type === 'person')
                                <th scope="col" class="w-16 px-4 py-3 md:w-32">
                                    Profile
                                </th>
                                <th scope="col" class="min-w-48 px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="min-w-52 px-6 py-3">
                                    Birthday
                                </th>
                                <th scope="col" class="min-w-48 px-6 py-3">
                                    Gender
                                </th>
                                <th scope="col" class="bs-red-500 px-6 py-3 text-center">
                                    Popularity
                                </th>
                                <th scope="col" class="min-w-96 w-[45rem] px-6 py-3">
                                    Biography
                                </th>
                                <th scope="col" class="py-3 pr-4 text-center">
                                    Action
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $index => $item)
                            <tr
                                class="{{ $index < count($item->data) - 1 ? 'border-b' : '' }} {{ $index % 2 == 0 ? 'bg-black/15 hover:bg-gray-800' : 'bg-black/35 hover:bg-gray-800' }} border-gray-800 transition-all">
                                @if ($type === 'shows' || $type === 'movies')
                                    <td class="w-16 py-4 pl-4 md:w-32" x-data="{ imgUrl: null }">
                                        <img src="{{ $item->data['backdrop'] }}" alt="{{ $item->data['name'] }}"
                                            class="max-h-full max-w-full rounded-lg object-cover">
                                    </td>
                                    <td class="px-6 py-4 text-base font-semibold text-white">
                                        {{ $item->data['name'] }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-400">
                                        {{ $item->data['release_date'] }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-400">
                                        {{ $item->data['origin_country'] }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-gray-400">
                                        {{ $item->data['vote_average'] }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold">
                                        <p class="line-clamp-2 overflow-hidden">{{ $item->data['overview'] }}</p>
                                    </td>
                                @elseif ($type === 'person')
                                    <td class="w-16 py-4 pl-4 md:w-32" x-data="{ imgUrl: null }">
                                        <img src="{{ $item->data['profile'] }}" alt="{{ $item->data['name'] }}"
                                            class="max-h-16 w-full rounded-lg object-contain">
                                    </td>
                                    <td class="px-6 py-4 text-base font-semibold text-white">
                                        {{ $item->data['name'] }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-400">
                                        {{ $item->data['birthday'] }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-400">
                                        {{ $item->data['gender'] }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-gray-400">
                                        {{ $item->data['popularity'] }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold">
                                        <p class="line-clamp-2 overflow-hidden">{{ $item->data['biography'] }}</p>
                                    </td>
                                @endif
                                {{-- Actions --}}
                                <td class="w-0 py-4 pr-4">
                                    <div class="flex flex-row gap-1.5">
                                        {{-- Media Detail --}}
                                        <a href="{{ route($item->data['mediaType'] . '.detail', ['name' => $item->data['slug'], 'id' => $item->data['id']]) }}"
                                            class="rounded-full bg-blue-600 p-1.5 transition-all hover:bg-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>

                                        {{-- Media Delete --}}
                                        <form action="{{ route('user.favDestroy', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="rounded-full bg-red-600 p-1.5 transition-all hover:bg-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex h-[32.29rem] items-center justify-center text-3xl font-bold">
                No items to Display!
            </div>
        @endif

        {{-- Pagination --}}
        <div class="mb-5 mt-2 px-1">
            {{ $results->links() }}
        </div>
    </section>

    {{-- Alert --}}
    <x-alert />
</x-main-layout>
