<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
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
        'serie_id',
    ];

    public function serie() {
        return $this->belongsTo(Serie::class);
    }

    public function episodes() {
        return $this->hasMany(Episode::class);
    }
}
