<?php

namespace App\Http\Api\V1\Requests;

class UserActivationSimpleDTO extends AbstractRequest
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
     *
     */
    public function sanitize()
    {
        if ( ! $this->has('active')) {
            $this->merge(['active' => true]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => 'required|int',
            'active' => 'required|boolean',
        ];
    }
}
