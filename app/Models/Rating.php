<?php

namespace App\Models;

use App\Models\prop\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'prop_id',
        'user_id',
        'rating_val',
    ];

    // Relationship with Property
    public function property()
    {
        return $this->belongsTo(Property::class, 'prop_id');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
