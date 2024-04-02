@section('title')
    {{ __('Profile') }}
@endsection

<x-main-layout>
    <section class="flex flex-row gap-3 pt-10">
        {{-- Left Section --}}
        <div class="w-[80%] overflow-hidden rounded-xl border border-gray-800">
            {{-- Backdrop Image --}}
            <img src="https://koreancapture.com/storage/images/blog/cphtLdOsWE7NY751GLILolylSuaPyZ4fz3FM45p1.jpg" alt="backdrop"
                class="h-80 w-full object-cover object-top">

            {{-- Profile Detail --}}
            <div class="relative flex w-full flex-row justify-end bg-gray-800">
                {{-- Profile Picture --}}
                <div class="absolute -top-[59.5%] left-5 overflow-hidden rounded-full bg-gray-800 p-[4.8px] shadow-xl shadow-gray-800">
                    <img src="https://wallpapercave.com/wp/wp11098312.jpg" alt="profile picture" class="h-44 w-44 rounded-full object-cover">
                </div>

                {{-- Profile Text --}}
                <div class="w-full py-5 pl-56 pr-5">
                    <div class="mb-2.5 flex flex-row items-center justify-between">
                        {{-- Profile Name --}}
                        <h1 class="text-3xl font-bold text-white">
                            Danar Wijanarko
                        </h1>

                        {{-- Button Edit Profile --}}
                        <a href="#"
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
                    </div>

                    <div class="mb-4 flex flex-col gap-1">
                        <p class="text-sm font-medium text-gray-400">
                            Member since February 25, 2024
                        </p>
                        <p class="text-sm font-medium text-gray-400">
                            Jakarta, Indonesia
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

    <section class="mt-5 h-96 w-full overflow-hidden rounded-xl border border-gray-800 bg-gray-800">
        {{-- Collections --}}
        <div class="">

        </div>

    </section>
</x-main-layout>
