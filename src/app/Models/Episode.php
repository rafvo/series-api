<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'number',
        'season_id',
        'watched',
    ];

    protected $casts = [
        'watched' => 'boolean',
    ];

    public function season() {
        return $this->belongsTo(Season::class);
    }

    // protected function watched(): Attribute {
    //     return new Attribute(
    //         get: fn(bool $watched) => (bool)$watched,
    //         set: fn(bool $watched) => (bool)$watched,
    //     );
    // }
}
