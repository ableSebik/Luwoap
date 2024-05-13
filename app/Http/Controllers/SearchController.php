<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\prop\Property;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('query');

        // Perform the search using Scout on both Blog and Property models
        $blogResults = Blog::search($query)->get();
        $propertyResults = Property::search($query)->get();

        // Return the search results to a view
        return view('search_results', compact('blogResults', 'propertyResults', 'query'));
    }
}
