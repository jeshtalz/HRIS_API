<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicantRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix_name' => ['nullable'],
            'contact_number' => ['required', 'string', 'max:255'],
            'email_address' => ['required', 'string', 'max:255'],
            // 'current_position' => ['required', 'string', 'max:255'],
            // 'employment_status' => ['required', 'string', 'max:255'],
            // 'employee_status' => ['required', 'string', 'max:255'],
            // 'orientation_status' => ['required', 'string', 'max:255']
        ];
    }
}
