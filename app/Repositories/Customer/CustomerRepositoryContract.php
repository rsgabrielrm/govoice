<?php

namespace App\Repositories\Customer;

use App\Repositories\BaseRepositoryContract;

interface CustomerRepositoryContract extends BaseRepositoryContract
{
    public function getByUserIdAndPaginate($user_id, $perPage = 10);
}
