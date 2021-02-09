<?php


namespace App\Services\NumberPreference;

use App\Repositories\Customer\CustomerRepositoryContract;
use App\Repositories\NumberPreference\NumberPreferenceRepositoryContract;

class NumberPreferenceService implements NumberPreferenceServiceContract
{

    protected $numberPreferenceRepository;
    protected $customerRepository;

    public function __construct(
        NumberPreferenceRepositoryContract $numberPreferenceRepository,
        CustomerRepositoryContract $customerRepository
    )
    {
        $this->numberPreferenceRepository = $numberPreferenceRepository;
        $this->customerRepository = $customerRepository;
    }

    public function canRegisterNumberPreference($customerId, $userId)
    {
        $customer = $this->customerRepository->getCustomerByIdAndUserId($customerId, $userId);

        return empty($customer) ? false : true;
    }

    public function canChangeNumberPreference($numberPreferenceId, $userId)
    {
        $numberPreference = $this->numberPreferenceRepository->getByIdAndWithRelations($numberPreferenceId, ['number'])->first();

        if (! isset($numberPreference->number->customer->user_id)) {
            return false;
        }

        if ($numberPreference->number->customer->user_id == $userId)  {
            return true;
        }

        return false;
    }
}
