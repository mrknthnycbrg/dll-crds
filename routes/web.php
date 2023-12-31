<?php

use App\Http\Controllers\ViewFile;
use App\Livewire\Ask\AskPage;
use App\Livewire\Downloadables\AllDownloadables;
use App\Livewire\Downloadables\ShowDownloadable;
use App\Livewire\Home\HomePage;
use App\Livewire\Posts\AllPosts;
use App\Livewire\Posts\CategoryPosts;
use App\Livewire\Posts\ShowPost;
use App\Livewire\Researches\AllResearches;
use App\Livewire\Researches\DepartmentResearches;
use App\Livewire\Researches\ShowResearch;
use App\Livewire\Welcome\WelcomePage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomePage::class)->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', HomePage::class)->name('home');
    Route::get('/news', AllPosts::class)->name('all-posts');
    Route::get('/news/{slug}', ShowPost::class)->name('show-post');
    Route::get('/news/category/{slug}', CategoryPosts::class)->name('category-posts');
    Route::get('/researches', AllResearches::class)->name('all-researches');
    Route::get('/researches/{slug}', ShowResearch::class)->name('show-research');
    Route::get('/researches/department/{slug}', DepartmentResearches::class)->name('department-researches');
    Route::get('/researches/file/{slug}', ViewFile::class)->name('view-file');
    Route::get('/resources', AllDownloadables::class)->name('all-downloadables');
    Route::get('/resources/{slug}', ShowDownloadable::class)->name('show-downloadable');
    Route::get('/ask', AskPage::class)->name('ask');
});
