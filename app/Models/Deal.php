<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'product_id',
        'discount_percent',
        'start_date',
        'end_date',
    ];


    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}