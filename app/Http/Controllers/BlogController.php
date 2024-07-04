<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
  //Global variable for common tags
  private $commonTags;



  public function __construct()
  {
    // Initialize the global variable in the constructor
    $this->commonTags = $this->getCommonTags();
  }

  public function blogPosts()
  {
    $pageTitle = "Stay Informed with LUWOAP Blog | Latest Trends in Real Estate";
    $metaDescription = "Stay informed with the latest updates and insights from the LUWOAP blog. Dive into articles on real estate trends, tips for finding the perfect accommodation, and news about our luxury units and well-organized properties in Accra.";

    $blogPosts = Blog::with('user')->orderBy('created_at', 'desc')->paginate(9);

    // Add post month, day, and year to each blog post
    foreach ($blogPosts as $blogPost) {
      $blogPost->post_month = $blogPost->created_at->format('M');
      $blogPost->post_year = $blogPost->created_at->format('y');
      $blogPost->post_day = $blogPost->created_at->format('d');
    }

    return view('blog', [
      'blogPosts' => $blogPosts,
      'commonTags' => $this->commonTags,
      'pageTitle' => $pageTitle,
      'metaDescription' => $metaDescription
    ]);
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
      'post_ft_image' => 'required|image|mimes:jpg,jpeg,png|max:5000',
      'post_content' => 'required',
      'post_excerpt' => 'nullable|string',
      'post_tags' => 'nullable|string|max:255',
    ]);

    // Add authenticated user's ID as user_id
    $validatedData['user_id'] = Auth::id();;

    // Process post ft image
    if ($request->hasFile('post_ft_image')) {

      $postDir = 'public/posts';
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
    return redirect()->back()->with('success', 'Blog created successfully.');
  }






  // Method to delete a blog post
  public function deletePost($id)
  {
    // Find the blog post by ID
    $blog = Blog::findOrFail($id);

    // If the blog post has a featured image, delete it from storage

    $filePath =  'public/posts/' . $blog->post_ft_image;

    if (Storage::exists($filePath)) {
      Storage::delete($filePath);
    }

    // Delete the blog post from db
    $blog->delete();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Post deleted successfully.');
  }





  //Show Edit Post form
  public function editPostView($id)
  {
    $blog = Blog::findOrFail($id);
    return view('partials.edit-post', compact('blog'));
  }





  // Update a specific post
  public function updatePost(Request $request, $id)
  {
    // Validate the incoming request
    $validatedData = $request->validate([
      'post_title' => 'required|string',
      'post_ft_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:5000',
      'post_content' => 'required',
      'post_excerpt' => 'nullable|string',
      'post_tags' => 'nullable|string|max:255',
    ]);

    // Find the post by ID
    $post = Blog::findOrFail($id);

    // Update post data
    $post->post_title = $request->input('post_title');
    $post->post_content = $request->input('post_content');
    $post->post_excerpt = $request->input('post_excerpt');
    $post->post_tags = $request->input('post_tags');

    // Handle the featured image upload
    if ($request->hasFile('post_ft_image')) {
      // Delete the old image if it exists
      if ($post->post_ft_image && Storage::exists('public/posts/' . $post->post_ft_image)) {
        Storage::delete('public/posts/' . $post->post_ft_image);
      }

      // Store the new image
      $file = $request->file('post_ft_image');
      $fileName = sha1(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
      $file->storeAs(
        'public/posts',
        $fileName
      );

      // Update the post with the new image filename
      $post->post_ft_image = $fileName;
    }

    // Save the updated post
    $post->save();

    // Redirect back with a success message
    return redirect()->route('post.all', $post->id)->with('success', 'Post updated successfully.');
  }







  //Manage list of blog page
  public function allPosts()
  {
    $posts = Blog::orderBy('created_at', 'desc')->paginate(10);
    return view('partials.all-posts', compact('posts'));
  }





  // show post details/single post page
  public function postDetails($slug)
  {
    // Get post details including user relationship
    $postDetails = Blog::with('user')->where('slug', $slug)->firstOrFail();

    // Extract tags from the current post
    $postTags = $postDetails->post_tags;

    // Convert post tags CSV string to an array
    $currentPostTags = str_getcsv($postTags);

    // Find related posts based on common tags
    $relatedPosts = Blog::where('id', '!=', $postDetails->id)
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
    $decodedTag = urldecode($tag);

    $relatedPosts = Blog::where('post_tags', 'like', '%' . $decodedTag . '%')
      ->orderBy('created_at', 'desc')
      ->get();

    // Get post Day, Month, and Year for display
    $post_month = $relatedPosts->first()->created_at->format('M');
    $post_year = $relatedPosts->first()->created_at->format('y');
    $post_day = $relatedPosts->first()->created_at->format('d');

    return view('blog', [
      'tag' => $decodedTag,
      'blogPosts' => $relatedPosts,
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
    $unencodedTags = array_slice($tagCounts, 0, 10, true);

    // URL-encode the tags
    $CommonTags = [];
    foreach ($unencodedTags as $tag => $count) {
      $CommonTags[urlencode($tag)] = $count;
    }

    return $CommonTags;
  }
}
