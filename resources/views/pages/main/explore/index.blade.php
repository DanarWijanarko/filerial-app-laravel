@section('title')
    {{ Str::ucfirst(request('to')) . __(' - ') . Str::of(request('name'))->replace('-', ' ')->title() }}
@endsection

<x-main-layout>
    <section class="pt-10">
        {{-- Explore Title --}}
        <h1 class="text-center text-5xl font-bold">
            {{ Str::of(request('name'))->replace('-', ' ')->title() }}
        </h1>

        <div class="mr-10 mt-7 grid grid-cols-5 gap-5">
            @foreach ($results as $result)
                <a href="{{ route($result->mediaType . '.detail', ['name' => $result->slug, 'id' => $result->id]) }}" class="group relative">
                    @if ($result->poster !== null)
                        <img src="{{ $result->poster }}" alt="{{ $result->name }}" class="h-full w-full rounded-lg">
                    @else
                        <div class="flex h-[450px] w-full items-center justify-center rounded-lg bg-gray-800 text-3xl font-bold">No Image</div>
                    @endif
                    <div
                        class="absolute left-0 top-0 h-full w-full overflow-hidden rounded-lg bg-gray-800 opacity-0 transition-all duration-300 group-hover:opacity-100">
                        <img src="{{ $result->backdrop }}" alt="{{ $result->name }}" class="h-1/2 w-full rounded-t-lg object-cover">
                        <div class="flex flex-col gap-2 px-4 py-3">
                            <h1 class="text-nowrap overflow-clip overflow-ellipsis text-3xl font-bold">{{ $result->name }}</h1>
                            <div class="flex w-full flex-row items-center gap-4 font-medium text-gray-300">
                                <p>{{ $result->release_date }}</p>
                                <span class="h-2 w-2 rounded-full bg-gray-600"></span>
                                <p>{{ $result->origin_country }}</p>
                                <span class="h-2 w-2 rounded-full bg-gray-600"></span>
                                <p>{{ $result->vote_average }}</p>
                            </div>
                            <p class="h-36 overflow-clip overflow-ellipsis text-xl">{{ $result->overview }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</x-main-layout>
