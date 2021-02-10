<?php


namespace App\Http\Controllers;


use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use App\Repositories\Customer\CustomerRepositoryContract;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $customerRepository;
    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $customers = $this->customerRepository->getByUserIdAndPaginate($user_id);

        return view('customer.index', compact('customers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::user()->id;

        $this->customerRepository->store($data);

        return redirect()->route('customers.index')->withSuccess("Customer successfully registered");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        if (Auth::user()->id != $customer->user_id) {
            return redirect()->back()->withErrors('You are not allowed to update the client');
        }

        $statusOptions = Customer::CUSTOMER_STATUS_OPTIONS;

        return view('customer.edit', compact('customer', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $data = $request->validated();

        if (Auth::user()->id != $customer->user_id) {
            return redirect()->back()->withErrors('You are not allowed to update the client');
        }

        $this->customerRepository->updateById($data, $customer->id);

        return redirect()->back()->withSuccess("Client updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if (Auth::user()->id != $customer->user_id) {
            return redirect()->back()->withErrors('You are not allowed to delete the client!');
        }

        $this->customerRepository->delete($customer->id);

        return redirect()->back()->withSuccess('Client successfully deleted');
    }
}
