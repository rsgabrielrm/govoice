<?php

namespace App\Repositories\Customer;

use App\Repositories\BaseRepositoryContract;

interface CustomerRepositoryContract extends BaseRepositoryContract
{
    public function getByUserIdAndPaginate($userId, $perPage = 10);
    public function getCustomerByIdAndUserId($id, $userId);
}
