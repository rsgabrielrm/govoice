<?php


namespace App\Services\Number;


use App\Repositories\Customer\CustomerRepositoryContract;
use App\Repositories\Number\NumberRepositoryContract;

class NumberService implements NumberServiceContract
{

    protected $customerRepository;
    protected $numberRepository;

    public function __construct(CustomerRepositoryContract $customerRepository, NumberRepositoryContract $numberRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->numberRepository = $numberRepository;
    }

    public function canRegisterNumber($customerId, $userId)
    {
        $customer = $this->customerRepository->getCustomerByIdAndUserId($customerId, $userId);

        return empty($customer) ? false : true;
    }

    public function canChangeNumber($numberId, $userId)
    {
        $number = $this->numberRepository->getByIdAndWithRelations($numberId, ['customer'])->first();

        if (! isset($number->customer->user_id)) {
            return false;
        }

        if ($number->customer->user_id == $userId)  {
            return true;
        }

        return false;
    }
}
