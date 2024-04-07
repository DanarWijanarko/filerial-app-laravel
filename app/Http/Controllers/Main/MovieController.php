<?php

namespace App\Http\Controllers\Main;

use App\Models\Favorite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TmdbService;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index(Request $request)
    {
        $mediaType = Str::of($request->route()->getName())->explode('.')[0];

        $marvels = $this->tmdb->getDiscover(mediaType: $mediaType, companies_id: 420);

        return view("pages.main.movies.index", [
            'marvels' => $marvels->results,
        ]);
    }

    public function detail(Request $request, string $name)
    {
        $mediaType = Str::of($request->route()->getName())->explode('.')[0];
        $page = $request->input('gallery_page', 1);

        $movieDetail = $this->tmdb->getDetail($mediaType, $request->id);
        $movieCredits = $this->tmdb->getCredits($mediaType, $request->id);
        $movieImages = $this->tmdb->getImages($mediaType, $request->id, 10, $page);
        $recommends = $this->tmdb->getRecommend($mediaType, $request->id);

        // dd($movieDetail);

        return view('pages.main.movies.detail', [
            'detail' => $movieDetail,
            'credits' => $movieCredits,
            'images' => $movieImages,
            'recommends' => $recommends->results,
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
}
