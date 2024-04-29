<?php
namespace App\Traits;

use Mail;
use App\Mail\EmailSender;
use Auth;

trait SendMail
{
    static function UserChangeOtp($otp,$email)
    {
        $content = [
            'subject' => 'Changing Password OTP',
            'body' => '<div style="background:lightblue;text-align:center;padding:10px;">Your OTP Is <br> <h2>'.$otp.'</h2></div>',
        ];

        Mail::to($email)->send(new EmailSender($content));
    }

    static function PasswordChanged($email)
    {
        $content = [
            'subject' => 'Password Changes',
            'body' => '<div style="background:lightblue;padding:10px;">
                Hello '.$email.'. Your Password Is Changed at '.date('d M Y').'('.date('h:i:s a').')
                </div>',
        ];

        Mail::to($email)->send(new EmailSender($content));
    }

    static function UserProfilePicuteUpdate()
    {
        $content = [
            'subject' => 'Profile Picture Updatess',
            'body' => '<div style="background:lightblue;padding:10px;">
                Hello '.Auth::user()->name.'. Your Profile Picture is Updated at '.date('d M Y').'('.date('h:i:s a').')
                </div>',
        ];

        Mail::to(Auth::user()->email)->send(new EmailSender($content));
    }
}
