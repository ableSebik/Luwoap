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
        'agent_name',
        'name',
        'email',
        'phone',
    ];

    public $timestamps = true;
}
