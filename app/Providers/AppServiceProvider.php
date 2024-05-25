<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\prop\Property;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register()
	{
		// No registration needed for this service provider
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot()
	{
		view()->composer('*', function ($view) {
			$recentPostsData = $this->recentPost();
			$recentProps = $this->recentListings();

			$view->with('recentPostsData', $recentPostsData);
			$view->with('recentProps', $recentProps);
		});
	}

	private function recentListings()
	{
		$props = Property::withCount('images')->orderBy('created_at', 'desc')->take(4)->get();

		if ($props->isEmpty()) {
			return ['props' => []];
		}

		return ['props' => $props];
	}

	private function recentPost()
	{
		$recentBlogPosts = Blog::with('user')
			->orderBy('created_at', 'desc')
			->take(3)
			->get();

		if ($recentBlogPosts->isEmpty()) {
			return [
				'blogPosts' => [],
				'post_month' => null,
				'post_day' => null,
			];
		}

		// Add post month, day, and year to each blog post
		foreach ($recentBlogPosts as $blogPost) {
			$blogPost->post_month = $blogPost->created_at->format('M');
			$blogPost->post_year = $blogPost->created_at->format('y');
			$blogPost->post_day = $blogPost->created_at->format('d');
		}

		return [
			'blogPosts' => $recentBlogPosts,
		];
	}
}
