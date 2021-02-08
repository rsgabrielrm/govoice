<?php


namespace App\Http\Controllers;


use App\Http\Requests\Number\NumberStoreRequest;
use App\Http\Requests\Number\NumberUpdateRequest;
use App\Models\Number;
use App\Repositories\Customer\CustomerRepositoryContract;
use App\Repositories\Number\NumberRepositoryContract;
use App\Services\Number\NumberServiceContract;
use Illuminate\Support\Facades\Auth;

class NumberController extends Controller
{
    protected $numberRepository;
    protected $customerRepository;
    protected $numberService;

    public function __construct(
        NumberRepositoryContract $numberRepository,
        CustomerRepositoryContract $customerRepository,
        NumberServiceContract $numberService
    )
    {
        $this->numberRepository = $numberRepository;
        $this->customerRepository = $customerRepository;
        $this->numberService = $numberService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;

        $numbers = $this->numberRepository->getAllNumbersByUserIdAndPaginate($userId);

        return view('number.index', compact('numbers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::user()->id;

        $customers = $this->customerRepository->getByAttribute('user_id',  $userId)->get();

        if (empty($customers)) {
            return redirect()->route('customers.create')->withErrors('You must have a registered customer before entering a new number');
        }

        return view('number.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NumberStoreRequest $request)
    {
        $data = $request->validated();

        $userId = Auth::user()->id;

        if (! $this->numberService->canRegisterNumber($data['customer_id'], $userId)) {
            return redirect()->route('numbers.create')->withErrors('Please provide a valid customer');
        }

        $this->numberRepository->store($data);

        return redirect()->route('numbers.index')->withSuccess("Number successfully registered");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Number $number)
    {

        $userId = Auth::user()->id;
        $customers = $this->customerRepository->getByAttribute('user_id',  $userId)->get();

        $statusOptions = Number::NUMBER_STATUS_OPTIONS;


        return view('number.edit', compact('number','customers', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NumberUpdateRequest $request, Number $number)
    {
        $data = $request->validated();
        $userId = Auth::user()->id;

        if (! $this->numberService->canChangeNumber($number->id, $userId)) {
            return redirect()->back()->withErrors('You are not allowed to edit the number!');
        }

        $this->numberRepository->updateById($data, $number->id);

        return redirect()->back()->withSuccess("Number updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Number $number)
    {
        $userId = Auth::user()->id;

        if (! $this->numberService->canChangeNumber($number->id, $userId)) {
            return redirect()->back()->withErrors('You are not allowed to delete the number!');
        }

        $this->numberRepository->delete($number->id);

        return redirect()->back()->withSuccess('Number successfully deleted');
    }
}
