<?php

namespace App\Models;

use App\Models\User;
use App\Models\prop\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'prop_id', 'parent_id', 'comment', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prop()
    {
        return $this->belongsTo(Property::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comments::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comments::class, 'parent_id');
    }
}
