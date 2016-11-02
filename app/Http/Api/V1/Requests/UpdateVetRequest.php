<?php

namespace App\Http\Api\V1\Requests;

class UpdateVetRequest extends AbstractRequest
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
            'userId' => 'required|int|exists:users,id|unique:vets,user_id',
            // TODO image
        ];
    }
}
