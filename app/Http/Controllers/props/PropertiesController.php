<?php

namespace App\Http\Controllers\props;

use Carbon\Carbon;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\prop\Property;
use App\Models\prop\SaveProp;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Controllers\RatingController;

class PropertiesController extends Controller
{

  protected $ratingController;
  public function __construct(RatingController $ratingController)
  {
    $this->ratingController = $ratingController;
  }

  public function index()
  {
    $pageTitle = "LUWOAP| Your Premier Real Estate Destination in Ghana";
    $metaDescription = "Discover luxury units and well-organized accommodation properties in Ghana with LUWOAP, your trusted real estate partner for short-term and long-term stays.";

    // Retrieve paginated properties with their associated image count
    $props = Property::withCount('images')->orderBy('created_at', 'desc')->paginate(9);

    // Iterate through each property to calculate additional information
    foreach ($props as $prop) {
      // Calculate the number of days since creation for each property
      $prop->daysSinceCreation = $prop->created_at->diffInDays(now());
    }

    // Calculate the number of days since creation for the current date
    $daysSinceCreation = now()->diffInDays(now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('index', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'

    ));
  }

  public function allProps()
  {
    $pageTitle = "Browse LUWOAP Properties | Find Your Ideal Home in Ghana";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    // Retrieve paginated properties with their associated image count
    $props = Property::withCount('images')->orderBy('created_at', 'desc')->paginate(9);

    // Iterate through each property to calculate additional information
    foreach ($props as $prop) {
      // Calculate the number of days since creation for each property
      $prop->daysSinceCreation = $prop->created_at->diffInDays(now());
    }

    // Calculate the number of days since creation for the current date
    $daysSinceCreation = now()->diffInDays(now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('properties', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'

    ));
  }

  public function single($id)
  {
    $pageTitle =  "LUWOAP| Your Premier Real Estate Destination in Ghana";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    // Retrieve the property details with owner details and property images loaded
    $singleProp = Property::with([
      'user',
      'images',
      'ratings'
    ])->findOrFail($id);

    if (!$singleProp) {
      // Handle the case where the property is not found
      return abort(404);
    }

    // Retrieve initial comments (paginated)
    $comments = $singleProp->comments()
      ->where('status', 'approved')
      ->where('parent_id', null)
      ->withCount('replies')
      ->orderBy('created_at', 'desc')
      ->paginate(4); // Load 4 comments initially

    // Retrieve related properties (exclude the current property)
    $relatedProps = Property::where('id', '!=', $id)
      ->where('category', $singleProp->category)
      ->where('offer_type', $singleProp->offer_type)
      ->orderBy('created_at', 'desc')
      ->take(4)
      ->get();

    return view('props.single', compact(
      'singleProp',
      'relatedProps',
      'pageTitle',
      'metaDescription',
      'comments'
    ));
  }

