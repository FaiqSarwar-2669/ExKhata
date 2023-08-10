<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCalculation extends Model
{
    use HasFactory;
    protected $table = 'usercalculation'; 
    
    protected $fillable = [
        'login_user_id', 'PhoneNumber', 'Email', 'Name', 'UserTake', 'UserGive', 'profile_img'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'login_user_id');
    }
}
