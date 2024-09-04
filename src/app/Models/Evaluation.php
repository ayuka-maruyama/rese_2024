<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'Evaluations';
    protected $fillable = ['user_id', 'shop_id', 'evaluation', 'comment'];
    protected $dates = ['created_at', 'updated_at'];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function Shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
