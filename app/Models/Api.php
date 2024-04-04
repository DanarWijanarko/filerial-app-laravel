<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use League\ISO3166\ISO3166;
use Matriphe\ISO639\ISO639;

class Api
{
    private $convertCountry;
    private $convertLang;
    private $baseImgUrl;

    public function __construct()
    {
        $this->convertCountry = new ISO3166();
        $this->convertLang = new ISO639();
        $this->baseImgUrl = config("tmdb.baseImgUrl");
    }

    public function getTrending(array $data)
    {
        $items = Arr::get($data, "results");

        $pagination = [
            'page' => $data['page'],
            'total_pages' => $data['total_pages'],
            'total_results' => $data['total_results'],
        ];

        $results = [];
        foreach ($items as $item) {
            // ? Shows
            if ($item['media_type'] === 'tv') {
                $results[] = (object) [
                    "mediaType" => "shows",
                    "slug" => Str::slug($item["name"], language: $item["original_language"]),
                    "adult" => $item["adult"],
                    "backdrop" => $item["backdrop_path"] ? $this->baseImgUrl . $item["backdrop_path"] : null,
                    "genre_ids" => $item["genre_ids"],
                    "id" => $item["id"],
                    "origin_country" => $item['origin_country'] ? $this->convertCountry->alpha2($item["origin_country"][0])["name"] : null,
                    "original_language" => $item["original_language"],
                    "original_name" => $item["original_name"],
                    "overview" => $item["overview"],
                    "popularity" => $item["popularity"],
                    "poster" => $item["poster_path"] ? $this->baseImgUrl . $item["poster_path"] : null,
                    "release_date" => $item["first_air_date"] ? Carbon::parse($item["first_air_date"])->format("Y") : null,
                    "name" => $item["name"],
                    "vote_average" => $item["vote_average"] ? Number::format($item["vote_average"], maxPrecision: 1) : null,
                    "vote_count" => $item["vote_count"],
                ];
            }

            // ? Movies
            if ($item['media_type'] === 'movie') {
                $results[] = (object) [
                    "mediaType" => "movies",
                    "slug" => Str::slug($item["title"], language: $item["original_language"]),
                    "adult" => $item["adult"],
                    "backdrop" => $item["backdrop_path"] ? $this->baseImgUrl . $item["backdrop_path"] : null,
                    "genre_ids" => $item["genre_ids"],
                    "id" => $item["id"],
                    "origin_country" => $this->convertLang->languageByCode1($item["original_language"]),
                    "original_language" => $item["original_language"],
                    "original_name" => $item["original_title"],
                    "overview" => $item["overview"],
                    "popularity" => $item["popularity"],
                    "poster" => $item["poster_path"] ? $this->baseImgUrl . $item["poster_path"] : null,
                    "release_date" => $item["release_date"] ? Carbon::parse($item["release_date"])->format("Y") : null,
                    "name" => $item["title"],
                    "vote_average" => $item["vote_average"] ? Number::format($item["vote_average"], maxPrecision: 1) : null,
                    "vote_count" => $item["vote_count"],
                ];
            }
        }

        $mergedArr = array_merge($pagination, ['results' => $results]);
        $objData = json_decode(json_encode($mergedArr), false);

        // dd($objData);

        return $objData;
    }

