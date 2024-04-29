<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class MenuLabel extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->create_by = Auth::user()->id;
        });
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User','create_by');
    }

    public function deleted_by()
    {
        return $this->belongsTo('App\Models\User','delete_by');
    }

    static function moveToTrash($id)
    {
        $destroy = MenuLabel::find($id)->delete();
        return true;
    }

    static function DeleteBy($id)
    {
        MenuLabel::withTrashed()->find($id)->update([
            'delete_by' => Auth::user()->id,
        ]);
        return true;
    }
    static function RestoreBy($id)
    {
        MenuLabel::withTrashed()->find($id)->update([
            'restore_by' => Auth::user()->id,
        ]);
    }

    public static function hasAnyMenu($id)
    {
        $count = Menu::withTrashed()->where('label_id',$id)->where('status',1)->count();
        return $count;
    }

}
