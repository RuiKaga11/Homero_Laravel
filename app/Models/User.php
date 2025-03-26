<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


// class User extends Model
// {
//     //
//     public $timestamps = false;

//     public function tweets()
//     {
//         return $this->hasMany(Tweet::class);
//     }

//     protected $fillable = [
//         'name', // 追加
//         'email',
//         'password',
//     ];
// }

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    protected $fillable = [
        'name', 
        'email',
        'password',
    ];
    // ...
}