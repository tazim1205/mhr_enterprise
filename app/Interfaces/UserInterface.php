<?php
namespace App\Interfaces;
use App\Interfaces\BaseInterface;

interface UserInterface extends BaseInterface{
    public function user_image_upload($request);

    public function reset_pass();

    public function send_otp($request);

    public function check_otp($email);

    public function resend_otp($email);

    public function submit_otp($request,$email);

    public function new_pass($email);

    public function submit_pass($request);

    public function search_activity($request);

    public function getQuickMenu($data);

    public function checkingOtp($otp,$email);

}
