<?php

namespace App\Http\Api\V1\Requests;

use DateTime;

class UpdateVisitRequest extends AbstractRequest
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
            'vetId'       => 'required|int|exists:vets,id',
            'petId'       => 'required|int|exists:pets,id',
            'visitNumber' => 'required|int',
            'timestamp'   => 'required|date_format:' . DateTime::ATOM,
            'petWeight'   => 'numeric',
            'description' => 'string|max:1024',
            'scheduled'   => 'required|boolean',
        ];
    }
}
