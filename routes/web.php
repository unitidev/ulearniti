<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Livewire\Unimooc\Index::class)
->name('home');

Route::get('/welcome', function(){
    return view('welcome');
})
->name('welcome');

Route::get('/course/{courseId}', \App\Http\Livewire\Unimooc\Course\CoursePreview::class)
->name('course-preview');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('verified');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    
    $request->user()->sendEmailVerificationNotification();

    return redirect('/register/flow');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/login', \App\Http\Livewire\Auth\Login::class)
    ->name('login');

Route::get('/register', \App\Http\Livewire\Auth\Register::class)
->name('register');
    
Route::get('/register/flow', \App\Http\Livewire\Auth\RegisterFlow::class)
->name('register-flow');

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', [SocialiteController::class, 'google']);

Route::middleware(['auth:sanctum', 'verified'])->get('/instructor/course/create/{page}/{courseId}', \App\Http\Livewire\Instructor\Course\Create::class)
    ->name('course-create');

Route::middleware(['auth:sanctum', 'verified'])->get('/instructor/become-instructor', \App\Http\Livewire\Instructor\BecomeInstructor::class)
    ->name('become-instructor');

Route::middleware(['auth:sanctum', 'verified'])->get('/instructor/courses', \App\Http\Livewire\Instructor\Courses::class)
    ->name('courses');

Route::get('/admin', function(){
        return redirect('/admin/analytics/lol');
    })
    ->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/analytics/{page}', \App\Http\Livewire\Admin\Analytics::class)
    ->name('analytics');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/users/{page}', \App\Http\Livewire\Admin\Users::class)
    ->name('users');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/courses/{page}', \App\Http\Livewire\Admin\Courses::class)
    ->name('courses');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/finances/{page}', \App\Http\Livewire\Admin\Finances::class)
    ->name('finances');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/search/{page}', \App\Http\Livewire\Admin\Search::class)
    ->name('search');

Route::middleware(['auth:sanctum', 'verified'])->get('/{username}', \App\Http\Livewire\User\Profile::class)
    ->name('profile');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile/edit', \App\Http\Livewire\User\EditProfile::class)
    ->name('edit-profile');

Route::middleware(['auth:sanctum', 'verified'])->get('/user/settings/{page}', \App\Http\Livewire\User\Setting::class)
    ->name('setting');

Route::middleware(['auth:sanctum', 'verified'])->get('/user/courses/enrolled-courses', \App\Http\Livewire\User\Course\EnrollCourses::class)
    ->name('setting');