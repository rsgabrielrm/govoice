<?php

namespace App\Repositories\NumberPreference;

use App\Models\NumberPreference;
use App\Repositories\BaseRepository;

class NumberPreferenceRepositoryEloquent extends BaseRepository implements NumberPreferenceRepositoryContract
{
    protected $model;

    public function __construct(NumberPreference $model)
    {
        $this->model = $model;
    }

}
