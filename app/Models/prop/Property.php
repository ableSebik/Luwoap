<?php

namespace App\Models\prop;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Rating;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
  use HasFactory;
  use Searchable;

  protected $table = "props";

  protected $fillable = [
    'title',
    'price',
    'currency',
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
  ];

  public $timestamps = true;

  public function toSearchableArray()
  {
    $array = $this->toArray();
    $array['id'] = $this->id;

    // Customize the searchable array
    return $array;
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

  //Relationship with User
  public function user()
  {
    return $this->belongsTo(User::class, 'id');
  }

  // Relationship with Ratings
  public function ratings()
  {
    return $this->hasMany(Rating::class, 'prop_id');
  }
}
