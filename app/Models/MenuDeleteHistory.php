<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class MenuDeleteHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->date = date('Y-m-d');
        });
        static::creating(function($model){
            $model->time = date('h:i:s a');
        });
        static::creating(function($model){
            $model->delete_by = Auth::user()->id;
        });
    }

    public function deletor()
    {
        return $this->belongsTo('App\Models\User','delete_by'); 
    }
}
