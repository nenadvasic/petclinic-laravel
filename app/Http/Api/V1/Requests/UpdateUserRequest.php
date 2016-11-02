<?php

namespace App\Http\Api\V1\Requests;

class UpdateUserRequest extends AbstractRequest
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
            'email'     => 'required|email|unique:users,email', // TODO except current user's email
            'password'  => 'required|string|min:5',
            'role'      => 'required|string|max:255', // TODO in enum UserRole
            'firstName' => 'required|string|max:40',
            'lastName'  => 'required|string|max:60',
            'birthdate' => 'required|date',
            'active'    => 'required|boolean',
        ];
    }
}
