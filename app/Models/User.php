<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];

    public static function checkHasMail($email)
    {
        $check = User::where('email',$email)->count();
        if($check > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function ChangePassword($email,$password)
    {
        User::where('email',$email)->update([
           'password' => Hash::make($password),
        ]);
        return true;
    }

    public static function hasAnyActivity($id)
    {
        $count = ActivityLog::where('user_id',$id)->count();
        return $count;
    }


    public static function booted()
    {
        parent::boot();

        static::creating(function($model){
            $model->create_by = Auth::user()->id;
        });
    }

    public static function totalUsers()
    {
        $result = User::where('branch_id',Auth::user()->branch_id)->count();
        return $result;
    }

    public function user_creator()
    {
        return $this->hasMany('App\Models\User','create_by');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User','create_by');
    }

    public function user_edit_history()
    {
        return $this->hasMany('App\Models\UserEditHistory','edit_by');
    }

    public function user_delete_history()
    {
        return $this->hasMany('App\Models\User','delete_by');
    }

    public function user_restore_history()
    {
        return $this->hasMany('App\Models\User','restore_by');
    }

    public function Activity()
    {
        return $this->hasMany('App\Models\ActivityLog','user_id');
    }
}
