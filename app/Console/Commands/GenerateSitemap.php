<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'app:generate-sitemap';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$sitemap = Sitemap::create();

		$sitemap->add(Url::create('https://luwoap.com/'));
		$sitemap->add(Url::create('https://luwoap.com/about'));
		$sitemap->add(Url::create('https://luwoap.com/contact'));
		$sitemap->add(Url::create('https://luwoap.com/blog'));
		$sitemap->add(Url::create('https://luwoap.com/properties'));
		$sitemap->add(Url::create('https://luwoap.com/props/offer_type/for-sale'));
		$sitemap->add(Url::create('https://luwoap.com/props/offer_type/rent'));
		$sitemap->add(Url::create('https://luwoap.com/props/offer_type/lease'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/hostel'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/hotel'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/airbnb'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/apartment'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/office-space'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/luxury-appartment'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/guest-house'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/house'));
		$sitemap->add(Url::create('https://luwoap.com/props/category/commercial-property'));
		// Add more routes as needed

		// Dynamic URLs
		$posts = Blog::all();
		foreach ($posts as $post) {
			$sitemap->add(Url::create("/blog/{$post->slug}")->setLastModificationDate($post->updated_at));
		}

		$sitemap->writeToFile(public_path('sitemap.xml'));

		$this->info('Sitemap generated successfully.');

		return 0;
	}
}
