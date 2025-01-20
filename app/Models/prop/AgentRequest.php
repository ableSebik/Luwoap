<?php

namespace App\Models\prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentRequest extends Model
{
  use HasFactory;

  protected $table = "requests";

  protected $fillable = [
    'prop_id',
    'user_id',
    'name',
    'phone',
    'email',
    'message',
    'status',
  ];

  public $timestamps = true;

  //Relationship with User
  public function property()
  {
    return $this->belongsTo(Property::class, 'prop_id');
  }
}
