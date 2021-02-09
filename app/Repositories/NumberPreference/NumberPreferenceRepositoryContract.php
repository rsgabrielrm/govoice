<?php

namespace App\Repositories\NumberPreference;

use App\Repositories\BaseRepositoryContract;

interface NumberPreferenceRepositoryContract extends BaseRepositoryContract
{
    public function getAllNumberPreferencesByNumberIdAndUserIdAndPaginate($numberId, $userId, $perPage = 10);
}
