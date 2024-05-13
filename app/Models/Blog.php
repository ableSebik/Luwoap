<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

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
