<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRsvpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Public access - anyone can submit RSVP for a guest
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
            'rsvp_status' => ['required', 'in:yes,no,maybe'],
            'total_guest' => ['required_if:rsvp_status,yes', 'nullable', 'integer', 'min:1', 'max:10'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'rsvp_status.required' => 'Please select your RSVP status',
            'rsvp_status.in' => 'Invalid RSVP status',
            'total_guest.required_if' => 'Please specify number of guests if you are attending',
            'total_guest.integer' => 'Number of guests must be a number',
            'total_guest.min' => 'At least 1 guest is required',
            'total_guest.max' => 'Maximum 10 guests allowed',
        ];
    }
}
