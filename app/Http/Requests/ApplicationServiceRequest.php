<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationServiceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'phone' => 'required|size:'.LengthCountriesPhonesNo(request('phone_code')),
            'email' => 'required',
            'phone_code' => 'required',
            'name' => 'required|max:255',
            'subscriber_notic' => 'required'
        ];
    }
}
