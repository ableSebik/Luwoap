<?php

namespace App\Models\prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = "props";

    protected $fillable = [
        'title',
        'price',
        'image',
        'beds',
        'baths',
        'sq/ft',
        'home_type',
        'year_built',
        'price_per_sqft',
        'more_info',
        'location',
        'agent_name',
    ];

    public $timestamps = true;
}
