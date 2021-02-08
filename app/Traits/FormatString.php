<?php


namespace App\Traits;


trait FormatString
{
    public function digitsOnly($string)
    {
        return  preg_replace('/[^0-9]/', '', $string);
    }

}
