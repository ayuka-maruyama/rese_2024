<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'Areas';
    protected $fillable = 'area_name';
    protected $dates = ['created_at', 'updated_at'];

    public function Shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
