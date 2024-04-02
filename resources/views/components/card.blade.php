<a href="{{ route($item->mediaType . '.detail', ['name' => $item->slug, 'id' => $item->id]) }}" class="group relative h-full">
    @if ($item->poster !== null)
        <img src="{{ $item->poster }}" alt="{{ $item->name }}" class="h-full w-full rounded-lg object-cover">
    @else
        <div class="flex h-[450px] w-full items-center justify-center rounded-lg bg-gray-800 text-3xl font-bold">No Image</div>
    @endif
    <div class="absolute left-0 top-0 h-full w-full overflow-hidden rounded-lg bg-gray-800 opacity-0 transition-all duration-300 group-hover:opacity-100">
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
            <p class="line-clamp-5 h-36 text-xl">{{ $item->overview }}</p>
        </div>
    </div>
</a>
