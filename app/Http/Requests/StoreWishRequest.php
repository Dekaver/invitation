<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Public access - anyone can submit wishes
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
            'guest_name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:5', 'max:500'],
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
            'guest_name.required' => 'Your name is required',
            'guest_name.max' => 'Name must not exceed 100 characters',
            'message.required' => 'Please leave a message',
            'message.min' => 'Message must be at least 5 characters',
            'message.max' => 'Message must not exceed 500 characters',
        ];
    }
}
