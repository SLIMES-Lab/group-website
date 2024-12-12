<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\CollaboratorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvitationCodeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ResearchController;
use App\Http\Controllers\Admin\ResearchPositionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\FrontAboutController;
use App\Http\Controllers\Frontend\FrontContactController;
use App\Http\Controllers\Frontend\FrontGroupController;
use App\Http\Controllers\Frontend\FrontHomeController;
use App\Http\Controllers\Frontend\FrontPostController;
use App\Http\Controllers\Frontend\FrontPublicationController;
use App\Http\Controllers\Frontend\FrontResearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPostController;
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


Route::get('/logout', [DashboardController::class, 'logout'])->name('logout2');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    // Post
    Route::get('/posts', [UserPostController::class, 'index'])->name('user.posts');
    Route::get('/add-post', [UserPostController::class, 'create']);
    Route::post('/add-post', [UserPostController::class, 'store'])->name('add-post');
    Route::get('edit-post/{post_id}', [UserPostController::class, 'edit']);
    Route::put('update-post/{post_id}', [UserPostController::class, 'update'])->name('update-post');
    Route::get('delete-post/{post_id}', [UserPostController::class, 'destroy']);
});

// User..
Route::get('/', [FrontHomeController::class, 'index']);
Route::get('/about', [FrontAboutController::class, 'index']);
Route::get('/research', [FrontResearchController::class, 'index']);
Route::get('/publications', [FrontPublicationController::class, 'index']);
Route::get('/contact', [FrontContactController::class, 'index']);
// Group section
Route::get('/members/current', [FrontGroupController::class, 'showCurrentMembers']);
Route::get('/members/alumni', [FrontGroupController::class, 'showAlumni']);
Route::get('/members/current/{user_id}', [FrontGroupController::class, 'showSingleUser']);
Route::get('/members/collaborators', [FrontGroupController::class, 'showCollaborators']);
Route::get('/members/collaborators/{collaborator_id}', [FrontGroupController::class, 'showSingleCollaborator']);
Route::get('/members/alumni/{alumni_id}', [FrontGroupController::class, 'showSingleAlumni']);
Route::get('/open-positions', [FrontGroupController::class, 'showOpenPositions']);
Route::get('/gallery', [FrontGroupController::class, 'showAllAlbums']);
Route::get('/album/{album_id}', [FrontGroupController::class, 'showSingleAlbum']);
// Blog section
Route::get('/news', [FrontPostController::class, 'index']);
Route::get('/news/search', [FrontPostController::class, 'search'])->name('search');
Route::get('/news/{post_id}', [FrontPostController::class, 'showSinglePost']);
Route::get('news/category/{category_id}', [FrontPostController::class, 'showPostsByCategory']);

// Admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->namespace('Admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Creating Invitation Code
    Route::get('/invitation-codes/create', [InvitationCodeController::class, 'create'])->name('admin.invitation-codes.create');
    Route::post('/invitation-codes', [InvitationCodeController::class, 'store'])->name('admin.invitation-codes.store');

    // Post
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/add-post', [PostController::class, 'create']);
    Route::post('/add-post', [PostController::class, 'store'])->name('add-post');
    Route::get('edit-post/{post_id}', [PostController::class, 'edit']);
    Route::put('update-post/{post_id}', [PostController::class, 'update'])->name('update-post');
    Route::get('delete-post/{post_id}', [PostController::class, 'destroy']);

    // Pages
    Route::prefix('pages')->group(function () {
        Route::get('/home/{id}', [HomeController::class, 'index'])->name('pages.home');
        Route::post('/home/update', [HomeController::class, 'update']);
        Route::get('/about/{id}', [AboutController::class, 'index'])->name('pages.about');
        Route::post('/about/update', [AboutController::class, 'update']);

        // Research Page
        Route::prefix('research-areas')->group(function () {
            Route::get('/', [ResearchController::class, 'index'])->name('pages.research-areas');
            Route::get('/add-area', [ResearchController::class, 'create'])->name('pages.add-research-area');
            Route::post('/add-area', [ResearchController::class, 'store'])->name('add-area');
            Route::get('/edit-area/{post_id}', [ResearchController::class, 'edit']);
            Route::put('/update-area/{area_id}', [ResearchController::class, 'update'])->name('update-area');
            Route::get('/delete-area/{area_id}', [ResearchController::class, 'destroy']);
        });
    });

    // Group
    Route::prefix('group')->group(function () {
        // Members
        Route::prefix('members')->group(function () {
            // Current Members
            Route::get('/current', [UserController::class, 'index'])->name('group.members');
            Route::get('/current/delete-member/{user_id}', [UserController::class, 'destroy']);
            Route::get('/current/make-alumni/{user_id}', [UserController::class, 'make_alumni']);
            Route::get('/current/make-current/{user_id}', [UserController::class, 'make_current']);
            Route::get('/current/add-admin/{user_id}', [UserController::class, 'add_admin']);
            Route::get('/current/remove-admin/{user_id}', [UserController::class, 'remove_admin']);
            // Alumni
            Route::get('/alumni', [AlumniController::class, 'index'])->name('group.members.alumni');
            Route::get('/add-alumni', [AlumniController::class, 'create']);
            Route::post('/add-alumni', [AlumniController::class, 'store'])->name('add-alumni');
            Route::get('/edit-alumni/{alumni_id}', [AlumniController::class, 'edit']);
            Route::put('/update-alumni/{alumni_id}', [AlumniController::class, 'update']);
            Route::get('/delete-alumni/{alumni_id}', [AlumniController::class, 'destroy']);
            // Collaborators
            Route::get('/collaborators', [CollaboratorController::class, 'index'])->name('group.members.collaborators');
            Route::get('/add-collaborator', [CollaboratorController::class, 'create']);
            Route::post('/add-collaborator', [CollaboratorController::class, 'store'])->name('add-collaborator');
            Route::get('/edit-collaborator/{collaborator_id}', [CollaboratorController::class, 'edit']);
            Route::put('/update-collaborator/{collaborator_id}', [CollaboratorController::class, 'update']);
            Route::get('/delete-collaborator/{collaborator_id}', [CollaboratorController::class, 'destroy']);
        });
        // Vacant Research Positions
        Route::get('/positions', [ResearchPositionController::class, 'index'])->name('group.positions');
        Route::get('/add-position', [ResearchPositionController::class, 'create']);
        Route::post('/add-position', [ResearchPositionController::class, 'store'])->name('add-position');
        Route::get('/edit-position/{position_id}', [ResearchPositionController::class, 'edit']);
        Route::put('/update-position/{position_id}', [ResearchPositionController::class, 'update']);
        Route::get('/delete-position/{position_id}', [ResearchPositionController::class, 'destroy']);
        // Gallery/Album
        Route::get('/all-album', [AlbumController::class, 'index'])->name('group.photos');
        Route::get('/add-album', [AlbumController::class, 'create']);
        Route::post('/add-album', [AlbumController::class, 'store']);
        Route::get('/view-album/{album_id}', [AlbumController::class, 'viewAlbum'])->name('albums.view');
        Route::get('edit-album/{album_id}', [AlbumController::class, 'edit']);
        Route::post('delete-single-image/{image_id}', [AlbumController::class, 'deleteSingleImage']);
        Route::put('update-album/{album_id}', [AlbumController::class, 'update']);
        Route::get('delete-album/{album_id}', [AlbumController::class, 'destroy']);
    });
});

// Middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
