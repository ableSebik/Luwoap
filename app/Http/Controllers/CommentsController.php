<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{

  // Display all Comments
  public function allComments(Request $request)
  {
    $search = $request->input('search');
    $comments = Comment::with(['user', 'replies'])
      ->when($search, function ($query, $search) {
        return $query->where('comment', 'like', "%$search%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    // Calculate the number of days and hours since creation for each comment
    foreach ($comments as $commentMeta) {
      $commentMeta->daysSinceCreation = $commentMeta->created_at->diffInDays(now());
      $commentMeta->hrSinceCreation = $commentMeta->created_at->diffInHours(now());
    }

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

  // Add new Comment reply
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

  public function getReplies($id)
  {
    try {
      $comment = Comment::with('replies.user')->where('status', 'approved')->findOrFail($id);
      return response()->json(['success' => true, 'replies' => $comment->replies]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      return response()->json(['error' => true, 'message' => 'Comment not found.']);
    } catch (\Exception $e) {
      return response()->json(['error' => true, 'message' => 'An error occurred. Try again later.']);
    }
  }


  // Update Property Comment Status
  public function updateCommentStatus(Request $request, $id)
  {
    // Validate the incoming request
    $request->validate([
      'status' => 'required|in:approved,pending',
    ]);

    // Update the status of the property
    // $comment->status = $request->input('status');
    // $comment->save();

    $comment = Comment::findOrFail($id);
    $comment->status = $request->status;
    $comment->save();

    // Redirect or return a response
    return redirect()->back()->with('success', 'Comment ' . $comment->status . '.');
  }

  // Delete Property Comment
  public function deleteComment(Comment $comment)
  {

    if (auth()->user()->role != 'admin') {
      abort(403, "Unauthorized action!");
    }

    $comment->delete();

    return redirect()->back()->with('success', 'Comment Deleted.');
  }
}
