<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapItem extends Model
{
    protected $fillable = ['site_id', 'map_id', 'machine_id', 'x', 'y', 'w', 'h', 'rotation'];
}
