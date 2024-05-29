<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\props\PropertyManagerController;

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

//Sort by Category=Hostel
Route::get('props/category/hostel', [App\Http\Controllers\props\PropertiesController::class, 'hostelProps'])->name('hostel.prop');

//Sort by Category=Air BnB
Route::get('props/category/airbnb', [App\Http\Controllers\props\PropertiesController::class, 'AirbnbProps'])->name('airbnb.prop');

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
    Route::post('/ratings', [RatingController::class, 'addRatings']);
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

    //Create a Property View
    Route::get('/submit-property', function () {
        return view('partials.submit-property');
    });
    //Create a Property

    //Show Requests from clients view
    Route::get('/incoming-requests', [RequestController::class, 'allRequests'])->name('all.requests');

    // Manage Incoming Client Request

    //Show Booking from page
    Route::get('/bookings', function () {
        return view('partials.bookings');
    });

    //Displaying property for auth user
    Route::get('/manage-properties', [PropertyManagerController::class, 'manageProperties'])->name('manage.prop');

    Route::get('/user/bookmark-property', function () {
        return view('partials.bookmark-property');
    });

    // Creat a Property
    Route::post('/property/create', [PropertyManagerController::class, 'addProperty'])->name('property.create');

    // Publish a blog
    Route::post('/publish-post', [BlogController::class, 'createPost'])->name('post.create');

    // Show Creat a blog form
    Route::get('/create-post', function () {
        return view('partials.create-post');
    });

    // Show All blogs to be managed
    Route::get('/all-posts', [BlogController::class, 'allPosts'])->name('post.all');

    Route::get('/post/{id}/edit', [BlogController::class, 'editPostView'])->name('post.edit');

    Route::put('/post/{id}', [BlogController::class, 'updatePost'])->name('post.update');

    //Delete a Post/Blog
    Route::delete('/blog/{id}', [BlogController::class, 'deletePost'])->name('blog.delete');
});
//****************** End ******************//


//inserting  request for callback
Route::post('props/prop-details/{id}', [RequestController::class, 'insertRequests'])->name('insert.request');

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
