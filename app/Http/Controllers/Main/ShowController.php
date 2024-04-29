<?php

namespace App\Http\Controllers\Main;

use Carbon\Carbon;
use App\Models\Network;
use App\Models\Favorite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TmdbService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection\Collection;

class ShowController extends Controller
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index(Request $request)
    {
        $mediaType = Str::of($request->route()->getName())->explode('.')[0];

        $allAvailableCountry = $this->tmdb->getAvailableCountry()->all();
        $allGenres = $this->tmdb->getGenres($mediaType)->all();
        $allLanguages = $this->tmdb->getLanguages()->all();
        $allNetworks = Network::all()->toArray();

        $discover = $this->tmdb->getDiscover(
            mediaType: $mediaType,
            sort: 'popularity.desc',
            country: "KR",
            year: 2024,
            page: 1,
        );

        return view("pages.main.shows.index", [
            'allAvailableCountry' => $allAvailableCountry,
            'allGenres' => $allGenres,
            'allLanguages' => $allLanguages,
            'allNetworks' => $allNetworks,
            "results" => $discover->results,
        ]);
    }

    public function filter(Request $request)
    {
        $mediaType = Str::of($request->route()->getName())->explode('.')[0];

        $sort_by = $request->input('sort_by', 'popularity.desc');
        $selectedWatchProviders = $request->input('provider_ids', null);
        $selectedWatchRegion = $selectedWatchProviders === null ? null : $request->input('watch_region', null);
        $selectedGenres = $request->input('genres', null);
        $selectedLanguages = $request->input('original_language', 'Korean');
        $selectedNetwork = $request->input('network', 'Filter by Show Networks');
        $selectedFirstAirDateYear = $request->input('first_air_date_year', null);

        $allAvailableCountry = $this->tmdb->getAvailableCountry()->all();
        $allGenres = $this->tmdb->getGenres($mediaType)->all();
        $allLanguages = $this->tmdb->getLanguages()->all();
        $allNetworks = Network::get()->toArray();

        $original_language = $selectedLanguages !== 'None Selected' ? $this->tmdb->getLanguages()->filter(function ($value, $key) use ($selectedLanguages) {
            return $value['english_name'] === $selectedLanguages;
        })->first() : null;

        $network = $selectedNetwork !== 'Filter by Show Networks' ? Network::all()->filter(function ($value, $key) use ($selectedNetwork) {
            return $value['name'] === $selectedNetwork;
        })->first()->toArray() : null;

        dd($selectedGenres, $original_language, $network, $selectedFirstAirDateYear, $selectedWatchRegion, $selectedWatchProviders);

        $discover = $this->tmdb->getDiscover(
            mediaType: $mediaType,
            sort: $sort_by,
            country: "KR",
            year: 2024,
            page: 1,
        );

        return view("pages.main.shows.index", [
            'allAvailableCountry' => $allAvailableCountry,
            'allGenres' => $allGenres,
            'allLanguages' => $allLanguages,
            'allNetworks' => $allNetworks,
            'selectedWatchRegion' => $selectedWatchRegion,
            'selectedWatchProviders' => $selectedWatchProviders,
            'selectedGenres' => $selectedGenres,
            'selectedLanguange' => $selectedLanguages,
            'selectedNetwork' => $selectedNetwork,
            'selectedFirstAirDateYear' => $selectedFirstAirDateYear,
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

        // $isSessionDataExist = false;
        // if ($request->session()->has('recently_viewed')) {
        //     foreach ($request->session()->get('recently_viewed') as $item) {
        //         if ($item['media_id'] === $request->id) {
        //             $isSessionDataExist = true;
        //         } else {
        //             $isSessionDataExist = false;
        //         }
        //     }
        // }
        // if (!$isSessionDataExist) {
        //     $request->session()->push('recently_viewed', [
        //         'media_type' => $mediaType,
        //         'media_id' => $request->id,
        //     ]);
        // }

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
        $isExist = Favorite::where('user_id', auth()->user()->id)->where('data->id', $request->data['id'])->exists();

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
