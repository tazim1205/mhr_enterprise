<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Branch extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public static function booted()
    {
        parent::boot();

        static::creating(function($model){
            $model->create_by = Auth::user()->id;
        });
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User','create_by');
    }

    public static function hasAnyUser($id)
    {
       $count =  User::withTrashed()->where('branch_id',$id)->count();
       return $count;
    }
}
