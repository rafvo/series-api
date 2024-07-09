<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'attachment',
    ];

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'created_at',
    //     'updated_at',
    // ];

    public function seasons(): HasMany {
        return $this->hasMany(Season::class);
    }

    public function episodes() {
        return $this->hasManyThrough(Episode::class, Season::class);
    }
}
