<?php

namespace App\Http\Api\V1\Requests;

class VetDTO extends AbstractRequest
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
            'id'        => 'required|int',
            'firstName' => 'required|string',
            'lastName'  => 'required|string',
        ];
    }
}
