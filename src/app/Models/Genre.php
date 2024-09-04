<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'Genres';
    protected $fillable = 'genre_name';
    protected $dates = ['created_at', 'updated_at'];

    public function Shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
