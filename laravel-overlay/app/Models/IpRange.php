<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpRange extends Model
{
    protected $fillable = ['site_id', 'name', 'start_ip', 'end_ip', 'reserved_gaps', 'notes'];

    protected $casts = ['reserved_gaps' => 'array'];
}
