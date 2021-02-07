<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepositoryContract
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

}
