<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Mail\ClientEnquiryMail;
use App\Models\prop\AgentRequest;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{

  //Insert a Client Request
  public function insertRequests(Request $request)
  {
    // Validate the incoming request data
    $validatedData = $request->validate([
      'prop_id' => 'required|integer',
      'name' => 'required|string|max:255',
      'phone' => 'required|string|max:20',
      'email' => 'required|email|max:255',
      'message' => 'nullable|string|max:1000', // Optional message field
    ]);

    $validatedData['status'] = 'new';




    // Check if the combination of prop_id and phone already exists
    $requestExists = AgentRequest::where('prop_id', $request->prop_id)
      ->where('phone', $validatedData['phone'])
      ->exists();

    if ($requestExists) {
      // If the request already exists, return an error response
      return response()->json(['error' => true]);
    } else {
      // Create a new AgentRequest instance
      AgentRequest::create($validatedData);

      try {
        Mail::to('fakulti47@gmail.com')->send(new ClientEnquiryMail('Abel Sebik', '1'));
        return response()->json(['success' => true]);
      } catch (\Exception $e) {
        //log error
        Log::error('Email sending failed:' . $e->getMessage());
        return response()->json(['error' => 'Email sending failed.']);
      }
      // Send a confirmation email
      // Mail::to($validatedData['email'])->send(new ClientEnquiryMail($validatedData['name'], $validatedData['prop_id']));

      // Return a success response
    }
  }



  // Display all Requests
  public function allRequests()
  {
    $requests = AgentRequest::with('property')
      ->where('status', 'new')->orderBy('created_at', 'desc')->paginate(10);

    // Calculate the number of days and hours since creation for each request
    foreach ($requests as $reqMeta) {
      $reqMeta->daysSinceCreation = $reqMeta->created_at->diffInDays(now());
      $reqMeta->hrSinceCreation = $reqMeta->created_at->diffInHours(now());
    }

    return view('partials.incoming-requests', compact('requests'));
  }

  //Manage Requests
  public function manageRequests()
  {
  }
}
