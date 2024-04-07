<?php

namespace App\Http\Controllers\Main;

use App\Models\Favorite;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mediaType = $request->input('media_type', 'shows');

        $results = Favorite::where('user_id', auth()->user()->id)->where('data->mediaType', $mediaType)->orderByDesc('created_at')->paginate(5)->withQueryString();

        return view("pages.main.profile.index", [
            'type' => $mediaType,
            'results' => $results,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function favDestroy(string $id)
    {
        $data = Favorite::where('id', $id)->first();

        if ($data->exists()) {
            Favorite::destroy($id);
            return back()->with('status', (object) [
                'type' => 'success',
                'message' => $data->data['name'] . ', Successfully Deleted from My Favorite!',
            ]);
        }

        return back()->with('status', (object) [
            'type' => 'error',
            'message' => 'Data not Exist in My Favorite!',
        ]);
    }
}
