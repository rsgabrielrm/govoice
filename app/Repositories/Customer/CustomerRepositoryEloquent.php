<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\BaseRepository;

class CustomerRepositoryEloquent extends BaseRepository implements CustomerRepositoryContract
{
    protected $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function getByUserIdAndPaginate($userId, $perPage = 10)
    {
        return $this->model->where('user_id', $userId)
                            ->paginate($perPage);
    }

    public function getCustomerByIdAndUserId($id, $userId)
    {
        return $this->model->where('id', $id)
                            ->where('user_id', $userId)
                            ->first();
    }
}
