<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;

#[Fillable(['name', 'email', 'password', 'username', 'phone'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail, FilamentUser, HasName
{
    use HasFactory, Notifiable, HasRoles;


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function getFilamentName(): string
    {
        return $this->name;
    }


    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->hasAnyRole([
            'super-admin',
            'admin',
            'manager',
            'warehouse',
            'support',
        ]);
    }


    public function carts()
    {
        return $this->hasMany(Cart::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function cart()
    {
        return $this->hasOne(Cart::class);
    }


    public function wishlistProducts()
    {
        return $this->belongsToMany(Product::class, 'wishlists');
    }
}
