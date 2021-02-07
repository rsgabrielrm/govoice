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

}
