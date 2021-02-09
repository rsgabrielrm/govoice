<?php


namespace App\Http\Controllers;


use App\Http\Requests\Number\NumberStoreRequest;
use App\Http\Requests\Number\NumberUpdateRequest;
use App\Http\Requests\NumberPreference\NumberPreferenceStoreRequest;
use App\Http\Requests\NumberPreference\NumberPreferenceUpdateRequest;
use App\Models\Number;
use App\Models\NumberPreference;
use App\Repositories\Customer\CustomerRepositoryContract;
use App\Repositories\Number\NumberRepositoryContract;
use App\Repositories\NumberPreference\NumberPreferenceRepositoryContract;
use App\Services\Number\NumberServiceContract;
use App\Services\NumberPreference\NumberPreferenceServiceContract;
use Illuminate\Support\Facades\Auth;

class NumberPreferenceController extends Controller
{
    protected $numberPreferenceRepository;

    protected $numberRepository;
    protected $customerRepository;
    protected $numberService;
    protected $numberPreferenceService;

    public function __construct(
        NumberPreferenceRepositoryContract $numberPreferenceRepository,
        NumberRepositoryContract $numberRepository,
        CustomerRepositoryContract $customerRepository,
        NumberServiceContract $numberService,
        NumberPreferenceServiceContract $numberPreferenceService
    )
    {
        $this->numberPreferenceRepository = $numberPreferenceRepository;
        $this->numberRepository = $numberRepository;
        $this->customerRepository = $customerRepository;
        $this->numberService = $numberService;
        $this->numberPreferenceService = $numberPreferenceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Number $number)
    {
        if (empty($number) || !isset($number->customer)) {
            return redirect()->route('numbers.index')->withErrors('We did not find the number requested');
        }

        $userId = Auth::user()->id;
        $customer = $number->customer;
        $numberPreferences = $this->numberPreferenceRepository->getAllNumberPreferencesByNumberIdAndUserIdAndPaginate($number->id, $userId);

        return view('number-preference.index', compact('number','numberPreferences', 'customer'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Number $number)
    {
        if (empty($number) || !isset($number->customer)) {
            return redirect()->route('numbers.index')->withErrors('We did not find the number requested');
        }

        return view('number-preference.create', compact('number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NumberPreferenceStoreRequest $request, Number $number)
    {
        $data = $request->validated();

        $userId = Auth::user()->id;

        if (! $this->numberPreferenceService->canRegisterNumberPreference($number->customer_id, $userId)) {
            return redirect()->route('numbers.index')->withErrors('You are not allowed to add preferences to this number');
        }

        $this->numberPreferenceRepository->store($data);

        return redirect()->route('number.preferences.index', $number->id)->withSuccess("Preference number successfully registered");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Number $number, NumberPreference $preference)
    {

        if (empty($number) || !isset($number->id)) {
            return redirect()->route('numbers.index')->withErrors('We did not find the number requested');
        }

        if (! isset($preference->id)) {
            return redirect()->route('number.preferences.index', $number->id)->withErrors('We did not find the preference number requested');
        }

        $userId = Auth::user()->id;
        if (! $this->numberPreferenceService->canChangeNumberPreference($preference->id, $userId)) {
            return redirect()->route('number.preferences.index', $number->id)->withErrors('You are not allowed to edit the preference number!');
        }

        return view('number-preference.edit', compact('number','preference'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NumberPreferenceUpdateRequest $request, Number $number, NumberPreference $preference)
    {
        if (empty($number) || !isset($number->id)) {
            return redirect()->route('numbers.index')->withErrors('We did not find the number requested');
        }

        if (! isset($preference->id)) {
            return redirect()->route('number.preferences.index', $number->id)->withErrors('We did not find the preference number requested');
        }

        $data = $request->validated();
        $userId = Auth::user()->id;
        if (! $this->numberPreferenceService->canChangeNumberPreference($preference->id, $userId)) {
            return redirect()->route('number.preferences.index', $number->id)->withErrors('You are not allowed to edit the preference number!');
        }

        $this->numberPreferenceRepository->updateById($data, $preference->id);

        return redirect()->back()->withSuccess("Number updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Number $number, NumberPreference $preference)
    {
        if (empty($number) || !isset($number->id)) {
            return redirect()->route('numbers.index')->withErrors('We did not find the number requested');
        }

        if (! isset($preference->id)) {
            return redirect()->route('number.preferences.index', $number->id)->withErrors('We did not find the preference number requested');
        }

        $userId = Auth::user()->id;
        if (! $this->numberPreferenceService->canChangeNumberPreference($preference->id, $userId)) {
            return redirect()->route('number.preferences.index', $number->id)->withErrors('You are not allowed to delete the preference number!');
        }

        $this->numberPreferenceRepository->delete($preference->id);

        return redirect()->back()->withSuccess('Preference number successfully deleted');
    }
}
