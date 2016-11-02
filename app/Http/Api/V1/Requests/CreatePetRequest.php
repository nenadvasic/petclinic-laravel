<?php

namespace App\Http\Api\V1\Requests;

class CreatePetRequest extends AbstractRequest
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
            'name'       => 'required|string|max:40',
            'ownerId'    => 'required|int|exists:owners,id',
            'birthdate'  => 'required|date',
            'petType'    => 'required|string|max:100',
            'vaccinated' => 'required|boolean',
        ];
    }
}
