<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|\App\Models\Photo[] $photos
 */
class Album extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function photos() : BelongsToMany
    {
        return $this->belongsToMany(Photo::class);
    }
}
