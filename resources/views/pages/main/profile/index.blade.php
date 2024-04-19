@section('title')
    {{ __('Profile - ') . $user->username }}
@endsection

<x-main-layout>
    <section class="flex h-[33.25rem] flex-row gap-3 pt-10">
        {{-- Left Section --}}
        <div class="w-[80%] overflow-hidden rounded-xl border border-gray-800 bg-gray-800">
            {{-- Backdrop Image --}}
            <img src="{{ $user->backdrop ? asset('storage/' . $user->backdrop) : 'http://www.listercarterhomes.com/wp-content/uploads/2013/11/dummy-image-square.jpg' }}"
                alt="backdrop" class="h-80 w-full object-fill">

            {{-- Profile Detail --}}
            <div class="relative flex w-full flex-row justify-end">
                {{-- Profile Picture --}}
                <div class="absolute -top-[59.5%] left-5 overflow-hidden rounded-full bg-gray-800 p-[4.8px] shadow-xl shadow-gray-800">
                    <img src="{{ $user->picture ? asset('storage/' . $user->picture) : 'http://www.listercarterhomes.com/wp-content/uploads/2013/11/dummy-image-square.jpg' }}"
                        alt="profile picture" class="h-44 w-44 rounded-full object-cover">
                </div>

                {{-- Profile Text --}}
                <div class="w-full py-5 pl-56 pr-5">
                    {{-- Name & Buttons --}}
                    <div class="mb-2.5 flex flex-row items-center justify-between">
                        {{-- Profile Name --}}
                        <h1 class="text-3xl font-bold text-white">
                            {{ $user->name ?? 'Username not Set' }}
                        </h1>

                        {{-- Buttons Profile --}}
                        <div class="flex flex-row gap-1.5">
                            {{-- Edit Profile --}}
                            @if (Auth::user()->id === $user->id)
                                <a href="{{ route('user.edit', ['user' => auth()->user()]) }}"
                                    class="flex flex-row items-center justify-center gap-1.5 rounded-md bg-blue-700 px-2.5 py-1.5 text-sm font-medium transition-all hover:bg-blue-800 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-[22px] w-[22px]">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    Edit Profile
                                </a>
                            @endif

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
                            Member since {{ \Carbon\Carbon::parse($user->created_at)->format('F d, Y') }}
                        </p>
                        <p class="text-sm font-medium text-gray-400">
                            {{ $user->address ?? 'Address not Set' }}
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
        <div class="flex w-[20%] flex-col gap-3">
            {{-- Connect --}}
            <div class="h-[35.7%] w-full overflow-y-auto rounded-xl bg-gray-800 py-3">
                <h1 class="mx-5 font-bold text-white">
                    Connect
                </h1>
                @if ($user->social !== null)
                    <div class="mt-3 flex w-full flex-col gap-2">
                        @foreach ($user->social as $item)
                            <a href="{{ $item['type'] . $item['username'] }}" target="_blank" class="flex w-full flex-row gap-2 px-5 py-1 hover:bg-slate-700">
                                {{-- Social Media Logo --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                    @if ($item['type'] === 'https://www.instagram.com/')
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M16.5 7.5l0 .01" />
                                    @elseif ($item['type'] === 'https://www.tiktok.com/@')
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M21 7.917v4.034a9.948 9.948 0 0 1 -5 -1.951v4.5a6.5 6.5 0 1 1 -8 -6.326v4.326a2.5 2.5 0 1 0 4 2v-11.5h4.083a6.005 6.005 0 0 0 4.917 4.917z" />
                                    @elseif ($item['type'] === 'https://www.facebook.com/')
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                    @endif
                                </svg>
                                {{ $item['username'] }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="flex h-[84%] w-full items-center justify-center text-xl font-bold">No Data!</p>
                @endif
            </div>

            {{-- Other Account's --}}
            <div class="h-[64.3%] w-full overflow-y-auto rounded-xl bg-gray-800 py-3">
                <h1 class="mx-5 font-bold text-white">
                    Other Account's
                </h1>
                @if ($users !== null)
                    <div class="mt-3 flex w-full flex-col gap-1">
                        @foreach ($users as $userss)
                            <a href="{{ route('user.index', ['username' => $userss->username]) }}"
                                class="flex w-full flex-row items-center gap-2 px-5 py-2 hover:bg-slate-700">
                                <img src="{{ $userss->picture ? asset('storage/' . $userss->picture) : 'http://www.listercarterhomes.com/wp-content/uploads/2013/11/dummy-image-square.jpg' }}"
                                    alt="Profile Image" class="h-10 w-10 rounded-full object-cover">
                                <p class="flex flex-col text-white">
                                    <span
                                        class="-mb-1.5 text-lg font-bold">{{ $userss->id === Auth::user()->id ? 'Me' : Str::ucfirst($userss->username) }}</span>
                                    <span class="text-xs font-medium text-gray-400">
                                        Member since {{ \Carbon\Carbon::parse($userss->created_at)->format('Y') }}
                                    </span>
                                </p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="flex h-[84%] w-full items-center justify-center text-xl font-bold">No Data!</p>
                @endif
            </div>
        </div>
    </section>

    <section class="mt-5 w-full overflow-hidden rounded-xl border border-gray-800 bg-gray-800 px-5 pt-1">
        {{-- Tabs Menu --}}
        <div class="mb-4 flex flex-row justify-between border-b border-gray-600" x-data="{ trigBtn: null }">
            {{-- Nav Link --}}
            <ul class="-mb-px flex flex-wrap text-center text-sm font-medium">
                <li class="me-2">
                    <a href="{{ route('user.index', ['username' => $user->username, 'media_type' => 'shows']) }}"
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
                    <a href="{{ route('user.index', ['username' => $user->username, 'media_type' => 'movies']) }}"
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
                    <a href="{{ route('user.index', ['username' => $user->username, 'media_type' => 'person']) }}"
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
                    <a href="{{ route('user.index', ['username' => $user->username, 'media_type' => 'recently']) }}"
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
</x-main-layout>
