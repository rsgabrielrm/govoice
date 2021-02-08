<?php

namespace App\Repositories\Number;

use App\Repositories\BaseRepositoryContract;

interface NumberRepositoryContract extends BaseRepositoryContract
{
    public function getAllNumbersByUserIdAndPaginate($userId, $perPage = 10);
}
