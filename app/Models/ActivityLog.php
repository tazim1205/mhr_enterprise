<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class ActivityLog extends Model
{
    use HasFactory;

    protected $guarded =[];

    public static function booted()
    {
        parent::boot();
        static::creating(function($model){
            $model->user_id = Auth::user()->id;
        });
        static::creating(function($model){
            $model->date = date('Y-m-d');
        });
        static::creating(function($model){
            $model->time = date('h:i:s a');
        });
    }

    public function activityBy()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
