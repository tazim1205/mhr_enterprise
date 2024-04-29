<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Menu extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->create_by = Auth::user()->id;
        });
    }

    public static function SelectParent()
    {
        $data = Menu::where('type',1)->where('status',1)->get();
        return $data;
    }

    public function childdren()
    {
        return $this->hasMany('App\Models\Menu','parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu','parent_id');
    }

    public static function makeInactive($id)
    {
        Menu::find($id)->update([
            'status' => 0,
        ]);
        return true;
    }
    public static function makeActive($id)
    {
        Menu::find($id)->update([
            'status' => 1,
        ]);
        return true;
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User','create_by');
    }

    public function label()
    {
        return $this->belongsTo('App\Models\MenuLabel','label_id');
    }

    public static function getFirst()
    {
        $data = Menu::where('parent_id',NULL)->where('label_id',NULL)->first();
        return $data;
    }

    public static function hasAnyChilldren($id)
    {
        $count = Menu::withTrashed()->where('parent_id',$id)->count();
        return $count;
    }
}