    public function getList(array $data) : object
    {
        $item = Arr::get($data['results'], 'results');

        $pagination = [
            "pagination" => [
                "page" => $data["results"]["page"],
                "total_pages" => $data["results"]["total_pages"],
                "total_results" => $data["results"]["total_results"],
            ]
        ];

        $results = [];
        switch ($data["mediaType"]) {
            case "shows":
                $results = (object) Arr::map($item, function ($res) {
                    return [
                        'mediaType' => 'shows',
                        'slug' => Str::slug($res['name'], language: $res['original_language']),
                        'adult' => $res['adult'],
                        'backdrop' => $res["backdrop_path"] ? $this->baseImgUrl . $res["backdrop_path"] : null,
                        'genre_ids' => $res['genre_ids'],
                        'id' => $res['id'],
                        'origin_country' => $res['origin_country'] ? $this->convertCountry->alpha2($res["origin_country"][0])["name"] : null,
                        'original_language' => $res['original_language'],
                        'original_name' => $res['original_name'],
                        'overview' => $res['overview'],
                        'popularity' => $res['popularity'],
                        'poster' => $res["poster_path"] ? $this->baseImgUrl . $res["poster_path"] : null,
                        'release_date' => $res["first_air_date"] ? Carbon::parse($res["first_air_date"])->format("Y") : null,
                        'name' => $res['name'],
                        'vote_average' => $res["vote_average"] ? Number::format($res["vote_average"], maxPrecision: 1) : null,
                        'vote_count' => $res['vote_count'],
                    ];
                });
                break;
            case 'movies':
                $results = (object) Arr::map($item, function ($res) {
                    return [
                        "mediaType" => "movies",
                        "slug" => Str::slug($res["title"], language: $res["original_language"]),
                        "adult" => $res["adult"],
                        "backdrop" => $res["backdrop_path"] ? $this->baseImgUrl . $res["backdrop_path"] : null,
                        "genre_ids" => $res["genre_ids"],
                        "id" => $res["id"],
                        "origin_country" => $this->convertLang->languageByCode1($res["original_language"]),
                        "original_language" => $res["original_language"],
                        "original_name" => $res["original_title"],
                        "overview" => $res["overview"],
                        "popularity" => $res["popularity"],
                        "poster" => $res["poster_path"] ? $this->baseImgUrl . $res["poster_path"] : null,
                        "release_date" => $res["release_date"] ? Carbon::parse($res["release_date"])->format("Y") : null,
                        "name" => $res["title"],
                        "vote_average" => $res["vote_average"] ? Number::format($res["vote_average"], maxPrecision: 1) : null,
                        "vote_count" => $res["vote_count"],
                    ];
                });
                break;
            case "person":
                $results = (object) Arr::map($item, function ($res) {
                    return (object) [
                        "mediaType" => "person",
                        "adult" => $res["adult"],
                        "gender" => static::getGender($res["gender"]),
                        "id" => $res["id"],
                        "department" => $res["known_for_department"],
                        "name" => $res["name"],
                        "popularity" => $res["popularity"],
                        "profile" => $res["profile_path"] ? $this->baseImgUrl . $res["profile_path"] : null,
                    ];
                });
                break;
            case "company":
                $results = (object) Arr::map($item, function ($res) {
                    return (object) [
                        "mediaType" => "company",
                        "id" => $res["id"],
                        "logo" => $res["logo_path"] ? $this->baseImgUrl . $res["logo_path"] : null,
                        "name" => $res["name"],
                        "origin_country" => $res["origin_country"] !== '' ? $this->convertCountry->alpha2($res["origin_country"])["name"] : null,
                    ];
                });
        }

        $mergedArr = array_merge($pagination, ['results' => $results]);
        $objData = json_decode(json_encode($mergedArr), false);

        // dd($objData);

        return $objData;
    }

