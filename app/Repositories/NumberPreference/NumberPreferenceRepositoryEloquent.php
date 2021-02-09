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

    public function getAllNumberPreferencesByNumberIdAndUserIdAndPaginate($numberId, $userId, $perPage = 10)
    {

        return $this->model->whereHas('number', function ($query) use ($userId){
                    $query->whereHas('customer', function ($queryCustomer) use ($userId){
                        $queryCustomer->whereHas('user', function ($queryUser) use ($userId) {
                            $queryUser->where('user_id', $userId);
                        });
                    });
                })->where('number_id', $numberId)->with('number')->paginate($perPage);

    }
}
