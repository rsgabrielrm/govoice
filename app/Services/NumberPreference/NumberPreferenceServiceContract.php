<?php


namespace App\Services\NumberPreference;


interface NumberPreferenceServiceContract
{
    public function canRegisterNumberPreference($customerId, $userId);
    public function canChangeNumberPreference($numberPreferenceId, $userId);
}
