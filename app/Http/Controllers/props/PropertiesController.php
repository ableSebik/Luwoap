<?php

namespace App\Http\Controllers\props;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\prop\Property;
use App\Models\prop\SaveProp;
use App\Models\Comments;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Auth;

class PropertiesController extends Controller
{

  protected $ratingController;
  public function __construct(RatingController $ratingController)
  {
    $this->ratingController = $ratingController;
  }

  public function index()
  {
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

    ));
  }

  public function allProps()
  {
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

    ));
  }

  public function single($id)
  {

    // Retrieve the property details with owner details and property images loaded
    $singleProp = Property::with(['user', 'images', 'ratings', 'comments'])->findOrFail($id);

    if (!$singleProp) {
      // Handle the case where the property is not found
      return abort(404);
    }

    // Retrieve related properties (exclude the current property)
    $relatedProps = Property::where('id', '!=', $id)
      ->where('category', $singleProp->category)
      ->where('offer_type', $singleProp->offer_type)
      ->orderBy('created_at', 'desc')
      ->take(4)
      ->get();





    return view('props.single', compact('singleProp', 'relatedProps'));
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }

  public function leaseProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }

  public function rentProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }

  public function hostelProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }

  public function airbnbProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }

  public function apartmentProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }
  public function officeProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }

  public function luxuryProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }
  public function houseProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }
  public function guestProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
  }
  public function commercialProps()
  {
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

    return view('props/prop-category', compact('props', 'daysSinceCreation', 'totalItems', 'firstItem', 'lastItem'));
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


  //Add new Property Comment
  public function commentStore(Request $request)
  { {
      $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'prop_id' => 'required|exists:props,id',
        'comment' => 'required|string|max:1000',
      ]);

      $validatedData['status'] = 'pending';

      try {
        Comments::create($validatedData);
        return response()->json(['success' => true, 'message' => 'Comment submitted successfully, pending approval!']);
      } catch (\Exception $e) {
        return response()->json(['error' => true, 'message' => 'An error occured. Try again later.']);
      }
    }
  }
  //Update Property Comment Status
  //Delete Property Comment


}
