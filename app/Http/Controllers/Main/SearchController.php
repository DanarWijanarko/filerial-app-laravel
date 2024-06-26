<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\SearchHistory;
use App\Services\TmdbService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TmdbService();
    }

    public function index(Request $request)
    {
        $allTrending = $this->tmdb->getTrending();

        $histories = SearchHistory::where('user_id', auth()->user()->id)->get()->sortByDesc("updated_at");

        return view("pages.main.search.index", [
            "allTrending" => $allTrending->results,
            "histories" => $histories
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->query("query");
        $type = $request->query("type");

        if (SearchHistory::where('body', $query)->first()) {
            if (SearchHistory::where('user_id', auth()->user()->id)->where('body', $query)->first()) {
                SearchHistory::where('user_id', auth()->user()->id)->where('body', $query)->get()->toQuery()->update([
                    'type' => $type,
                    'body' => $query,
                ]);
            } else {
                SearchHistory::where('user_id', auth()->user()->id)->create([
                    'user_id' => auth()->user()->id,
                    'type' => $type,
                    'body' => $query,
                ]);
            }
        } else {
            SearchHistory::create([
                'user_id' => auth()->user()->id,
                'type' => $type,
                'body' => $query,
            ]);
        }

        $histories = SearchHistory::where('user_id', auth()->user()->id)->get()->sortByDesc("updated_at");

        if ($query !== null) {
            $searchResult = $this->tmdb->search(
                query: $query,
                mediaType: $type,
            );

            return view("pages.main.search.query", [
                "query" => $query,
                "searchResult" => $searchResult->results,
                "oldQuery" => $query,
                "oldType" => $type,
                "histories" => $histories
            ]);
        }

        return redirect()->route("search.index");
    }

    public function historyDelete(Request $request)
    {
        SearchHistory::destroy($request->id);

        return redirect()->back();
    }
}
