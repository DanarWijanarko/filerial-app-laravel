<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\ShowController;
use App\Http\Controllers\Main\MovieController;
use App\Http\Controllers\Main\PersonController;
use App\Http\Controllers\Main\SearchController;
use App\Http\Controllers\Main\ExploreController;
use App\Http\Controllers\Main\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware(["myGuest"])->group(function () {
    // ? Handle Login
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'create')->name('auth.login');
        Route::post('/login', 'store')->name('auth.doLogin');
    });

    // ? Handle Register
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'create')->name('auth.register');
        Route::post('/register', 'store')->name('auth.doRegister');
    });
});

Route::middleware(['myAuth', 'admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
    });
});

Route::middleware(['myAuth'])->group(function () {
    // ? Home Controller
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('main.home');
    });

    // ? Profile Controller
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{username}', 'index')->name('user.index');
        Route::get('/profile/{user}/edit', 'edit')->name('user.edit');
        Route::put('/profile/update/details', 'update')->name('user.update');
        Route::put('/profile/update/images', 'updateImages')->name('user.update.images');
        Route::put('/profile/update/password', 'updatePassword')->name('user.update.password');
        Route::delete('/profile/delete', 'destroy')->name('user.destroy');
        Route::delete('/profile/favorite/{id}/delete', 'favDestroy')->name('user.favDestroy');
    });

    // ? Search Controller
    Route::controller(SearchController::class)->group(function () {
        Route::get("/search", "index")->name("search.index");
        Route::get("/search/q", "search")->name("search.query");
        Route::delete("/search/q/delete", "historyDelete")->name("search.delete");
    });

    // ? Show Controller
    Route::controller(ShowController::class)->group(function () {
        Route::get("/shows", "index")->name("shows.index");
        Route::post("/shows/filters", "filter")->name("shows.filter"); // ! Working
        Route::get("/shows/{name}/detail", "detail")->name("shows.detail");
        Route::post("/shows/addFavorite", "store")->name("shows.store");
    });

    // ? Movie Controller
    Route::controller(MovieController::class)->group(function () {
        Route::get("/movies", "index")->name("movies.index");
        Route::get("/movies/{name}/detail", "detail")->name("movies.detail");
        Route::post("/movies/addFavorite", "store")->name('movies.store');
    });

    // ? Person Controller
    Route::controller(PersonController::class)->group(function () {
        Route::get("/person/{name}/detail", "detail")->name("person.detail");
        Route::post('/person/addFavorite', 'store')->name('person.store');
    });

    // ? Explore Controller
    Route::controller(ExploreController::class)->group(function () {
        Route::get("/explores/{to}/{name}/q", "index")->name("explore");
    });

    // ? Handle Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('auth.logout');
});
