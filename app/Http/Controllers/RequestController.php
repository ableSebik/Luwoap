<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
      'message' => 'nullable|string', // Optional message field
    ]);

    $validatedData['status'] = 'new';

    // Check if the combination of prop_id and phone already exists
    $requestExists = AgentRequest::where('prop_id', $request->prop_id)
      ->where('phone', $validatedData['phone'])
      ->exists();

    if ($requestExists) {
      return response()->json(['error' => true]);
    } else {
      // Create a new AgentRequest instance
      AgentRequest::create($validatedData);

      $clientName = $validatedData['name'];
      $prop_id = $validatedData['prop_id'];
      // Send a confirmation email
      Mail::to($validatedData['email'])->send(new ClientEnquiryMail($clientName, $prop_id));


      return response()->json(['success' => true]);
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
