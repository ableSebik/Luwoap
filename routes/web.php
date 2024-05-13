<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;

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

// Homepage
Route::get('/', [App\Http\Controllers\props\PropertiesController::class, 'index'])->name('index');


//Search Bar
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

//**********Sorting Property by Type **********//

//Sort by type=buy
Route::get('props/offer_type/for-sale', [App\Http\Controllers\props\PropertiesController::class, 'buyProps'])->name('buy.prop');

//Sort by type=rent
Route::get('props/offer_type/rent', [App\Http\Controllers\props\PropertiesController::class, 'rentProps'])->name('rent.prop');

//Sort by type=lease
Route::get('props/offer_type/lease', [App\Http\Controllers\props\PropertiesController::class, 'leaseProps'])->name('lease.prop');

//********** End Sorting by Type **********//




//********** Nav Pages **********//

Route::get('/about', function () {
    return view('about');
});

//Show all Posts
Route::get('/all-properties', [App\Http\Controllers\props\PropertiesController::class, 'allProps'])->name('all-properties');

//Show all Posts
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'blogPosts'])->name('blogPosts');

// show Post Details/
Route::get('blog/{id}', [App\Http\Controllers\BlogController::class, 'postDetails'])->name('postDetails.blog');

//Find Related Posts by Tags
Route::get('/posts/tag/{tag}', [App\Http\Controllers\BlogController::class, 'postsByTag'])->name('posts.byTag');

//Newsletter subscription
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');

//********** End Nav Pages **********//



//Saving property/bookmarking property
Route::post('props/save-props/{id}', [App\Http\Controllers\props\PropertiesController::class, 'saveProps'])->name('save.prop');


//********** Auth Role="null" (non-admin) **********//

Route::middleware(['auth'])->group(function () {
    Route::get('/user-profile', function () {
        return view('partials.profile');
    });
});
//********** End **********//





//********** Routes for only 'admin' users **********//
Route::middleware(['auth', 'admin'])->group(function () {

    //show Edit Property view
    Route::get('/property/{prop}/edit', [App\Http\Controllers\props\PropertyManagerController::class, 'edit'])->name('edit.prop');

    //Update Property 
    Route::match(['put', 'patch'], '/property/{prop}', [App\Http\Controllers\props\PropertyManagerController::class, 'updateProperty'])->name('update.prop');

    //Delete a Property
    Route::delete('/property/{prop}', [App\Http\Controllers\props\PropertyManagerController::class, 'deleteProperty'])->name('properties.delete');

    //Create a Property
    Route::get('/submit-property', function () {
        return view('partials.submit-property');
    });
    //Create a Property

    //Show Requests from clients
    Route::get('/incoming-requests', function () {
        return view('partials.incoming-requests');
    });

    //Show Booking from page
    Route::get('/bookings', function () {
        return view('partials.bookings');
    });

    //Displaying property for auth user
    Route::get('/manage-properties', [App\Http\Controllers\props\PropertyManagerController::class, 'manageProperties'])->name('manage.prop');

    Route::get('/user/bookmark-property', function () {
        return view('partials.bookmark-property');
    });

    // Creat a Property
    Route::post('/property/create', [App\Http\Controllers\props\PropertyManagerController::class, 'addProperty'])->name('property.create');

    // Publish a blog
    Route::post('/publish-post', [App\Http\Controllers\BlogController::class, 'createPost'])->name('post.create');

    // Show Creat a blog form
    Route::get('/create-post', function () {
        return view('partials.create-post');
    });
});
//****************** End ******************//


//inserting  request for callback
Route::post('props/prop-details/{id}', [App\Http\Controllers\props\PropertiesController::class, 'insertRequests'])->name('insert.request');

//Saving property/bookmarking property
Route::post('props/save-props/{id}', [App\Http\Controllers\props\PropertiesController::class, 'saveProps'])->name('save.prop');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//show single property
Route::get('props/prop-details/{id}', [App\Http\Controllers\props\PropertiesController::class, 'single'])->name('single.prop');


require __DIR__ . '/auth.php';
