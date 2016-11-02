<?php

namespace App\Http\Api\V1\Requests;

class SignUpRequest extends AbstractRequest
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
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:5',
            'birthdate'  => 'required|date',
            'first_name' => 'required',
            'last_name'  => 'required',
        ];
    }
}
