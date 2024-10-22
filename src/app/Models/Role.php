<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * リレーション: Role は複数の Admin_user に対応する
     */
    public function adminUsers()
    {
        return $this->hasMany(Admin_user::class);
    }
}
