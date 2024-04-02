<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Services\TmdbService;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index()
    {
        $shows = $this->tmdb->getDiscover(
            mediaType: "shows",
            country: "KR",
            year: 2024,
        );

        $movies = $this->tmdb->getDiscover(
            mediaType: "movies",
            country: "KR",
            year: 2024,
        );

        return view("pages.main.home.index", [
            "shows" => $shows->results,
            "movies" => $movies->results,
        ]);
    }
}
