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

}
