<?php

namespace App\Models;

use App\Models\User;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function provinces()
    {
        return $this->belongsTo(Province::class);
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
