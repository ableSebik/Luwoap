<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ClientEnquiryMail;
use App\Models\prop\AgentRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{

  // Insert a Client Request
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
      ->where('email', $validatedData['email'])
      ->exists();

    try {
      if ($requestExists) {
        // If the request already exists, return an error response
        return response()->json(['error' => true, 'message' => 'Request already submitted for this property']);
      }
      // Create a new AgentRequest instance
      $agentReq = AgentRequest::create($validatedData);

      // Queue the email to be sent
      Mail::to($validatedData['email'])->send(new ClientEnquiryMail($validatedData['name'], $validatedData['prop_id'],  $agentReq->slug));

      return response()->json(['success' => true, 'message' => 'Request submitted successfully.']);
    } catch (\Exception $e) {

      return response()->json(['error' => true, 'message' => 'Email sending failed.']);
    }
  }



  // Display all Requests
  public function allRequests()
  {
    $requests = AgentRequest::with('property')
      ->orderBy('created_at', 'desc')->paginate(10);

    // Calculate the number of days and hours since creation for each request
    foreach ($requests as $reqMeta) {
      $reqMeta->daysSinceCreation = $reqMeta->created_at->diffInDays(now());
      $reqMeta->hrSinceCreation = $reqMeta->created_at->diffInHours(now());
    }

    return view('partials.incoming-requests', compact('requests'));
  }

  // Display All New Requests
  public function newRequests()
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

  // Display All Seen Requests
  public function seenRequests()
  {
    $requests = AgentRequest::with('property')
      ->where('status', 'seen')->orderBy('created_at', 'desc')->paginate(10);

    // Calculate the number of days and hours since creation for each request
    foreach ($requests as $reqMeta) {
      $reqMeta->daysSinceCreation = $reqMeta->created_at->diffInDays(now());
      $reqMeta->hrSinceCreation = $reqMeta->created_at->diffInHours(now());
    }

    return view('partials.incoming-requests', compact('requests'));
  }

  // Display All Seen Requests
  public function archivedRequests()
  {
    $requests = AgentRequest::with('property')
      ->where('status', 'archive')->orderBy('created_at', 'desc')->paginate(10);

    // Calculate the number of days and hours since creation for each request
    foreach ($requests as $reqMeta) {
      $reqMeta->daysSinceCreation = $reqMeta->created_at->diffInDays(now());
      $reqMeta->hrSinceCreation = $reqMeta->created_at->diffInHours(now());
    }

    return view('partials.incoming-requests', compact('requests'));
  }

  //Manage Requests
  public function updateRequestStatus(Request $request, $id)
  {
    $request->validate([
      'status' => ['required', 'in:new,seen,archived'],
    ]);

    $agentRequest = AgentRequest::findOrFail($id);
    $agentRequest->status = $request->status;
    $agentRequest->save();

    return response()->json(['success' => true, 'message' => 'Request status updated successfully.']);
  }
}
