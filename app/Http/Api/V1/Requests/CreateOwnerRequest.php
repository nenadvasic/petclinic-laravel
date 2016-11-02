<?php

namespace App\Http\Api\V1\Requests;

class CreateOwnerRequest extends AbstractRequest
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
            'userId'    => 'required|int|exists:users,id|unique:owners,user_id',
            'address'   => 'string|min:5|max:100',
            'city'      => 'string|min:2|max:100',
            'telephone' => 'string|min:5|max:15',
        ];
    }
}
