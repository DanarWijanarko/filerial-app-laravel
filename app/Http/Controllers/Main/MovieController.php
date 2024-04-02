<?php

namespace App\Http\Controllers\Main;

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
}
