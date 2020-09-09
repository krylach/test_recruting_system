<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
            'name' => 'required|unique:candidates',
            'email' => 'required|email|unique:candidates',
            'status' => 'in:approved,declined',
            'skills' => 'array',
            'skills.*' => 'exists:skills,id',
        ];
    }
}