<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = ['user_id', 'shop_id', 'date', 'time', 'number_gest'];
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