  // Method to load more comments
  public function loadMoreComments($propertyId, $page)
  {
    try {
      Log::info("Loading more comments for property: $propertyId, page: $page");
      $property = Property::findOrFail($propertyId);

      $comments = $property->comments()
        ->where('status', 'approved')
        ->where('parent_id', null)
        ->withCount('replies')
        ->orderBy('created_at', 'desc')
        ->paginate(4, ['*'], 'page', $page); // Paginate comments

      Log::info("Comments loaded: " . $comments->count());

      return response()->json([
        'comments' => view('partials.comments', [
          'comments' => $comments,
          'singleProp' => $property // Pass the property as 'singleProp'
        ])->render(),
        'hasMorePages' => $comments->hasMorePages()
      ]);
    } catch (\Exception $e) {
      Log::error("Error loading comments: " . $e->getMessage());
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }







  public function saveProps(Request $request)
  {
    $saveProp = ([
      "prop_id" => $request->prop_id,
      "user_id" => Auth::user()->id,
    ]);

    // Check if user has already bookmarked property
    $requestExists = SaveProp::where('prop_id', $request->prop_id)
      ->where('user_id', Auth::user()->id)
      ->exists();

    if ($requestExists) {
      return back()->with('save_error', 'Property already bookmarked!');
    }
    SaveProp::Create($saveProp);

    return back()->with('save_success', 'Property bookmarked!');
  }

  public function buyProps()
  {
    $pageTitle = "LUWOAP | Properties For Sale - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('offer_type', 'sale')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }

  public function leaseProps()
  {
    $pageTitle = "LUWOAP | Lease Properties - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('offer_type', 'lease')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }

  public function rentProps()
  {
    $pageTitle = "LUWOAP | Properties For Rent - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('offer_type', 'rent')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }

  public function hostelProps()
  {
    $pageTitle = "LUWOAP | Hostel Properties - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('category', 'hostel')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }
  public function hotelProps()
  {
    $pageTitle = "LUWOAP | Hotels - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('category', 'hotel')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }

  public function airbnbProps()
  {
    $pageTitle = "LUWOAP | Air BnB - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('category', 'Air BnB')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }

  public function apartmentProps()
  {
    $pageTitle = "LUWOAP | Apartments - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('category', 'apartment')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }
  public function officeProps()
  {
    $pageTitle = "LUWOAP | Office Spaces - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('category', 'office space')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }

  public function luxuryProps()
  {
    $pageTitle = "LUWOAP | Luxury Properties - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('category', 'luxury apartment')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }
  public function houseProps()
  {
    $pageTitle = "LUWOAP | Houses - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('category', 'house')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }
  public function guestProps()
  {
    $pageTitle = "LUWOAP | Guest Houses - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";

    $props = Property::select()
      ->where('category', 'guest house')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }
  public function commercialProps()
  {
    $pageTitle = "LUWOAP | Commercial Properties - Real Estate Destination";
    $metaDescription = "Explore LUWOAP’s diverse range of properties in Ghana, offering luxury units and organized accommodations for both short-term stays and long-term investments.";
    $props = Property::select()
      ->where('category', 'commercial space')
      ->take(9)->orderBy('created_at', 'desc')
      ->paginate(9);

    // Calculate the number of days since creation for each property
    foreach ($props as $prop) {
      $prop->daysSinceCreation = Carbon::parse($prop->created_at)->diffInDays(Carbon::now());
    }

    $daysSinceCreation = Carbon::now()->diffInDays(Carbon::now());

    // Extract pagination information
    $totalItems = $props->total();
    $firstItem = $props->firstItem();
    $lastItem = $props->lastItem();

    return view('props/prop-category', compact(
      'props',
      'daysSinceCreation',
      'totalItems',
      'firstItem',
      'lastItem',
      'pageTitle',
      'metaDescription'
    ));
  }


  //Search Bar
  public function searchBar(Request $request)
  {
    // Get the search parameters from the request
    $offerType = $request->input('offer_type');
    $category = $request->input('category');
    $bed = $request->input('bed');
    $bath = $request->input('bath');

    // Query properties based on the search parameters
    $properties = Property::query();

    // Filter by offer type
    if ($offerType) {
      $properties->where('offer_type', $offerType);
    }

    // Filter by category
    if ($category) {
      $properties->where('category', $category);
    }

    // Filter by number of bedrooms
    if ($bed) {
      $properties->where('bed', $bed);
    }

    // Filter by number of bathrooms
    if ($bath) {
      $properties->where('bath', $bath);
    }

    // Get the filtered properties
    $filteredProperties = $properties->paginate(9);
    // dd($filteredProperties);
    // You can pass the filtered properties to a view to display the results
    return view('props/search_results', compact('filteredProperties'));
  }


  // Add new Property Comment
  public function commentStore(Request $request)
  {
    $validatedData = $request->validate([
      'user_id' => 'required|exists:users,id',
      'prop_id' => 'required|exists:props,id',
      'comment' => 'required|string|max:1000',
    ]);

    $validatedData['status'] = 'pending';

    try {
      Comment::create($validatedData);
      return response()->json(['success' => true, 'message' => 'Comment submitted successfully, pending approval!']);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => 'An error occurred. Try again later.']);
    }
  }

  // Add new Property Comment reply
  public function replyStore(Request $request)
  {
    $validatedData = $request->validate([
      'user_id' => 'required|exists:users,id',
      'prop_id' => 'required|exists:props,id',
      'comment' => 'required|string|max:1000',
      'parent_id' => 'required|string|max:1000',
    ]);

    $validatedData['status'] = 'pending';

    try {
      Comment::create($validatedData);
      return response()->json(['success' => true, 'message' => 'Comment submitted successfully, pending approval!']);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => 'An error occurred. Try again later.']);
    }
  }


  // Update Property Comment Status
  public function commentUpdateStatus(Request $request, $id)
  {
    $validatedData = $request->validate([
      'status' => 'required|in:pending,approved'
    ]);

    try {
      $comment = Comment::findOrFail($id);
      $comment->status = $validatedData['status'];
      $comment->save();

      return response()->json(['success' => true, 'message' => 'Comment status updated successfully!']);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      return response()->json(['error' => true, 'message' => 'Comment not found.']);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => 'An error occurred. Try again later.']);
    }
  }

  // Delete Property Comment
  public function commentDestroy($id)
  {
    try {
      $comment = Comment::findOrFail($id);
      $comment->delete();

      return response()->json(['success' => true, 'message' => 'Comment deleted successfully!']);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      return response()->json(['error' => true, 'message' => 'Comment not found.']);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => 'An error occurred. Try again later.']);
    }
  }
}
