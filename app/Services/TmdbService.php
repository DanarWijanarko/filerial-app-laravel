<?php

namespace App\Services;

use Exception;
use App\Models\Api;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class TmdbService
{
    private $apiKey;
    private $baseUrl;
    private $convert;

    public function __construct()
    {
        $this->apiKey = config('tmdb.apiKey');
        $this->baseUrl = config('tmdb.baseUrl');
        $this->convert = new Api();
    }

    public function getTrending(int $page = 1)
    {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey,
                'page' => $page,
            ])->get($this->baseUrl . '/trending/all/day');

            if ($response->successful()) {
                return $this->convert->getTrending($response->json());
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function search(string $query, string $mediaType, $page = 1)
    {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey,
                'query' => $query,
                'page' => $page,
            ])->get($this->baseUrl . '/search/' . $this->mediaTypeConvert($mediaType));

            if ($response->successful()) {
                return $this->convert->getList([
                    'mediaType' => $mediaType,
                    'results' => $response->json(),
                ]);
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getDiscover(
        string $mediaType,
        string $sort = null,
        int $year = null,
        string $country = null,
        int $companies_id = null,
        int $networks = null,
        string $genres = null,
        int $providers = null,
        int $page = 1,
    ) {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey,
                'include_adult' => false,
                'include_null_first_air_dates' => false,
                'sort_by' => $sort ?? null,
                'first_air_date_year' => $year ?? null,
                'with_origin_country' => $country ?? null,
                'with_companies' => $companies_id ?? null,
                'with_networks' => $networks ?? null,
                'with_genres' => $genres ?? null,
                'with_watch_providers' => $providers ?? null,
                'page' => $page,
            ])->get($this->baseUrl . '/discover/' . $this->mediaTypeConvert($mediaType));

            if ($response->successful()) {
                return $this->convert->getList([
                    'mediaType' => $mediaType,
                    'results' => $response->json(),
                ]);
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getDetail(string $mediaType, int $id)
    {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey,
                'append_to_response' => 'videos'
            ])->get($this->baseUrl . '/' . $this->mediaTypeConvert($mediaType) . '/' . $id);

            if ($response->successful()) {
                return $this->convert->getDetail([
                    'mediaType' => $mediaType,
                    'results' => $response->json(),
                ]);
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getRecommend(string $mediaType, int $id)
    {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey
            ])->get($this->baseUrl . '/' . $this->mediaTypeConvert($mediaType) . '/' . $id . '/recommendations');

            if ($response->successful()) {
                return $this->convert->getList([
                    'mediaType' => $mediaType,
                    'results' => $response->json(),
                ]);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getCredits(string $mediaType, int $id, string $endPoint = 'credits', int $page = 1, int $perPage = 20)
    {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey,
            ])->get($this->baseUrl . '/' . $this->mediaTypeConvert($mediaType) . '/' . $id . '/' . $endPoint);

            if ($response->successful()) {
                return $this->convert->getCredit([
                    'mediaType' => $mediaType,
                    'creditType' => $endPoint,
                    'perPage' => $perPage,
                    'page' => $page,
                    'results' => $response->json(),
                ]);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getImages(string $mediaType, int $id, int $perPage, int $page)
    {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey,
            ])->get($this->baseUrl . '/' . $this->mediaTypeConvert($mediaType) . '/' . $id . '/images');

            if ($response->successful()) {
                return $this->convert->getImages([
                    'mediaType' => $mediaType,
                    'results' => $response->json(),
                    'perPage' => $perPage,
                    'page' => $page,
                ]);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getEpisodes(int $series_id, int $season_number)
    {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey
            ])->get($this->baseUrl . '/tv/' . $series_id . '/season/' . $season_number);

            if ($response->successful()) {
                return $this->convert->getEpisodes(
                    $response->json(),
                );
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getCollection(string $mediaType, int $collection_id)
    {
        try {
            $response = Http::withQueryParameters([
                'api_key' => $this->apiKey
            ])->get($this->baseUrl . '/collection/' . $collection_id);

            if ($response->successful()) {
                return $this->convert->getCollection(
                    $mediaType,
                    $response->json(),
                );
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function mediaTypeConvert($mediaType) : string
    {
        $newType = '';
        switch ($mediaType) {
            case 'shows':
                $newType = 'tv';
                break;
            case 'movies':
                $newType = 'movie';
                break;
            case 'person':
                $newType = 'person';

                break;
            case 'company':
                $newType = 'company';
                break;
        }
        return $newType;
    }

    public function customUrl(string $creditType) : string
    {
        $queryParams = request()->query();
        $queryParamsWithoutPage = Arr::except($queryParams, ['credit_page']);
        $queryParamsWithoutPage['credit_type'] = $creditType;
        $modifiedUrl = url()->current() . '?' . http_build_query($queryParamsWithoutPage);

        return $modifiedUrl;
    }
}
