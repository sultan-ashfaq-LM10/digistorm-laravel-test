<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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
            'first_name'    => ['required', 'string', 'max:50'],
            'last_name'     => ['required', 'string', 'max:50'],
            'DOB'           => ['nullable', 'date_format:Y-m-d'],
            'company_name'  => ['required', 'string', 'max:100'],
            'position'      => ['required', 'string', 'max:100'],
            'email'         => ['nullable', 'email', 'unique:contacts,email,' . $this->contact->id, 'max:255'],
            'number'        => ['required', 'array', 'min:1'],
        ];
    }
}
