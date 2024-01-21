<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha_spaces'],
            'father_name' => ['required', 'alpha_spaces'],
            'mobile' => 'required|numeric|digits:10',
            'dob' => 'required|date|before:-18 years',
            'applied_for' => 'required',
            'email' => 'required|email|unique:employees,email',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'dob.before' => 'The user must be at least 18 years old.',
            
            // ... (customize other messages as needed)
        ];
    }
}