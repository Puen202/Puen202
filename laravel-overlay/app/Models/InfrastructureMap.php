<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfrastructureMap extends Model
{
    protected $table = 'maps';

    protected $fillable = ['site_id', 'zone_id', 'name', 'image_path', 'width', 'height'];
}
