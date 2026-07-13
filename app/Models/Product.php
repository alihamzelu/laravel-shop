<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
        'brand_id',
        'is_active',
        'slug',
    ];

    protected $appends = ['final_price'];

    public function deal()
    {
        return $this->hasOne(Deal::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function cartItems()
    {
        return $this->hasMany(cart_item::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFinalPriceAttribute()
    {
        if ($this->deal && $this->deal->end_date > now()) {
            $discount = ($this->price * $this->deal->discount_percent) / 100;
            return $this->price - $discount;
        }
        return $this->price;
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->deal && $this->deal->end_date > now()) {
            return $this->deal->discount_percent;
        }
        return 0;
    }

    public function hasActiveDeal()
    {
        return $this->deal && $this->deal->end_date > now();
    }
    public function wishedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
}
