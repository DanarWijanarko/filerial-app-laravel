<?php

namespace App\Http\Controllers\Main;

use App\Models\Collection\Collection;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Requests\Profile\PasswordUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $username)
    {
        $mediaType = $request->input('media_type', 'shows');

        // get Authenticated User
        $user = User::all()->where('username', $username)->first();

        // Get All Users
        $users = User::all()->except($user->id)->whereNotNull('username');

        // $results = Favorite::where('user_id', $user->id)->where('data->mediaType', $mediaType)->orderByDesc('created_at')->paginate(5)->withQueryString();

        $results = $user->favorite()->where('data->mediaType', $mediaType)->orderByDesc('created_at')->paginate(5)->withQueryString();

        return view("pages.main.profile.index", [
            'type' => $mediaType,
            'user' => $user,
            'users' => $users,
            'results' => $results,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.main.profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the Account Details in storage.
     */
    public function update(UpdateRequest $request)
    {
        $request->validated();

        User::where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'social' => $request->social,
        ]);

        return back()->with('status', (object) [
            'type' => 'success',
            'message' => 'Details has been Updated!',
        ]);
    }

    /**
     * Update the user's Images.
     */
    public function updateImages(Request $request)
    {
        if (!$request->exists('profile_picture') && !$request->exists('backdrop_picture')) {
            return back()->with('status', (object) [
                'type' => 'error',
                'message' => ($request->oldProfileImg === null || $request->oldBackdropImg === null) ? 'No Images Included!' : 'No Images have been Replaced!',
            ]);
        }

        if (Auth::user()->backdrop || Auth::user()->picture) {
            $isImgExist = 0;
        } else {
            $isImgExist = 1;
        }

        $validated = $request->validate([
            'profile_picture' => ['image', Rule::requiredIf($isImgExist), File::image()->max(1024)],
            'backdrop_picture' => ['image', Rule::requiredIf($isImgExist), File::image()->max(1024)],
        ]);

        if ($request->file('profile_picture')) {
            if ($request->oldProfileImg) {
                Storage::delete($request->oldProfileImg);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures');
        }

        if ($request->file('backdrop_picture')) {
            if ($request->oldBackdropImg) {
                Storage::delete($request->oldBackdropImg);
            }
            $validated['backdrop_picture'] = $request->file('backdrop_picture')->store('backdrop_pictures');
        }

        User::where('id', Auth::user()->id)->update([
            'picture' => $validated['profile_picture'] ?? $request->oldProfileImg,
            'backdrop' => $validated['backdrop_picture'] ?? $request->oldBackdropImg,
        ]);

        return back()->with('status', (object) [
            'type' => 'success',
            'message' => 'Account Images Updated Successfully!',
        ]);
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        $request->validated();

        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', (object) [
            'type' => 'success',
            'message' => 'Password has been Updated!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'passwordDelete' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $user->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('main.home');
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
