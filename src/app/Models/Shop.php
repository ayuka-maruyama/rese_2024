<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = ['shop_name', 'area_id', 'genre_id', 'summary', 'image', 'user_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function evaluation()
    {
        return $this->hasMany(Evaluation::class, 'shop_id');
    }
}
