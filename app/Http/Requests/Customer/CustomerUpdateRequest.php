<?php


namespace App\Http\Requests\Customer;


use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'document' => 'required|string|min:6|max:12',
            'status' => [
                'required',
                Rule::in(Customer::CUSTOMER_STATUS_OPTIONS)
            ],
        ];
    }
}
