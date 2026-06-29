<?php

namespace App\Models\prop;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use App\Models\prop\PropImage;
use App\Models\prop\AgentRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
  use HasFactory, Searchable;

  protected $table = "props";

  protected $fillable = [
    'title',
    'price',
    'price_range',
    'currency',
    'period',
    'ft_image',
    'bed',
    'bath',
    'sqm',
    'category',
    'more_info',
    'location',
    'user_id',
    'offer_type',
    'amenities',
    'status',
  ];

  public $timestamps = true;

  public function toSearchableArray()
  {
    $array = $this->toArray();
    $array['id'] = $this->id;

    // Customize the searchable array
    return $array;
  }

  public function shouldBeSearchable()
  {
    return $this->status === 'live';
  }

  // Define relationship with PropImages
  public function images()
  {
    return $this->hasMany(PropImage::class, 'prop_id');
  }

  // Define relationship with Requests
  public function clientRequests()
  {
    return $this->hasMany(AgentRequest::class, 'prop_id');
  }

  // Relationship with User
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  // Relationship with Ratings
  public function ratings()
  {
    return $this->hasMany(Rating::class, 'prop_id');
  }

  // Relationship with Comments
  public function comments()
  {
    return $this->hasMany(Comment::class, 'prop_id');
  }

  // 
  public static function boot()
  {
    parent::boot();

    // Generate a slug before creating a new Property
    static::creating(function ($singleProp) {
      $singleProp->slug = static::generateUniqueSlug($singleProp->title);
    });

    // Update slug when title is updated
    static::updating(function ($singleProp) {
      if ($singleProp->isDirty('title')) {
        $singleProp->slug = static::generateUniqueSlug($singleProp->title, $singleProp->id);
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
}
