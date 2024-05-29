<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\prop\Property;

class RatingController extends Controller
{
  public function addRatings(Request $request)
  {
    $validatedData = $request->validate([
      'prop_id' => 'required|exists:props,id',
      'user_id' => 'required|exists:users,id',
      'rating_val' => 'required|integer|min:1|max:5',
    ]);

    //Check if user has already rated this property
    $ratingsExists = Rating::where('prop_id', $request->prop_id)
      ->where('user_id', $request->user_id)
      ->exists();

    if ($ratingsExists) {
      //update current ratings
      $ratingsExists->update(['rating_val' => $request->rating_val]);
      return response()->json(['success' => 'Your feedback has been updated']);
    } else {
      // Create a new Rating instance
      Rating::create($validatedData);
      return response()->json(['success' => 'Thank you for your feedback.']);
    }
  }

  /**
   * Display the average rating for a property.
   */
  public function propertyRatings($prop_id)
  {
    $property = Property::with('ratings')->findOrFail($prop_id);

    $averageRating = $property->ratings->avg('rating_val');

    $propRatingData = [
      'average_rating' => $averageRating,
      'ratings_count' => $property->ratings->count(),
    ];

    return $propRatingData;
  }
}
