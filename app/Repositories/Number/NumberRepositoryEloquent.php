<?php

namespace App\Repositories\Number;


use App\Models\Number as Numbers;
use App\Repositories\BaseRepository;

class NumberRepositoryEloquent extends BaseRepository implements NumberRepositoryContract
{
    protected $model;

    public function __construct(Numbers $model)
    {
        $this->model = $model;
    }

    public function getAllNumbersByUserIdAndPaginate($userId, $perPage = 10)
    {
         return $this->model->whereHas('customer', function ($query) use ($userId){
             $query->whereHas('user', function ($queryUser) use ($userId){
                 $queryUser->where('user_id', $userId);
             });
         })->with('customer')->paginate($perPage);
    }

    public function getAllNumbersByCustomerIdAndPaginate($customerId, $perPage = 10)
    {
        return $this->model->where('customer_id', $customerId)
                            ->with('customer')
                            ->paginate($perPage);
    }
}
