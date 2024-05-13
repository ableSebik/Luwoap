<?php

namespace App\Models\prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = "agents";

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public $timestamps = true;

    // Define relationship with Props
    public function props()
    {
        return $this->hasMany(Property::class);
    }
}
