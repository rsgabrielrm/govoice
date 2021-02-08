<?php


namespace App\Services\Number;


interface NumberServiceContract
{
    public function canRegisterNumber($customerId, $userId);
    public function canChangeNumber($numberId, $userId);
}
