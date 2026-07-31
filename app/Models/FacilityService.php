<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityService extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon_path',
        'category',
    ];
}
