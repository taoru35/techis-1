<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a one-to-one relationship with the Customer model.
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Define a one-to-many relationship with the Cart model.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Define a many-to-many relationship with the Item model using the Cart table.
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'carts')->withPivot('quantity');
    }
}
