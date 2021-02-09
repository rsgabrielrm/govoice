<?php

namespace App\Http\Requests\NumberPreference;

use Illuminate\Foundation\Http\FormRequest;

class NumberPreferenceUpdateRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'number_id' => $this->route('number')->id ?? null,

        ]);

        $this->prepareFieldsBoolean();

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
            'number_id' => 'required|exists:numbers,id|numeric',
            'name' => 'required|string',
            'value' => 'required|string',
            'auto_attendant' => 'required|boolean',
            'voicemail_enabled' => 'required|boolean',
        ];
    }

    /**
     * Preapare fields boolean
     */
    private function prepareFieldsBoolean()
    {
        if (! isset($this->auto_attendant)) {
            $this->merge(['auto_attendant' => 0]);
        }
        if (! isset($this->voicemail_enabled)) {
            $this->merge(['voicemail_enabled' => 0]);
        }
    }
}
