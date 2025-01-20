<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\props\PropertiesController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\props\PropertyManagerController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

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



//**********Sorting Property by Category **********//

//Sort by type=buy
Route::get('props/offer_type/for-sale', [App\Http\Controllers\props\PropertiesController::class, 'buyProps'])->name('buy.prop');

//Sort by type=rent
Route::get('props/offer_type/rent', [App\Http\Controllers\props\PropertiesController::class, 'rentProps'])->name('rent.prop');

//Sort by type=lease
Route::get('props/offer_type/lease', [App\Http\Controllers\props\PropertiesController::class, 'leaseProps'])->name('lease.prop');

//Sort by Category=Hostel
Route::get('props/category/hostel', [App\Http\Controllers\props\PropertiesController::class, 'hostelProps'])->name('hostel.prop');

//Sort by Category=Hotel
Route::get('props/category/hotel', [App\Http\Controllers\props\PropertiesController::class, 'hotelProps'])->name('hotel.prop');

//Sort by Category=Air BnB
Route::get('props/category/airbnb', [App\Http\Controllers\props\PropertiesController::class, 'airbnbProps'])->name('airbnb.prop');

//Sort by Category=Apartment
Route::get('props/category/apartment', [App\Http\Controllers\props\PropertiesController::class, 'apartmentProps'])->name('apartment.prop');

//Sort by Category=Office Space
Route::get('props/category/office-space', [App\Http\Controllers\props\PropertiesController::class, 'officeProps'])->name('office.prop');

//Sort by Category=Luxury Property
Route::get('props/category/luxury-apartment', [App\Http\Controllers\props\PropertiesController::class, 'luxuryProps'])->name('luxury.prop');

//Sort by Category=Guest House
Route::get('props/category/guest-house', [App\Http\Controllers\props\PropertiesController::class, 'guestProps'])->name('guest.prop');

//Sort by Category=House
Route::get('props/category/house', [App\Http\Controllers\props\PropertiesController::class, 'houseProps'])->name('house.prop');

//Sort by Category=Commercial Property
Route::get('props/category/commercial-property', [App\Http\Controllers\props\PropertiesController::class, 'commercialProps'])->name('commercial.prop');

//********** End Sorting by Type **********//



//Load/show all Comment replies
Route::get('/comments/{id}/replies', [CommentsController::class, 'getReplies']);


//********** Nav Pages **********//

Route::get('/about', function () {
    $pageTitle = "Our Story | LUWOAP: Excellence in Real Estate and Accommodation";
    $metaDescription = "Learn about LUWOAP, your trusted real estate partner in Ghana. Since 2021, we've been providing luxury units and well-organized accommodation properties.";

    return view('about', compact(
        'pageTitle',
        'metaDescription'
    ));
});
Route::get('/contact', function () {
    $pageTitle = "Contact LUWOAP | Get in Touch for Luxury Real Estate Solutions";
    $metaDescription = "Contact LUWOAP, your trusted real estate partner in Ghana, for luxury units and well-organized accommodation properties for short-term and long-term stays.";

    return view('contact', compact(
        'pageTitle',
        'metaDescription'
    ));
})->name('contact');



//Show all Posts
Route::get('/properties', [App\Http\Controllers\props\PropertiesController::class, 'allProps'])->name('all-properties');

//Show all Posts
Route::get('blog', [App\Http\Controllers\BlogController::class, 'blogPosts'])->name('blogPosts');

// show Post Details/
Route::get('blog/{slug}', [App\Http\Controllers\BlogController::class, 'postDetails'])->name('postDetails.blog');

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

    //Submit Property Comment
    Route::post('/comments', [CommentsController::class, 'commentStore'])->name('comments.store');
    //Submit Comment reply
    Route::post('/reply', [CommentsController::class, 'replyStore'])->name('reply.store');
});
//********** End **********//





//********** Routes for only 'admin' users **********//
Route::middleware(['auth', 'admin'])->group(function () {

    //show Edit Property view
    Route::get('/property/{prop}/edit', [PropertyManagerController::class, 'edit'])->name('edit.prop');

    //Update Property 
    Route::match(['put', 'patch'], '/property/{prop}', [PropertyManagerController::class, 'updateProperty'])->name('update.prop');

    //change Property status (hide/live)
    Route::put('/property/{prop}/status', [PropertyManagerController::class, 'updateStatus'])->name('property.updateStatus');

    //Delete a Property
    Route::delete('/property/{prop}', [PropertyManagerController::class, 'deleteProperty'])->name('properties.delete');

    //change Comment status (Approved/Pending)
    Route::put('/comment/{prop}/status', [CommentsController::class, 'updateCommentStatus'])->name('comment.updateStatus');

    //Create a Property View
    Route::get('/submit-property', function () {
        return view('partials.submit-property');
    });

    //Delete a Comment
    Route::delete('/comment/{comment}/delete', [CommentsController::class, 'deleteComment'])->name('comment.delete');

    //Show Requests from clients view
    Route::get('/incoming-requests', [RequestController::class, 'allRequests'])->name('all.requests');

    //Show All Comments from clients view
    Route::get('/all-comments', [CommentsController::class, 'allComments'])->name('all.comments');


    // Manage Incoming Client Request
    Route::post('/requests/{id}/status', [RequestController::class, 'updateRequestStatus'])->name('requests.updateStatus');

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
Route::post('props/insert-request', [RequestController::class, 'insertRequests'])->name('insert.request');


//Saving property/bookmarking property
Route::post('props/save-props/{id}', [App\Http\Controllers\props\PropertiesController::class, 'saveProps'])->name('save.prop');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Email verification routes
Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Load more comments
Route::get('/property/{propertyId}/comments/{page}', [App\Http\Controllers\props\PropertiesController::class, 'loadMoreComments'])->name('property.loadMoreComments');

// Show single property (new route)
Route::get('props/prop-details/{slug}', [App\Http\Controllers\props\PropertiesController::class, 'single'])->name('single.prop');

// Show single property (redirect to new route)
Route::get('props/details/{id}', [App\Http\Controllers\props\PropertiesController::class, 'redirectToSlug'])->name('single-old.prop');


require __DIR__ . '/auth.php';