    public function getDetail(array $data)
    {
        $item = Arr::get($data, 'results');

        $results = (object) [];
        switch ($data['mediaType']) {
            case 'shows':
                $results = (object) [
                    'mediaType' => $data['mediaType'],
                    'adult' => $item['adult'],
                    'backdrop' => $item["backdrop_path"] ? $this->baseImgUrl . $item["backdrop_path"] : null,
                    'created_by' => $item['created_by'],
                    'episode_run_time' => $item['episode_run_time'] ? static::convertRuntime($item['episode_run_time'][0]) : null,
                    'first_air_date' => $item["first_air_date"] ? Carbon::parse($item["first_air_date"])->format("F d, Y") : null,
                    'genres' => $item['genres'],
                    'homepage' => $item['homepage'],
                    'id' => $item['id'],
                    'in_production' => $item['in_production'],
                    // 'languages' => $this->convertLang->languageByCode1($item["languages"][0]),
                    'last_air_date' => $item["last_air_date"] ? Carbon::parse($item["last_air_date"])->format("F d, Y") : null,
                    'last_episode_to_air' => $item['last_episode_to_air'],
                    'name' => $item['name'],
                    'next_episode_to_air' => $item['next_episode_to_air'],
                    'networks' => $item['networks'],
                    'number_of_episodes' => $item['number_of_episodes'],
                    'number_of_seasons' => $item['number_of_seasons'],
                    'origin_country' => $this->convertCountry->alpha2($item["origin_country"][0])["name"],
                    // 'original_language' => $this->convertLang->languageByCode1($item["original_language"][0]),
                    'original_name' => $item['original_name'],
                    'overview' => $item['overview'],
                    'popularity' => $item['popularity'],
                    'poster' => $item["poster_path"] ? $this->baseImgUrl . $item["poster_path"] : null,
                    'production_companies' => Arr::map($item['production_companies'], function ($res) {
                        return (object) [
                            'id' => $res['id'],
                            "slug" => Str::slug($res["name"]),
                            'logo' => $this->baseImgUrl . $res['logo_path'],
                            'name' => $res['name'],
                            'origin_country' => $this->convertCountry->alpha2($res["origin_country"])["name"],
                        ];
                    }),
                    'production_countries' => $item['production_countries'][0]['name'],
                    'seasons' => $item['seasons'],
                    'spoken_languages' => $item['spoken_languages'],
                    'status' => $item['status'],
                    'tagline' => $item['tagline'],
                    'type' => $item['type'],
                    'vote_average' => $item["vote_average"] ? Number::format($item["vote_average"], maxPrecision: 1) : null,
                    'vote_count' => $item['vote_count'],
                    'videos' => static::findType($item['videos']['results']),
                ];
                break;
            case 'movies':
                $results = (object) [
                    'mediaType' => $data['mediaType'],
                    'adult' => $item['adult'],
                    'backdrop' => $item["backdrop_path"] ? $this->baseImgUrl . $item["backdrop_path"] : null,
                    'belongs_to_collection' => $item['belongs_to_collection'],
                    'budget' => $item['budget'] ? Number::currency($item['budget']) : null,
                    'genres' => $item['genres'],
                    'homepage' => $item['homepage'],
                    'id' => $item['id'],
                    'imdb_id' => $item['imdb_id'],
                    'languages' => $this->convertLang->languageByCode1($item["original_language"]),
                    'name' => $item['title'],
                    'origin_country' => $this->convertCountry->alpha2($item["production_countries"][0]['iso_3166_1'])["name"],
                    'original_name' => $item['original_title'],
                    'overview' => $item['overview'],
                    'popularity' => $item['popularity'],
                    'poster' => $item["poster_path"] ? $this->baseImgUrl . $item["poster_path"] : null,
                    'production_companies' => Arr::map($item['production_companies'], function ($res) {
                        return (object) [
                            'id' => $res['id'],
                            "slug" => Str::slug($res["name"]),
                            'logo' => $this->baseImgUrl . $res['logo_path'],
                            'name' => $res['name'],
                            'origin_country' => $this->convertCountry->alpha2($res["origin_country"])["name"],
                        ];
                    }),
                    'production_countries' => $item['production_countries'][0]['name'],
                    'release_date' => $item["release_date"] ? Carbon::parse($item["release_date"])->format("F d, Y") : null,
                    'revenue' => $item['revenue'] ? Number::currency($item['revenue']) : null,
                    'runtime' => $item['runtime'] ? static::convertRuntime($item['runtime']) : null,
                    'spoken_languages' => $item['spoken_languages'],
                    'status' => $item['status'],
                    'tagline' => $item['tagline'],
                    'vote_average' => $item["vote_average"] ? Number::format($item["vote_average"], maxPrecision: 1) : null,
                    'vote_count' => $item['vote_count'],
                    'videos' => static::findType($item['videos']['results']),
                ];
                break;
            case 'person':
                $results = (object) [
                    'mediaType' => $data['mediaType'],
                    "slug" => Str::slug($item["name"]),
                    'adult' => $item['adult'],
                    'also_known_as' => $item['also_known_as'],
                    'biography' => $item['biography'],
                    'birthday' => $item["birthday"] ? Carbon::parse($item["birthday"])->format("F d, Y") : null,
                    'deathday' => $item['deathday'] ? Carbon::parse($item["deathday"])->format("F d, Y") : null,
                    'gender' => static::getGender($item['gender']),
                    'age' => $item['birthday'] ? Carbon::parse($item['birthday'])->age : null,
                    'homepage' => $item['homepage'],
                    'id' => $item['id'],
                    'known_for_department' => $item['known_for_department'],
                    'name' => $item['name'],
                    'place_of_birth' => $item['place_of_birth'],
                    'popularity' => $item['popularity'],
                    'profile' => $item["profile_path"] ? $this->baseImgUrl . $item["profile_path"] : null,
                ];
                break;
            case 'company':
                $results = (object) [
                    'mediaType' => $data['mediaType'],
                    "slug" => Str::slug($item["name"]),
                    'description' => $item['description'] ? $item['description'] : null,
                    'headquarters' => $item['headquarters'],
                    'homepage' => $item['homepage'],
                    'id' => $item['id'],
                    'logo' => $item["logo_path"] ? $this->baseImgUrl . $item["logo_path"] : null,
                    'name' => $item['name'],
                    'origin_country' => $item['origin_country'],
                    'parent_company' => $item['parent_company'],
                ];
                break;
        }

        $objResults = json_decode(json_encode($results), false);

        // dd($objResults);

        return $objResults;
    }

