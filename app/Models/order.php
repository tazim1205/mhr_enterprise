<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function ShippingCharge()
    {
        return $this->belongsTo(ShippingCharge::class,'shipping_id');
    }

    public function order_info()
    {
        return $this->hasMany(order_info::class);
    }
}
