<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class RoleEditHistory extends Model
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
            $model->edit_by = Auth::user()->id;
        });
    }

    public function editor()
    {
        return $this->belongsTo('App\Models\User','edit_by');
    }
}