    public function getCredit(array $data)
    {
        $item = Arr::get($data, 'results.cast');

        if ($data['mediaType'] === 'person') {
            $results = collect();
            switch ($data['creditType']) {
                case 'tv_credits':
                    $results = collect($item)->map(function ($res) use ($data) {
                        return [
                            'mediaType' => 'shows',
                            'creditType' => $data['creditType'],
                            "slug" => Str::slug($res['name'], language: $res['original_language']),
                            'adult' => $res['adult'],
                            'backdrop' => $res['backdrop_path'] ? $this->baseImgUrl . $res['backdrop_path'] : null,
                            'genre_ids' => $res['genre_ids'],
                            'id' => $res['id'],
                            'origin_country' => $res['origin_country'] ? $this->convertCountry->alpha2($res["origin_country"][0])["name"] : null,
                            'original_language' => $res['original_language'],
                            'original_name' => $res['original_name'],
                            'overview' => $res['overview'],
                            'popularity' => $res['popularity'],
                            'poster' => $res['poster_path'] ? $this->baseImgUrl . $res['poster_path'] : null,
                            'release_date' => $res["first_air_date"] ? Carbon::parse($res["first_air_date"])->format("Y") : null,
                            'name' => $res['name'],
                            'vote_average' => $res["vote_average"] ? Number::format($res["vote_average"], maxPrecision: 1) : null,
                            'vote_count' => $res['vote_count'],
                            'character' => $res['character'],
                            'credit_id' => $res['credit_id'],
                            'episode_count' => $res['episode_count'],
                        ];
                    });
                    break;
                case 'movie_credits':
                    $results = collect($item)->map(function ($res) use ($data) {
                        return [
                            'mediaType' => 'movies',
                            'creditType' => $data['creditType'],
                            'slug' => Str::slug($res['title'], language: $res['original_language']),
                            'adult' => $res['adult'],
                            'backdrop' => $res['backdrop_path'] ? $this->baseImgUrl . $res['backdrop_path'] : null,
                            'genre_ids' => $res['genre_ids'],
                            'id' => $res['id'],
                            'origin_country' => $this->convertLang->languageByCode1($res['original_language']),
                            'original_language' => $res['original_language'],
                            'original_name' => $res['original_title'],
                            'overview' => $res['overview'],
                            'popularity' => $res['popularity'],
                            'poster' => $res['poster_path'] ? $this->baseImgUrl . $res['poster_path'] : null,
                            'release_date' => $res['release_date'],
                            'name' => $res['title'],
                            'vote_average' => $res['vote_average'],
                            'vote_count' => $res['vote_count'],
                            'character' => $res['character'],
                            'credit_id' => $res['credit_id'],
                        ];
                    });
                    break;
            }

            $total = $results->count();
            $offset = ($data['page'] - 1) * $data['perPage'];
            $results = $results->sortByDesc('release_date')->slice($offset, $data['perPage'])->all();

            $pagination = [
                'pagination' => [
                    'total' => $total,
                    'per_page' => $data['perPage'],
                    'current_page' => $data['page'],
                    'last_page' => intval(ceil($total / $data['perPage'])),
                ],
                'results' => $results,
            ];

            $objResults = json_decode(json_encode($pagination), false);

            // dd($objResults);

            return $objResults;
        } else {
            $results = (object) Arr::map($item, function ($res) use ($data) {
                return (object) [
                    'mediaType' => $data['mediaType'],
                    "slug" => Str::slug($res["name"]),
                    'adult' => $res['adult'],
                    'gender' => static::getGender($res['gender']),
                    'id' => $res['id'],
                    'known_for_department' => $res['known_for_department'],
                    'name' => $res['name'],
                    'original_name' => $res['original_name'],
                    'popularity' => $res['popularity'],
                    'profile' => $res['profile_path'] ? $this->baseImgUrl . $res['profile_path'] : null,
                    'character' => $res['character'],
                    'credit_id' => $res['credit_id'],
                ];
            });

            $objResults = json_decode(json_encode($results), false);

            // dd($objResults);

            return $objResults;
        }
    }

