<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{

  // Display all Comments
  public function allComments()
  {
    $comments = Comment::where('status', 'approved')
      ->with(['user', 'replies' => function ($query) {
        $query->where('status', 'approved');
      }])
      ->orderBy('created_at', 'desc')
      ->paginate(10); // Change this to the desired number of comments per page

    return view('partials.all-comments', compact('comments'));
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
