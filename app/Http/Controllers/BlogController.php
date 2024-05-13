<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
  //Global variable for common tags
  private $commonTags;

  public function __construct()
  {
    // Initialize the global variable in the constructor
    $this->commonTags = $this->getCommonTags();
  }

  // show all Posts
  public function blogPosts()
  {
    // dd($this->commonTags);
    $blogPosts = Blog::with('user')->orderBy('created_at', 'desc')->paginate(9);

    // Get post Day and Month year
    foreach ($blogPosts as $blogPost) {
      $created = $blogPost->created_at;
    }
    $post_month = $created->format('M');
    $post_year = $created->format('y');
    $post_day = $created->format('d');

    return view('blog', ([
      'blogPosts' => $blogPosts,
      'post_month' => $post_month,
      'post_day' => $post_day,
      'post_year' => $post_year,
      'commonTags' => $this->commonTags,
    ]));
    // return view('blog', compact('blogPosts'));
  }

  //Get Recent Posts
  public function recentPost()
  {
    // Retrieve the three most recent blog posts with their associated user
    $recentBlogPosts = Blog::with('user')
      ->orderBy('created_at', 'desc')
      ->take(3)
      ->get();

    // Check if there are any recent posts
    if ($recentBlogPosts->isEmpty()) {
      // Return empty data if no recent posts are found
      return [
        'blogPosts' => [],
        'post_month' => null,
        'post_day' => null,
      ];
    }

    // Get the most recent post's creation date
    $mostRecentPost = $recentBlogPosts->first();
    $post_month = $mostRecentPost->created_at->format('M');
    $post_day = $mostRecentPost->created_at->format('d');

    // Prepare and return the data to be used in the view
    return [
      'blogPosts' => $recentBlogPosts,
      'post_month' => $post_month,
      'post_day' => $post_day,
    ];
  }



  // create a new post
  public function createPost(Request $request)
  {
    // Validate data
    $validatedData = $request->validate([
      'post_title' => 'required|string',
      'post_ft_image' => 'nullable|image|max:5000',
      'post_content' => 'required',
      'post_excerpt' => 'nullable|string|max:255',
      'post_tags' => 'nullable|string|max:255',
    ]);

    // Add authenticated user's ID as user_id
    $validatedData['user_id'] = auth()->user()->id;

    // Process post ft image
    if ($request->hasFile('post_ft_image')) {

      $postDir = 'public/Posts';
      if (!Storage::exists($postDir)) {
        Storage::makeDirectory($postDir);
      }
      $file = $request->file('post_ft_image');
      $fileName = sha1(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
      $file->storeAs($postDir, $fileName); // Simplified directory path
      $validatedData['post_ft_image'] = $fileName; // Update validated data with file name
    }


    // Create new blog post
    Blog::create($validatedData);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Post created successfully.');
  }

  // show post details/single post page
  public function postDetails($id)
  {
    // Get post details including user relationship
    $postDetails = Blog::with('user')->find($id);

    if (!$postDetails) {
      // Handle case where post with given ID is not found
      return response()->json(['error' => 'Post not found'], 404);
    }

    // Extract tags from the current post
    $postTags = $postDetails->post_tags;

    // Convert post tags CSV string to an array
    $currentPostTags = str_getcsv($postTags);

    // Find related posts based on common tags
    $relatedPosts = Blog::where('id', '!=', $id)
      ->where(function ($query) use ($currentPostTags) {
        foreach ($currentPostTags as $tag) {
          $query->orWhere('post_tags', 'like', '%' . $tag . '%');
        }
      })
      ->orderBy('created_at', 'desc')
      ->take(4)
      ->get();

    return view('post-details', [
      'postDetails' => $postDetails,
      'relatedPosts' => $relatedPosts,
      'currentPostTags' => $currentPostTags,
      'commonTags' => $this->commonTags,
    ]);
  }

  //Find posts by tags
  public function postsByTag($tag)
  {
    // Find posts where the post_tags column contains the specified tag
    $relatedPosts = Blog::where('post_tags', 'like', '%' . $tag . '%')
      ->orderBy('created_at', 'desc')
      ->get();

    // Get post Day and Month year
    foreach ($relatedPosts as $blogPost) {
      $created = $blogPost->created_at;
    }
    $post_month = $created->format('M');
    $post_year = $created->format('y');
    $post_day = $created->format('d');


    return view('blog', [
      'tag' => $tag,
      'relatedPosts' => $relatedPosts,
      'post_month' => $post_month,
      'post_day' => $post_day,
      'post_year' => $post_year,
      'commonTags' => $this->commonTags,
    ]);
  }

  //Get requently used tags
  public function getCommonTags()
  {
    // Retrieve all tags from the posts table
    $tags = DB::table('posts')->pluck('post_tags')->all();

    // Flatten the array of CSV strings into a single array of tags
    $allTags = collect($tags)->flatMap(function ($tags) {
      return explode(',', $tags);
    })->filter()->all(); // Use filter() to remove empty values

    // Count occurrences of each tag
    $tagCounts = array_count_values($allTags);

    // Sort tags by frequency (most used to least used)
    arsort($tagCounts);

    // Get the most common tags (e.g., top 10)
    $commonTags = array_slice($tagCounts, 0, 10, true);

    return $commonTags;
  }
}
