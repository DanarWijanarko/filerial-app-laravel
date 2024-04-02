<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TmdbService;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function detail(Request $request, string $name)
    {
        $mediaType = Str::of($request->route()->getName())->explode('.')[0];
        $endPoint = $request->input('credit_type', 'tv_credits');
        $credits_page = $request->input('credit_page', 1);
        $gallery_page = $request->input('gallery_page', 1);

        $personDetail = $this->tmdb->getDetail($mediaType, $request->id);
        $credits = $this->tmdb->getCredits($mediaType, $request->id, $endPoint, $credits_page, 10);
        $images = $this->tmdb->getImages($mediaType, $request->id, 5, $gallery_page);

        // dd($images);

        return view('pages.main.person.detail', [
            'detail' => $personDetail,
            'credits' => $credits,
            'images' => $images
        ]);
    }
}
