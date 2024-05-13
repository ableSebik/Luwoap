<?php

namespace App\Models\prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropImage extends Model
{
	use HasFactory;

	protected $table = "prop_images";

	protected $fillable = [
		'prop_id',
		'image',
	];

	public $timestamps = true;

	// Define relationship with Property
	public function property()
	{
		return $this->belongsTo(Property::class, 'prop_id');
	}
}
