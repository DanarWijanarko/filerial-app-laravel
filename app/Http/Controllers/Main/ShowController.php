<?php

namespace App\Http\Controllers\Main;

use App\Models\Favorite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TmdbService;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index(Request $request, string $type = null)
    {
        $mediaType = Str::of($request->route()->getName())->explode('.')[0];

        $sort_by = $request->input('sort_by', 'popularity.desc');

        $discover = null;
        switch ($type) {
            case 'popular':
                $discover = $this->tmdb->getDiscover(
                    mediaType: $mediaType,
                    sort: $sort_by,
                    country: "KR",
                    year: 2024,
                    page: 1,
                );
                break;
            case 'top_rated':
                break;
            case 'on_the_air':
                break;
            case 'airing_today':
                break;
        }

        // dd($chineseShows);

        return view("pages.main.shows.index", [
            'type' => $type,
            "results" => $discover->results,
        ]);
    }

    public function detail(Request $request, string $name)
    {
        $mediaType = Str::of($request->route()->getName())->explode('.')[0];
        $galleryPage = intval($request->input('gallery_page', 1));
        $seasonNumber = intval($request->input('season_number', 1));

        $showDetail = $this->tmdb->getDetail($mediaType, $request->id);
        $showCredits = $this->tmdb->getCredits($mediaType, $request->id);
        $showImages = $this->tmdb->getImages($mediaType, $request->id, 10, $galleryPage);
        $showEpisodes = $this->tmdb->getEpisodes($request->id, $seasonNumber);
        $showRecommends = $this->tmdb->getRecommend($mediaType, $request->id);

        return view('pages.main.shows.detail', [
            'detail' => $showDetail,
            'credits' => $showCredits,
            'images' => $showImages,
            'episodes' => $showEpisodes,
            'recommends' => $showRecommends->results,
        ]);
    }

    public function store(Request $request)
    {
        $isExist = Favorite::where('data->id', $request->data['id'])->exists();

        if ($isExist) {
            return back()->with('status', (object) [
                'type' => 'error',
                'message' => $request->data['name'] . ', Already Exists in your Favorite!',
            ]);
        }

        Favorite::create([
            'user_id' => auth()->user()->id,
            'data' => $request->only('data')['data'],
        ]);

        return back()->with('status', (object) [
            'type' => 'success',
            'message' => $request->data['name'] . ', Successfully Added to My Favorite!',
        ]);
    }

    public function filter(Request $request)
    {
        $sort_by = $request->input('sort_by', 'popularity.desc');

        $validatedData = $request->validate([
            'test' => ['required', 'min:6'],
        ]);

        $discover = $this->tmdb->getDiscover(
            mediaType: 'shows',
            sort: $sort_by,
            country: "KR",
            year: 2024,
            page: 1,
        );

        return view('shows.index', [
            'results' => $discover->results,
        ]);
    }
}
