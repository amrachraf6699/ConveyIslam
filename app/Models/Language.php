<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sounds()
    {
        return $this->hasMany(Sound::class);
    }

    public function getFlagUrlAttribute()
    {
        return asset('storage/' . $this->flag);
    }

    public function getSoundUrlAttribute()
    {
        return asset('storage/' . $this->sound);
    }
}
