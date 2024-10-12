<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaccineRegistrationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'nid' => 'required|string|unique:users,nid|min:10|max:13',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
            'phone' => 'nullable|string|unique:users,phone|max:14',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'nid.required' => 'National ID is required.',
            'nid.unique' => 'This National ID is already registered.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.',
            'email.rfc' => 'This email is invalid.',
            'vaccine_center_id.required' => 'Vaccine Center is required.',
            'vaccine_center_id.exists' => 'The selected Vaccine Center does not exist.',
            'phone.required' => 'Phone number is required.',
            'phone.unique' => 'This phone number is already registered.',
            'area.required' => 'Please select your area.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least :min characters.'
        ];
    }
}
