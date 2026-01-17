<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'postal_code',
        'address',
        'building',
        'is_first_login',
    ];

public function purchases()
{
    return $this->hasMany(Purchase::class);
}
public function purchasedItems() {
    return $this->belongsToMany(Item::class, 'purchases', 'user_id', 'item_id');
}
public function user()
{
    return $this->belongsTo(User::class);
}

public function item()
{
    return $this->belongsTo(Item::class);
}

public function favorites()
{
    return $this->hasMany(Favorite::class);
}

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
