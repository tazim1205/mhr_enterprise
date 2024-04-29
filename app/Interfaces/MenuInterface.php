<?php
namespace App\Interfaces;
use App\Interfaces\BaseInterface;

interface MenuInterface extends BaseInterface{
    public function status($id);
}
