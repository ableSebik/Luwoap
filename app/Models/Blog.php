<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
  use HasFactory;
  use Searchable;

  protected $table = "posts";

  protected $fillable = [
    'post_title',
    'post_content',
    'post_ft_image',
    'post_excerpt',
    'post_tags',
    'user_id',
  ];
  public $timestamps = true;

  public static function boot()
  {
    parent::boot();

    // Generate a slug before creating a new blog post
    static::creating(function ($blog) {
      $blog->slug = static::generateUniqueSlug($blog->post_title);
    });

    // Update slug when title is updated
    static::updating(function ($blog) {
      if ($blog->isDirty('post_title')) {
        $blog->slug = static::generateUniqueSlug($blog->post_title, $blog->id);
      }
    });
  }

  private static function generateUniqueSlug($title, $id = 0)
  {
    // Generate a slug based on the title
    $slug = Str::slug($title);
    // Check if the generated slug already exists
    $originalSlug = $slug;
    $count = 1;

    while (static::where('slug', $slug)->where('id', '!=', $id)->exists()) {
      $slug = $originalSlug . '-' . $count++;
    }

    return $slug;
  }

  public function toSearchableArray()
  {
    $array = $this->toArray();

    // Customize the searchable array
    return $array;
  }

  //Relationship with User
  public function user()
  {
    return $this->belongsTo(User::class, 'id');
  }
}
