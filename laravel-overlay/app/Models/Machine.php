<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Machine extends Model
{
    use LogsActivity;

    protected $fillable = [
        'site_id','zone_id','name','hostname','ip','mac','type','vendor','model','os','department',
        'status','criticality','notes','cannot_move','ip_locked_reason','created_by','updated_by',
    ];

    protected $casts = ['cannot_move' => 'boolean'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty();
    }
}
