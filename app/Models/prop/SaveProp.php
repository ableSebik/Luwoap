<?php

namespace App\Models\prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveProp extends Model
{
    use HasFactory;
    protected $table = "saveprops";

    protected $fillable = [
        'prop_id',
        'user_id',
    ];
}
