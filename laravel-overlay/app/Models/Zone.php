<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['site_id', 'name', 'code', 'description'];

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}
