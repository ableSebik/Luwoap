<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ClientEnquiryMail;
use App\Mail\AdminNotificationMail;
use App\Models\prop\AgentRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{

  // Insert a Client Request
  // public function insertRequests(Request $request)
  // {
  //   $validatedData = $request->validate([
  //     'prop_id' => 'required|integer',
  //     'name' => 'required|string|max:255',
  //     'phone' => 'required|string|max:20',
  //     'email' => 'required|email|max:255',
  //     'message' => 'required|string|max:1000',
  //   ]);

  //   $validatedData['status'] = 'new';

  //   // Check for existing request
  //   $requestExists = AgentRequest::where('prop_id', $validatedData['prop_id'])
  //     ->where('phone', $validatedData['phone'])
  //     ->where('email', $validatedData['email'])
  //     ->exists();

  //   if ($requestExists) {
  //     return response()->json(['error' => true, 'message' => 'Request already submitted for this property.']);
  //   }

  //   try {
  //     // Create new request
  //     $agentReq = AgentRequest::create($validatedData);

  //     // Send email
  //     Mail::to($validatedData['email'])->send(
  //       new ClientEnquiryMail($validatedData['name'], $validatedData['prop_id'], $agentReq->id)
  //     );

  //     return response()->json(['success' => true, 'message' => 'Request submitted successfully.']);
  //   } catch (\Exception $e) {
  //     // Log the exception
  //     Log::error('Error sending email: ' . $e->getMessage());

  //     return response()->json(['error' => true, 'message' => 'An error occurred while processing your request.']);
  //   }
  // }

  public function insertRequests(Request $request)
  {
    $validatedData = $request->validate([
      'prop_id' => 'required|integer',
      'name' => 'required|string|max:255',
      'phone' => 'required|string|max:20',
      'email' => 'required|email|max:255',
      'message' => 'required|string|max:1000',
    ]);

    $validatedData['status'] = 'new';

    // Check for existing request
    $requestExists = AgentRequest::where('prop_id', $validatedData['prop_id'])
      ->where('phone', $validatedData['phone'])
      ->where('email', $validatedData['email'])
      ->exists();

    if ($requestExists) {
      return response()->json([
        'error' => true,
        'message' => 'Sorry, you have already submitted an enquiry for this property.',
      ]);
    }

    try {
      AgentRequest::create($validatedData);

      // Notify client
      try {
        Mail::to($validatedData['email'])->send(
          new ClientEnquiryMail($validatedData['name'], $validatedData['prop_id'])
        );
      } catch (\Exception $e) {
        Log::error("Failed to send email to client ({$validatedData['email']}): " . $e->getMessage());
      }

      // Notify admin
      try {
        Mail::to('info@luwoap.com')->send(
          new AdminNotificationMail($validatedData['name'], $validatedData['prop_id'])
        );
      } catch (\Exception $e) {
        Log::error("Failed to send email to admin (sebikabel@gmail.com): " . $e->getMessage());
      }

      return response()->json([
        'success' => true,
        'message' => 'Thank you for your message. An agent will contact you shortly..',
      ]);
    } catch (\Exception $e) {
      Log::error('Error saving request or processing email: ' . $e->getMessage());
      return response()->json([
        'error' => true,
        'message' => 'An error occurred while processing your request.',
      ]);
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

  // Display All archived Requests
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
