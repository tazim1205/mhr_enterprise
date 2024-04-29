<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPassOtp extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function hasAny($email,$session_id)
    {
        $check = UserPassOtp::where('email',$email)->where('session_id',$session_id)->where('verified',0)->count();
        if($check > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function DeleteThis($email,$session_id)
    {
        UserPassOtp::where('email',$email)->where('session_id',$session_id)->delete();
        return true;
    }

    public static function hasAnyOtp($email,$otp,$session_id)
    {
        $check = UserPassOtp::where('email',$email)->where('otp',$otp)->where('session_id',$session_id)->where('verified',0)->count();
        if($check > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function checkTime($email,$otp,$session_id)
    {
        $getTime = UserPassOtp::where('email',$email)->where('otp',$otp)->where('session_id',$session_id)->first();
        $getTime = explode(' ',$getTime->created_at);
        $insertedTime = $getTime[1];
        $limit_time = date('H:i:s', strtotime($insertedTime. ' +60 seconds'));
        if(date('H:i:s') < $limit_time)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function Verify($email,$otp,$session_id)
    {
        $check = UserPassOtp::where('email',$email)->where('otp',$otp)->where('session_id',$session_id)->where('verified',0)->update(['verified'=>1]);

        return true;
    }

    public static function isVerfiy($email,$session_id)
    {
        $check = UserPassOtp::where('email',$email)->where('session_id',$session_id)->where('verified',1)->count();
        if($check > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
