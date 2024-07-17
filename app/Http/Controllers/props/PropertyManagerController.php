<?php

namespace App\Http\Controllers\props;

use Illuminate\Http\Request;
use App\Models\prop\Property;
use App\Models\prop\PropImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PropertyManagerController extends Controller
{
  // Create new Property
  public function addProperty(Request $request)
  {
    // dd($request->all());
    // Validate the incoming request data
    $validatedData = $request->validate([
      'title' => 'required|string|max:255',
      'offer_type' => 'required|string|in:sale,rent,lease',
      'price' => 'nullable|string|max:255',
      'price_range' => 'nullable|string|max:255',
      'period' => 'nullable|string|max:255',
      'currency' => 'required|string|in:GHC,$',
      'location' => 'required|string|max:255',
      'bed' => 'required|integer|min:1',
      'bath' => 'required|integer|min:1',
      'sqm' => 'nullable',
      'category' => 'required|string|max:255',
      'ft_image' => 'image|mimes:jpeg,png,jpg|max:20000',
      'more_info' => 'required|string',
      'amenities' => 'nullable|array',
      // Add more validation rules as needed
    ]);

    //append the amenities csv to the validated data.
    $amenitiesArr = $request->input('amenities', []);
    $amenities = implode(',', $amenitiesArr);
    $validatedData['amenities'] = $amenities;

    // Add authenticated user's ID as user_id
    $validatedData['user_id'] = auth()->user()->id;

    //Add status of the property
    $validatedData['status'] = 'live';

    // Handle file upload for feature image
    $ftImageFileName = $this->uploadFeatureImage($request);
    $validatedData['ft_image'] = $ftImageFileName;

    // Create a new property instance
    $property = Property::create($validatedData);

    // Validate the incoming request data for the gallery images
    $request->validate([
      'image' => 'required|array|min:1', // Ensure 'image' is an array and contains at least one file
      'image.*' => 'image|mimes:jpeg,png,jpg|max:20000', // Validation rules for each image in the array
    ]);

    // Handle file uploads for gallery images
    $this->uploadGalleryImages($request, $property);

    // Redirect back with success message or handle response as needed
    return redirect('props/prop-details/' . $property->id,)->with('success', 'Property added successfully.');
  }

  // Separate method to handle feature image upload
  private function uploadFeatureImage(Request $request, Property $property = null)
  {
    if ($request->hasFile('ft_image')) {
      // Delete old feature image if it exists
      if ($property && $property->ft_image) {
        Storage::delete('public/uploads/ft_images/' . $property->ft_image);
      }

      $propertyDirectory = 'public/uploads/ft_images';
      if (!Storage::exists($propertyDirectory)) {
        Storage::makeDirectory($propertyDirectory);
      }
      $file = $request->file('ft_image');
      $fileName = sha1(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
      $file->storeAs($propertyDirectory, $fileName);
      return $fileName;
    }
    return null;
  }

  // Separate method to handle gallery images upload
  private function uploadGalleryImages(Request $request, Property $prop)
  {
    if ($request->hasFile('image')) {
      $propertyDirectory = 'public/uploads/' . $prop->id;
      if (!Storage::exists($propertyDirectory)) {
        Storage::makeDirectory($propertyDirectory);
        // Set directory permissions to 755
        chmod(storage_path('app/public/uploads/' . $prop->id), 0755);
      }

      $images = $request->file('image');

      foreach ($images as $image) {
        $fileName = sha1(time() . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
        $image->storeAs($propertyDirectory, $fileName);

        // Create a new PropImage instance and associate it with the property
        $propImage = new PropImage([
          'image' => $fileName,
        ]);

        $prop->images()->save($propImage);
      }
    }
  }



  // ***************************************************************//

  public function edit(Property $prop)
  {
    // Make sure the logged-in user is an admin
    if (auth()->user()->role != 'admin') {
      abort(403, "Unauthorized action!");
    }

    // Retrieve the property images associated with the property
    $propImages = PropImage::where('prop_id', $prop->id)->get();

    // Pass the property and its images to the view
    return view('partials.edit-property', compact('prop', 'propImages'));
  }

  //update the status of a property in Admin page
  public function updateStatus(Request $request, Property $prop)
  {
    // Validate the incoming request
    $request->validate([
      'status' => 'required|in:live,hidden',
    ]);

    // Update the status of the property
    $prop->status = $request->input('status');
    $prop->save();

    // Redirect or return a response
    return redirect()->back()->with('success', 'Property status updated successfully.');
  }

  //Update a Property
  public function updateProperty(Request $request, Property $prop)
  {
    // Validate the incoming request data
    $validatedData = $request->validate([
      'title' => 'nullable|string|max:255',
      'offer_type' => 'nullable|string|in:sale,rent,lease',
      'price' => 'nullable|string|max:255',
      'price_range' => 'nullable|string|max:255',
      'period' => 'nullable|string|max:255',
      'currency' => 'nullable|string|in:GHC,$',
      'location' => 'nullable|string|max:255',
      'bed' => 'nullable|integer|min:1',
      'bath' => 'nullable|integer|min:1',
      'sqm' => 'nullable',
      'category' => 'nullable|string|max:255',
      'ft_image' => 'image|mimes:jpeg,png,jpg|max:2048',
      'more_info' => 'nullable|string',
      'amenities' => 'array'
    ]);

    // Append the amenities csv to the validated data if provided.
    $amenitiesArr = $request->input('amenities', []);
    if (!empty($amenitiesArr)) {
      $validatedData['amenities'] = implode(',', $amenitiesArr);
    } else {
      $validatedData['amenities'] = $prop->amenities;
    }

    // Handle file upload for feature image if provided
    if ($request->hasFile('ft_image')) {
      $validatedData['ft_image'] = $this->uploadFeatureImage($request, $prop);
    }

    // Only update fields that have new values
    foreach ($validatedData as $key => $value) {
      if (!is_null($value) && $value !== '') {
        $prop->$key = $value;
      }
    }

    $prop->save();

    // Validate the incoming request data for the gallery images
    $request->validate([
      'image' => 'array|min:1', // Ensure 'image' is an array and contains at least one file
      'image.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validation rules for each image in the array
    ]);

    // Handle file uploads for gallery images
    $this->uploadGalleryImages($request, $prop);

    // Redirect back with success message or handle response as needed
    return redirect('props/prop-details/' . $prop->id)->with('success', 'Property Updated Successfully.');
  }


  //Delete a Propery
  public function deleteProperty(Property $prop)
  {
    if (auth()->user()->role != 'admin') {
      abort(403, "Unauthorized action!");
    }
    // Delete ft_image from storage
    Storage::delete('public/uploads/ft_images/' . $prop->ft_image);

    // Check if prop dir Exists then delete gallery dir from storage
    if (Storage::exists('public/uploads/' . $prop->id)) {
      Storage::deleteDirectory('public/uploads/' . $prop->id);
    }

    // Delete the property's associated propImages from the database
    $prop->images()->delete();

    // Delete the property from the database
    $prop->delete();

    return redirect('/manage-properties')->with('error', 'Property Deleted.');
  }

  //Manage user Properties
  public function manageProperties()
  {
    $props = Property::orderBy('created_at', 'desc')->paginate(10);
    return view('partials.manage-properties', compact('props'));
  }
}
