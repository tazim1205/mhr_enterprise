<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class shipping extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function order()
    {
        return $this->hasMany(order::class,'shipping_id');
    }
}