    public function getImages(array $data)
    {
        $item = Arr::get($data, 'results.backdrops') !== null ? Arr::get($data, 'results.backdrops') : Arr::get($data, 'results.profiles');

        $results = collect($item)->map(function ($res) {
            return $this->baseImgUrl . $res['file_path'];
        });

        $total = $results->count();
        $offset = ($data['page'] - 1) * $data['perPage'];
        $results = $results->slice($offset, $data['perPage'])->all();

        $pagination = [
            'pagination' => [
                'total' => $total,
                'per_page' => $data['perPage'],
                'current_page' => $data['page'],
                'last_page' => intval(ceil($total / $data['perPage'])),
            ],
            'results' => $results,
        ];

        $objResults = json_decode(json_encode($pagination), false);

        // dd($objResults);

        return $objResults;
    }

    public function getEpisodes(array $data) : Collection
    {
        $results = Arr::map(Arr::get($data, 'episodes'), function ($item) {
            return (object) [
                'air_date' => $item["air_date"] ? Carbon::parse($item["air_date"])->format("F d, Y") : null,
                'episode_number' => $item['episode_number'],
                'episode_type' => $item['episode_type'],
                'id' => $item['id'],
                'name' => $item['name'],
                'overview' => $item['overview'] ? $item['overview'] : null,
                'production_code' => $item['production_code'] ? $item['production_code'] : null,
                'runtime' => $item['runtime'] ? static::convertRuntime($item['runtime']) : null,
                'season_number' => $item['season_number'],
                'show_id' => $item['show_id'],
                'poster' => $item["still_path"] ? $this->baseImgUrl . $item["still_path"] : null,
                'vote_average' => $item["vote_average"] ? floatval(Number::format($item["vote_average"], maxPrecision: 1)) : null,
                'vote_count' => $item['vote_count'],
            ];
        });

        $objResults = json_decode(json_encode($results), false);

        // dd($objResults);

        return collect($objResults);
    }

