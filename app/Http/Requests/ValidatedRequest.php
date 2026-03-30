<?php

namespace App\Http\Requests;

class ValidatedRequest extends MultipartRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route = $this->route()->getName();
        $validationsPath = resource_path('defaults/validations.json');
        $validations = file_exists($validationsPath) ? json_decode(file_get_contents($validationsPath), true) : [];
        return isset($validations[$route]) && isset($validations[$route]['rules']) ? $validations[$route]['rules'] : [];
    }
    public function messages()
    {
        $route = $this->route()->getName();
        $validationsPath = resource_path('defaults/validations.json');
        $validations = file_exists($validationsPath) ? json_decode(file_get_contents($validationsPath), true) : [];
        return isset($validations[$route]) && isset($validations[$route]['messages']) ? $validations[$route]['messages'] : [];
    }
}