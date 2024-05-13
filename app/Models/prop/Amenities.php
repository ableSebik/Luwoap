<?php

namespace App\Models\prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class amenities extends Model
{
    use HasFactory;

    protected $table = 'amenities';

    protected $fillable = [
        'air_conditioning',
        'room_service',
        'balcony',
        'gym',
        'pool',
        'parking',
        'wifi',
        'double_bed',
        'cctv',
        'jacuzzi',
        'security',
        'telephone',
        'alarm',
        'garage',
    ];

    // Define relationship with Prop
    public function prop()
    {
        return $this->belongsTo(Property::class);
    }
}
