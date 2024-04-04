<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Services\TmdbService;
use App\Http\Controllers\Controller;

class ExploreController extends Controller
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index(Request $request, string $to, string $name)
    {

        $results = null;
        switch ($to) {
            case 'company':
                $results = $this->tmdb->getDiscover(
                    $request->media_type,
                    companies_id: $request->id,
                );
                break;
            case 'providers':
                $results = $this->tmdb->getDiscover(
                    $request->media_type,
                    providers: $request->id,
                    country: 'KR',
                );
                break;
            case 'networks':
                $results = $this->tmdb->getDiscover(
                    $request->media_type,
                    networks: $request->id,
                );
                break;
            case 'genre':
                $results = $this->tmdb->getDiscover(
                    $request->media_type,
                    genres: $request->id,
                );
                break;
            case 'collection':
                $results = $this->tmdb->getCollection(
                    $request->media_type,
                    $request->id,
                );
                // return view('pages.main.explore.collection', [
                //     'result' => $results,
                // ]);
                break;
            default:
                abort(404);
                break;
        }

        return view("pages.main.explore.index", [
            'results' => $results->results,
        ]);
    }
}
