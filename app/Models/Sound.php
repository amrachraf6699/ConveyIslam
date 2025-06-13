<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function getFilePathAttribute()
    {
        return asset('storage/sounds/' . $this->file);
    }
}
