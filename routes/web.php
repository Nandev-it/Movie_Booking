<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PhoneLoginController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return view('welcome');
});

// Login & Register

// Route::get('/register', function () {
//     return redirect()->route('auth.dashboard', ['tab' => 'register']);
// })->name('register');
// Route::post('/user_login', [AuthController::class, 'login']);
// Route::post('/user_register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/auth/dashboard');
})->name('logout');

// Profile routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Maintenance page
Route::get('/maintenance', function () {
    return view('components.maintenance');
});

// Set language (desktop & mobile)
// Route::post('/set-language', function (Request $request) {
//     $locale = $request->locale;

//     // Save in session
//     session(['locale' => $locale]);

//     // Save in database if user is logged in
//     if (Auth::check()) {
//         Auth::user()->update(['locale' => $locale]);
//     }

//     return response()->json(['status' => 'ok']);

// });

Route::post('/set-language', function (Request $request) {
    $locale = $request->input('locale'); // ✅ was: $request->getLocale (wrong)
    $supported = ['en', 'kh', 'kr', 'jp'];

    if (!in_array($locale, $supported)) {
        $locale = 'en'; // fallback
    }

    session(['locale' => $locale]);
    App::setLocale($locale);

    // ✅ Correct way to return the full translations array
    $translations = require resource_path("lang/{$locale}/messages.php");

    return response()->json([
        'success'      => true,
        'translations' => $translations,
    ]);
});

// Get current language translations (for dynamic updates)
Route::get('/set-language-get', function (Request $request) {
    $locale = session('locale', app()->getLocale());
    $translations = require resource_path("lang/{$locale}/messages.php");

    return response()->json([
        'success'      => true,
        'locale'       => $locale,
        'translations' => $translations,
    ]);
});

// routes/web.php
Route::get('/search', [SearchController::class, 'index']);
Route::get('/movies/search', [MovieController::class, 'search']);
Route::get('/', [MovieController::class, 'index']);
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);

Route::get('/movies/filter', [MovieController::class, 'filter']);


// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/movies', function () {
        return view('admin_frontend.pages.movie');
    })->name('admin.movies');


    Route::put('/admin/movies/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');
    Route::delete('/admin/movies/{movie}', [MovieController::class, 'destroy'])->name('admin.movies.destroy');
    
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::patch('/admin/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.role');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});

Route::middleware(['auth'])->prefix('admin/profile')->name('admin.profile.')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');

    Route::get('/email', [ProfileController::class, 'editEmail'])->name('email.edit');
    Route::put('/email', [ProfileController::class, 'updateEmail'])->name('email.update');

    Route::get('/password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Debug: check if view file is resolvable
Route::get('/_debug_view_exists', function () {
    return response()->json([
        'view' => 'admin_frontend.components.layout',
        'exists' => view()->exists('admin_frontend.components.layout')
    ]);
});

Route::get('/auth/dashboard', [AuthController::class, 'authDashboard'])->name('login');
// Route::get('/auth/dashboard', [AuthController::class, 'authDashboard'])->name('auth.dashboard');
Route::post('/auth/signin', [AuthController::class, 'authSignIn']);
Route::post('/auth/signup', [AuthController::class, 'authSignUp']);
