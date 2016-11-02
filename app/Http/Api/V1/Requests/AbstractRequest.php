<?php

namespace App\Http\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        // We can add sanitize() method to our request classes to modify input data if needed
        // One example of usage is to set default value(s) if input is not present
        if (method_exists($this, 'sanitize')) {
            $this->sanitize();
        }

        return parent::getValidatorInstance();
    }

    /**
     * Error response on API calls
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        return response()->json($errors, 442); // 422 = Unprocessable Entity
    }
}
