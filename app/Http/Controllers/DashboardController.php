<?php


namespace App\Http\Controllers;


use App\Repositories\Customer\CustomerRepositoryContract;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function __invoke()
    {
        $user = Auth::user();

        $customers = $this->customerRepository->getByAttribute('user_id', $user->id)->get();

        $userInfo = [
            'name' => $user->name ?? null,
            'email' => $user->email ?? null,
            'is_admin' => $user->is_admin ?? 0,
        ];

        return view('dashboard', compact('customers', 'userInfo'));
    }
}