    public function getCollection(string $mediaType, array $data)
    {
        // $results = (object) [
        //     'id' => $data['id'],
        //     'name' => $data['name'],
        //     'poster' => $data['poster_path'] ? $this->baseImgUrl . $data['poster_path'] : null,
        //     'backdrop' => $data['backdrop_path'] ? $this->baseImgUrl . $data['backdrop_path'] : null,
        //     'results' => Arr::map($data['parts'], function ($item) use ($mediaType) {
        //         return [
        //             'mediaType' => $mediaType,
        //             "slug" => Str::slug($item["title"], language: $item["original_language"]),
        //             'adult' => $item['adult'],
        //             'backdrop' => $item['poster_path'] ? $this->baseImgUrl . $item['poster_path'] : null,
        //             'id' => $item['id'],
        //             'title' => $item['title'],
        //             'original_language' => $item['original_language'],
        //             'original_title' => $item['original_title'],
        //             'overview' => $item['overview'],
        //             'poster' => $item['poster_path'] ? $this->baseImgUrl . $item['poster_path'] : null,
        //             'media_type' => $item['media_type'],
        //             'genre_ids' => $item['genre_ids'],
        //             'popularity' => $item['popularity'],
        //             'release_date' => $item['release_date'],
        //             'video' => $item['video'],
        //             'vote_average' => $item['vote_average'],
        //             'vote_count' => $item['vote_count'],
        //         ];
        //     }),
        // ];

        $results = [];
        switch ($mediaType) {
            case "shows":
                $results = (object) Arr::map($data['parts'], function ($res) {
                    return [
                        'mediaType' => 'shows',
                        'slug' => Str::slug($res['name'], language: $res['original_language']),
                        'adult' => $res['adult'],
                        'backdrop' => $res["backdrop_path"] ? $this->baseImgUrl . $res["backdrop_path"] : null,
                        'genre_ids' => $res['genre_ids'],
                        'id' => $res['id'],
                        'origin_country' => $res['origin_country'] ? $this->convertCountry->alpha2($res["origin_country"][0])["name"] : null,
                        'original_language' => $res['original_language'],
                        'original_name' => $res['original_name'],
                        'overview' => $res['overview'],
                        'popularity' => $res['popularity'],
                        'poster' => $res["poster_path"] ? $this->baseImgUrl . $res["poster_path"] : null,
                        'release_date' => $res["first_air_date"] ? Carbon::parse($res["first_air_date"])->format("Y") : null,
                        'name' => $res['name'],
                        'vote_average' => $res["vote_average"] ? Number::format($res["vote_average"], maxPrecision: 1) : null,
                        'vote_count' => $res['vote_count'],
                    ];
                });
                break;
            case 'movies':
                $results = (object) Arr::map($data['parts'], function ($res) {
                    return [
                        "mediaType" => "movies",
                        "slug" => Str::slug($res["title"], language: $res["original_language"]),
                        "adult" => $res["adult"],
                        "backdrop" => $res["backdrop_path"] ? $this->baseImgUrl . $res["backdrop_path"] : null,
                        "genre_ids" => $res["genre_ids"],
                        "id" => $res["id"],
                        "origin_country" => $this->convertLang->languageByCode1($res["original_language"]),
                        "original_language" => $res["original_language"],
                        "original_name" => $res["original_title"],
                        "overview" => $res["overview"],
                        "popularity" => $res["popularity"],
                        "poster" => $res["poster_path"] ? $this->baseImgUrl . $res["poster_path"] : null,
                        "release_date" => $res["release_date"] ? Carbon::parse($res["release_date"])->format("Y") : null,
                        "name" => $res["title"],
                        "vote_average" => $res["vote_average"] ? Number::format($res["vote_average"], maxPrecision: 1) : null,
                        "vote_count" => $res["vote_count"],
                    ];
                });
                break;
        }

        $objResults = json_decode(json_encode($results), false);

        // dd($objResults);

        return (object) ['results' => $objResults];
    }

    private static function findType($results)
    {
        if ($results === null || $results === []) {
            return null;
        } else {
            $trailer = Arr::first($results, function ($value, $key) {
                return $value['type'] === 'Trailer';
            });

            $teaser = $trailer ?? Arr::first($results, function ($value, $key) {
                return $value['type'] === 'Teaser';
            });

            return $teaser;
        }
    }

    private static function convertRuntime(int $time)
    {
        $hours = intdiv($time, 60);
        $remainingMinutes = $time % 60;
        $formattedTime = 0;

        if ($hours > 0) {
            if ($remainingMinutes > 0) {
                $formattedTime = Carbon::createFromTime($hours, $remainingMinutes)->format('G\hi\m');
            } else {
                $formattedTime = Carbon::createFromTime($hours, $remainingMinutes)->format('G\h');
            }
        } else {
            $formattedTime = Carbon::createFromTime(0, $remainingMinutes)->format('i\m');
        }

        return $formattedTime;
    }

    private static function getGender(int $gender) : string
    {
        (string) $strGender = null;

        if ($gender === 0) {
            $strGender = "Not Set";
        } else if ($gender === 1) {
            $strGender = "Female";
        } else if ($gender === 2) {
            $strGender = "Male";
        } else if ($gender === 3) {
            $strGender = "Non Binary";
        }

        return $strGender;
    }
}
