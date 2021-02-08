<?php


namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\Number\NumberRepositoryContract;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class NumbersByCustomerController
{
    protected $numberRepository;

    public function __construct(NumberRepositoryContract $numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function __invoke(Customer $customer)
    {
        if (! isset($customer->id)) {
            return redirect()->route('customers.index')->withErrors('Please provide a valid customer');
        }

        $numbers = $this->numberRepository->getAllNumbersByCustomerIdAndPaginate($customer->id);

        return view('number.index', compact('numbers'));
    }
}
