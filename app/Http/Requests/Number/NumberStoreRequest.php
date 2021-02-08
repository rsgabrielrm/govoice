<?php


namespace App\Http\Requests\Number;


use App\Traits\FormatString;
use Illuminate\Foundation\Http\FormRequest;

class NumberStoreRequest extends FormRequest
{
    use FormatString;

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'number' => $this->digitsOnly($this->number)
        ]);

    }

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
            'customer_id' => 'required|exists:customers,id|numeric',
            'number' => 'required|min:8|max:14',
        ];
    }
}
